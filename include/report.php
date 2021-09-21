<?php
class MBM_Ipak_Report
{
    var $Data = [];
    var $chartTitle = '';
    var $model = [];
    var $add_query = '';
    var $orderby = "";
    var $query_cnt = "";
    public function scripts()
    {
        wp_enqueue_script(
            'ipak_hesab_jalali',
            MBM_IPAK_URI . 'assets/js/jalali.js',
            array('jquery'),
            1,
            false
        );

        wp_enqueue_script(
            'ipak_hesab_chart_bundle',
            MBM_IPAK_URI . 'assets/js/Chart.bundle.min.js',
            array('jquery'),
            1,
            false
        );

        wp_enqueue_script(
            'ipak_hesab_chart',
            MBM_IPAK_URI . 'assets/js/chart-render.js',
            array('jquery'),
            1,
            false
        );
    }
    public function get_data()
    {
        global $wpdb;
        foreach ($this->add_posts as $post) {
            if (isset($_POST[$post]) && $_POST[$post] > 0) {
                $this->params[":" . $post] = $_POST[$post];
                $this->add_query = $this->add_query . " and " . $post . "=:" . $post;
            }
        }

        $this->Data["ChartTitle"] = $this->chartTitle;
        $chart_labels = array();
        $chart_data = array();
        $excel_data = array();
        $query = "";
        $year_id = -1;
        $month_id = 0;
        if (isset($_POST["year_id"])) {
            $year_id = $_POST["year_id"];
        }
        if (isset($_POST["month_id"])) {
            $month_id = $_POST["month_id"];
        }
        if ($month_id > 0) {
            $year = mbm_ipak\tools::get_jalali_year($year_id);
            $count_day = 30;
            if ($month_id < 7) {
                $count_day = 31;
            }
            $order_by = $this->orderby;


            for ($x = 1; $x <= $count_day; $x++) {
                $query = " select " . $this->query_cnt . " as cnt from " . $this->model["name"] . "  where 1=1 " . $this->add_query . " and ((" . $this->orderby . ">='" . mbm_ipak\tools::to_miladi($year . "/" . $month_id . "/" . $x) . ' 00:00:00' . "' and " . $this->orderby . "<='" . mbm_ipak\tools::to_miladi($year . "/" . $month_id . "/" . $x) . ' 23:59:59' . "') or " . $this->orderby . "='" . mbm_ipak\tools::to_miladi($year . "/" . $month_id . "/" . $x) . "') ";


                $rows = $wpdb->get_results($this->query, 'ARRAY_A');

                // echo $query.'<br>';
                $title = $year . "/" . $month_id . "/" . $x;
                $chart_labels[] = $title;

                $chart_data[] = $rows[0]["cnt"];
                $excel_data[] = array("title" => $title, "val" => $rows[0]["cnt"]);
            }
        } else if ($year_id == 0) {
            $query = "select * from " . $this->model["name"] . " where 1=1 " . $this->add_query . " order by " . $this->orderby . " desc limit 1";
            $rows = $wpdb->get_results($this->query, 'ARRAY_A');
            if (count($rows) > 0) {
                $last_date = mbm_ipak\tools::to_jalali($rows[0]["" . $this->orderby . ""], "Y");

                $query = "select * from " . $this->model . " where 1=1 " . $this->add_query . " order by " . $this->orderby . "  limit 1";
                $rows = $wpdb->get_results($this->query, 'ARRAY_A');

                $first_date = mbm_ipak\tools::to_jalali($rows[0]["" . $this->orderby . ""], "Y");
                for ($x = $first_date; $x <= $last_date; $x++) {

                    $query = " select " . $this->query_cnt . " as cnt from " . $this->model . "  where 1=1 " . $this->add_query . " and " . $this->orderby . ">='" . mbm_ipak\tools::to_miladi($x . "/1/1") . "' and " . $this->orderby . "<='" . mbm_ipak\tools::to_miladi($x . "/12/30") . "'";
                    $rows = $wpdb->get_results($this->query, 'ARRAY_A');
                    $chart_labels[] = $x;
                    $chart_data[] = $rows[0]["cnt"];
                    $excel_data[] = array("title" => $x, "val" => $rows[0]["cnt"]);
                }
            }
        } else {
            $query = "select * from admin_admin_year where id=:id ";
            $rows = $wpdb->get_results($this->query, 'ARRAY_A');

            $year = $year_id;
            if (count($rows) > 0) {
                $year = $rows[0]["content"];
            }
            $months = mbm_ipak\tools::get_range_month($year);
            foreach ($months as $month) {
                $query = " select " . $this->query_cnt . " as cnt from " . $this->model . " where 1=1 and " . $this->add_query . " " . $this->orderby . ">='" . $TR_tools->to_miladi($month["from"]) . "' and " . $this->orderby . "<='" . $TR_tools->to_miladi($month["to"]) . "'";

                $rows = $wpdb->get_results($this->query, 'ARRAY_A');
                $chart_labels[] = $month["title"];
                $chart_data[] = $rows[0]["cnt"];
                $excel_data[] = array("title" => $month["title"], "val" => $rows[0]["cnt"]);
            }
        }
        $this->Data["MyData"] = $excel_data;

        $this->Data["ChartLabels"] = mbm_ipak\tools::json_encode($chart_labels);
        $this->Data["ChartData"] = mbm_ipak\tools::json_encode($chart_data);
    }
    public function view()
    {
?>
        <form method="post">
            <div class="panel panel-info col-md-12">
                <div class="panel-heading">
                    فیلتر گزارش
                </div>
                <div class="panel-body">
                    <div class="row">
                        <?php

                        ?>
                    </div>
                    <label class="red">اگر سال را خالی بگذارید و اعمال فیلتر را انتخاب نمائید گزارش همه سال ها می آید</label>
                </div>
                <div class="panel-footer col-md-6">
                    <button class="btn btn-primary">اعمال فیلتر</button>
                </div>
            </div>
        </form>
        <div class="panel panel-info col-md-6">
            <div class="panel-heading">
                <?php echo 'نمودار میله ای ' . $this->Data["ChartTitle"]; ?>
            </div>
            <div class="panel-body">
                <div id="canvas-panel"></div>
            </div>
        </div>
        <div class="panel panel-info col-md-6">
            <div class="panel-heading">
                <?php echo 'نمودار دایره ای ' . $this->Data["ChartTitle"]; ?>
            </div>
            <div class="panel-body">
                <div id="canvas-panel-1"></div>
            </div>
        </div>
        <div class="panel panel-info col-md-6">
            <div class="panel-heading">
                <?php echo '  گزارش ' . $this->Data["ChartTitle"]; ?>
            </div>
            <div class="panel-body">
                <div id="canvas-panel-2">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>ردیف</th>
                                <th>عنوان</th>
                                <th>مقدار</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $sum = 0;
                            $index = 0;
                            foreach ($this->Data["MyData"] as $item) {
                                $index++;
                                $sum = $sum + $item["val"];
                                echo '<tr>';
                                echo '<td>' . $index . '</td>';
                                echo '<td>' . $item["title"] . '</td>';
                                echo '<td>' . number_format($item["val"]) . '</td>';

                                echo '</tr>';
                            }
                            echo '<tr>';
                            echo '<td>جمع</td>';
                            echo '<td></td>';
                            echo '<td>' . number_format($sum) . '</td>';
                            echo '</tr>';
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    <?php
    }
    public function custom_scripts()
    {
    ?>
        <script>
            function drow_chart_report() {
                var points_chart_label = <?php echo $this->Data["ChartLabels"]; ?>;
                var points_chart_val = <?php echo $this->Data["ChartData"]; ?>;

                var name_canvas = 'myChart1';
                $('#canvas-panel').html('<canvas id="' + name_canvas + '" width="900" height="400"></canvas>');

                drow_chart(name_canvas, " ", points_chart_label, points_chart_val);

                var name_canvas1 = 'myChart2';
                $('#canvas-panel-1').html('<canvas id="' + name_canvas1 + '" width="900" height="400"></canvas>');
                drow_chart_cyc(name_canvas1, " ", points_chart_label, points_chart_val);

            }
            drow_chart_report();
        </script>
<?php
    }
}

$MBM_Ipak_Report = new MBM_Ipak_Report;


add_action('admin_enqueue_scripts', array($MBM_Ipak_Report, "scripts"));

add_action('admin_footer', array($MBM_Ipak_Report, "custom_scripts"));
