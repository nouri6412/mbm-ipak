<?php

namespace mbm_ipak;

class tools
{
    public static  function Createfolder($path)
    {
        if (!file_exists($path)) {
            mkdir($path, 0777, true);
        }
    }
    public static  function deletefolder($path)
    {
        if (file_exists($path)) {
            self::deleteFolders($path);
        }
    }
    function validateDate($date, $format = 'Y-m-d H:i:s')
    {
        $d = DateTime::createFromFormat($format, $date);
        return $d && $d->format($format) == $date;
    }
    public static  function to_jalali($time, $format = 'Y/m/d')
    {
        $ex = explode('-', $time);
        // if (validateDate($time,$format)) 
        if (count($ex) > 1) {
            return jdate($format, strtotime($time));
        }
    }
    function render_php($action)
    {
        ob_start();
        include($path);
        $var = ob_get_contents();
        ob_end_clean();
        return $var;
    }
    function render_php_action($action)
    {
        ob_start();
        do_action('');
        $var = ob_get_contents();
        ob_end_clean();
        return $var;
    }
    public static function get_jalali_year($year = 0)
    {
        global $TR_tools;
        if ($year <= 0) {
            $year = $TR_tools->to_jalali(date('Y-m-d H:i:s'), "Y");
        }
        return $year;
    }
    public static  function get_range_month($year = 0)
    {
        global $TR_tools;
        if ($year <= 0) {
            $year = $TR_tools->to_jalali(date('Y-m-d H:i:s'), "Y");
        }
        $range = array();
        $range[] = array("title" => "فروردین", "from" => $year . "/1/1", "to" => $year . "/1/31");
        $range[] = array("title" => "اردیبهشت", "from" => $year . "/2/1", "to" => $year . "/2/31");
        $range[] = array("title" => "خرداد", "from" => $year . "/3/1", "to" => $year . "/3/31");
        $range[] = array("title" => "تیر", "from" => $year . "/4/1", "to" => $year . "/4/31");
        $range[] = array("title" => "مرداد", "from" => $year . "/5/1", "to" => $year . "/6/31");
        $range[] = array("title" => "شهریور", "from" => $year . "/6/1", "to" => $year . "/6/31");
        $range[] = array("title" => "مهر", "from" => $year . "/7/1", "to" => $year . "/7/30");
        $range[] = array("title" => "آبان", "from" => $year . "/8/1", "to" => $year . "/8/30");
        $range[] = array("title" => "آذر", "from" => $year . "/9/1", "to" => $year . "/9/30");
        $range[] = array("title" => "دی", "from" => $year . "/10/1", "to" => $year . "/10/30");
        $range[] = array("title" => "بهمن", "from" => $year . "/11/1", "to" => $year . "/11/30");
        $range[] = array("title" => "اسفند", "from" => $year . "/12/1", "to" => $year . "/12/30");
        return $range;
    }
    public static  function deleteFolders($path)
    {
        if (is_dir($path) === true) {
            if (file_exists($path)) {
                $files = array_diff(scandir($path), array('.', '..'));
                foreach ($files as $file)
                    self::deleteFolders(realpath($path) . '/' . $file);
                rmdir($path);
            }
            return true;
        } else if (is_file($path) === true) {
            if (file_exists($path)) {
                unlink($path);
            }
            return true;
        }
        return false;
    }
    public static function  site($s, $use_forwarded_host = false)
    {
        $ssl      = (!empty($s['HTTPS']) && $s['HTTPS'] == 'on');
        $sp       = strtolower($s['SERVER_PROTOCOL']);
        $protocol = substr($sp, 0, strpos($sp, '/')) . (($ssl) ? 's' : '');
        $port     = $s['SERVER_PORT'];
        $port     = ((!$ssl && $port == '80') || ($ssl && $port == '443')) ? '' : ':' . $port;
        $host     = ($use_forwarded_host && isset($s['HTTP_X_FORWARDED_HOST'])) ? $s['HTTP_X_FORWARDED_HOST'] : (isset($s['HTTP_HOST']) ? $s['HTTP_HOST'] : null);
        $host     = isset($host) ? $host : $s['SERVER_NAME'] . $port;
        return $protocol . '://' . $host;
    }
    public static  function full_url($s, $use_forwarded_host = false)
    {
        return  self::site($s, $use_forwarded_host) . $s['REQUEST_URI'];
    }
    public static function multiexplode($delimiters, $string)
    {

        $ready = str_replace($delimiters, $delimiters[0], $string);
        $launch = explode($delimiters[0], $ready);
        return  $launch;
    }
    public static function get_dirs($dir)
    {
        $pgs_route = glob($dir . '*');
        $flag_route = 0;
        $pgs_routes = array();
        foreach ($pgs_route as $pg) {
            $arr_route = explode('/', $pg);
            $cnt = count($arr_route) - 1;
            if (!isset($arr_route[$cnt])) {
                // continue;
            }
            $pgs_routes[$arr_route[$cnt]] = $arr_route[$cnt];
        }
        return $pgs_routes;
    }
    public static function to_miladi($val)
    {
        $arr = explode('/', $val);
        if (count($arr) < 2) {
            // return "0000-00-00";
            $arr = explode('/', '0000/00/00');
        }
        if (count($arr) > 1) {
            $res = jalali_to_gregorian($arr[0], $arr[1], $arr[2]);
            $year = $res[0];
            $month = $res[1];
            $day = $res[2];
            if (strlen($month) == 1) {
                $month = '0' .  $month;
            }
            if (strlen($day) == 1) {
                $day = '0' .  $day;
            }
            $tarikh = $year . '-' . $month . '-' . $day;
            return $tarikh;
        }
        return "0000-00-00";
    }
    function getGUID()
    {
        if (function_exists('com_create_guid')) {
            return com_create_guid();
        } else {
            mt_srand((float) microtime() * 10000); //optional for php 4.2.0 and up.
            $charid = strtoupper(md5(uniqid(rand(), true)));
            $hyphen = chr(45); // "-"
            $uuid = '' // "{"
                . substr($charid, 0, 8) . $hyphen
                . substr($charid, 8, 4) . $hyphen
                . substr($charid, 12, 4) . $hyphen
                . substr($charid, 16, 4) . $hyphen
                . substr($charid, 20, 12)
                . ''; // "}"
            $uuid . str_replace('{', '', $uuid);
            $uuid . str_replace('}', '', $uuid);
            return $uuid;
        }
    }
    public static function contains($needle, $haystack)
    {
        return strpos($haystack, $needle) !== false;
    }
    public static  function to_shamsi($val, $format = array())
    {
        $is_time = false;
        $mod = '/';
        if (isset($format["mod"])) {
            $mod = $format["mod"];
        }
        if (isset($format["is_time"])) {
            $is_time = $format["is_time"];
        }
        $arr1 = explode(' ', $val);
        $time = "";
        if (count($arr1) > 1) {
            $val = $arr1[0];
            $time = $arr1[1];
        }
        $arr = explode('-', $val);
        if (count($arr) < 2) {
            return "0000/00/00";
            $arr = explode('-', '0000-00-00');
        }
        $res = gregorian_to_jalali($arr[0], $arr[1], $arr[2]);
        $year = $res[0];
        $month = $res[1];
        $day = $res[2];
        if (strlen($month) == 1) {
            $month = '0' .  $month;
        }
        if (strlen($day) == 1) {
            $day = '0' .  $day;
        }
        $tarikh = $year . $mod . $month . $mod . $day;
        if ($is_time && strlen($time) > 0) {
            return $tarikh . " " . $time;
        }
        return $tarikh;
    }
    public static function array_orderby()
    {
        $args = func_get_args();
        $data = array_shift($args);
        foreach ($args as $n => $field) {
            if (is_string($field)) {
                $tmp = array();
                foreach ($data as $key => $row)
                    $tmp[$key] = $row[$field];
                $args[$n] = $tmp;
            }
        }
        $args[] = &$data;
        call_user_func_array('array_multisort', $args);
        return array_pop($args);
        //sample
        // $sorted = array_orderby($data,'edition', SORT_DESC);  // edition is name column
        //$sorted = array_orderby($data,'edition');
    }
    public static function json_encode($data = array())
    {
        $strJson = json_encode($data, JSON_UNESCAPED_UNICODE);
        return $strJson;
    }
    public static function json_decode($json)
    {
        $data = json_decode($json, JSON_UNESCAPED_UNICODE);
        return  $data;
    }
    public static function copy_array($data)
    {
        $ret = array();
        foreach ($data as $key => $item) {
            $ret[$key] = $item;
        }
        return $ret;
    }

    public static function get_model_from_url()
    {
        $model_parent = '';
        if (isset($_GET["page"])) {
            $page = sanitize_text_field($_GET["page"]);
            $arr = explode("-", $page);
            $model_parent = $arr[count($arr) - 1];
        }
        return $model_parent;
    }

    public static    function get_sql($per_page = 5, $page_number = 1, $all_data = false, $model_table_name, $data_field = [], $model_where)
    {
        $sql = "";
        $field_query = "";
        $vir = "";

        $table_name = $model_table_name . "_meta";

        $search = " and ( ";
        $vir_search = "";

        $page = '';

        if (!empty($_REQUEST['page'])) {
            $page = sanitize_text_field($_REQUEST['page']);
        }



        if (isset($_POST["search-main-table"])) {

            $search_main_table = sanitize_text_field($_POST["search-main-table"]);

            if (sanitize_option($page . "_search", $search_main_table)) {
                update_option($page . "_search", $search_main_table);
            } else {
                update_option($page . "_search", '');
            }
        }

        $text_search = esc_sql(get_option($page . "_search"));

        if (strlen($text_search) > 0) {
            $is_search = true;
        } else {
            $is_search = false;
        }

        foreach ($data_field as $field) {
            if (isset($field["in_table"]) && $field["in_table"]) {
                if (isset($field["query"])) {
                    $field_query .= $vir . $field["query"];
                } else 
            if (self::get_type($field) == "select") {
                    $table = $field["type"]["select"]["model"];
                    $tit = "met." . $field["type"]["select"]["label"];

                    if (!isset($field["is_title"])) {
                        $tit = "meti." . $field["type"]["select"]["label"];
                        $field_query .= $vir . "(select $tit from $table as meti where meti.id=(select met.value_meta from $table_name as met where met.model_id =tb.id and met.key_meta='" . $field["title"] . "' limit 1)) as " . $field["title"];
                    } else {
                        $field_query .= $vir . "(select $tit from $table as met where met.id=tb.title) as " . $field["title"];
                    }

                    if ($is_search) {
                        $search = $search . $vir_search . " " . $field["title"] . " like '%" . $text_search . "%'";
                    }
                } else if ((isset($field["is_title"]) && $field["is_title"]) || (isset($field["is_primary"]) && $field["is_primary"])) {
                    $field_query .= $vir . "tb." . $field["title"];

                    if ($is_search) {
                        $search = $search . $vir_search . " " . $field["title"] . " like '%" . $text_search . "%'";
                    }
                } else {
                    $field_query .= $vir . "(select met.value_meta from $table_name as met where met.model_id =tb.id and met.key_meta='" . $field["title"] . "' limit 1) as " . $field["title"];
                    if ($is_search) {
                        $search = $search . $vir_search . " " . $field["title"] . " like '%" . $text_search . "%'";
                    }
                }
                $vir = ",";

                if ($is_search) {
                    $vir_search = " or ";
                }
            }
        }

        if ($search == " and ( ") {
            $search = "";
        } else {
            $search = $search . " )";
        }

        $sql = "select distinct  * from (SELECT $field_query FROM {$model_table_name} as tb left join $table_name tb_meta on tb.id=tb_meta.model_id where 1=1 $model_where) as tb_all" . ' where 1=1 ' . $search;

        $sql_count = "select count(*) from (SELECT $field_query FROM {$model_table_name} as tb where 1=1 $model_where) as tb_all" . ' where 1=1 ' . $search;



        if (!empty($_REQUEST['orderby'])) {
            $orderby = sanitize_text_field($_REQUEST['orderby']);
            $order =
                $sql .= ' ORDER BY ' . esc_sql($orderby);

            $order = !empty($_REQUEST['order']) ?  sanitize_text_field($_REQUEST['order']) : '';

            if (strlen($order) == 0) {
                $sql .=  ' ASC';
            } else {
                $sql .= esc_sql($order);
            }
        }

        if (!$all_data) {
            $sql .= " LIMIT $per_page";
            $sql .= ' OFFSET ' . ($page_number - 1) * $per_page;
        }

       // echo $sql;
        return ["sql" => $sql, "sql_count" => $sql_count];
    }
    public static function get_type($field)
    {
        if (isset($field["type"]) && isset($field["type"]["type"])) {
            return $field["type"]["type"];
        }

        return "text";
    }
    public static function  CSV($filename, $headings, $data)
    {

        //Use tab as field separator
        $newTab  = "\t";
        $newLine  = "\n";

        $fputcsv  =  count($headings) ? '"' . implode('"' . $newTab . '"', $headings) . '"' . $newLine : '';

        // Loop over the * to export
        if (!empty($data)) {
            foreach ($data as $item) {
                $fputcsv .= '"' . implode('"' . $newTab . '"', $item) . '"' . $newLine;
            }
        }

        //Convert CSV to UTF-16
        $encoded_csv = mb_convert_encoding($fputcsv, 'UTF-16LE', 'UTF-8');

        // Output CSV-specific headers
        header('Set-Cookie: fileDownload=true; path=/'); //This cookie is needed in order to trigger the success window.
        header("Pragma: public");
        header("Expires: 0");
        header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
        header("Cache-Control: private", false);
        header("Content-Type: application/octet-stream");
        header("Content-Disposition: attachment; filename=\"$filename.csv\";");
        header("Content-Transfer-Encoding: binary");
        header('Content-Length: ' . strlen($encoded_csv));
        echo chr(255) . chr(254) . $encoded_csv; //php array convert to csv/excel

        exit;
    }
}
