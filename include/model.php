<?php
if (!class_exists('WP_List_Table')) {
    require_once(ABSPATH . 'wp-admin/includes/class-wp-list-table.php');
}

class MBM_Ipak_Models_List extends WP_List_Table
{

    var $model_table_name = '';
    var $model = '';
    var $model_obj = '';
    var $primary_key = '';
    var $columns = [];
    var $where = "";
    var $data_model;
    var $sql_main = "";
    var $sql_count;
    var $is_search = false;
    var $text_search = '';
    /** Class constructor */
    public function __construct($params = [])
    {
        $this->model              = $params["model"];
        $this->model_obj          = $params["model_obj"];
        $this->model_table_name   = $params["model_table_name"];
        $this->where              = $params["where"];
        //  echo $this->where;
        $this->primary_key        = $this->model_obj["primary_key"];
        $this->columns            = $this->model_obj["fields"];

        // $MBM_Ipak_Models = new MBM_Ipak_Models;
        $this->data_model = $this->model_obj;


        parent::__construct([
            'singular' => __('', 'sp'), //singular name of the listed records
            'plural'   => __('' . 's', 'sp'), //plural name of the listed records
            'ajax'     => false //does this table support ajax?
        ]);
    }


    /**
     * Retrieve customers data from the database
     *
     * @param int $per_page
     * @param int $page_number
     *
     * @return mixed
     */
    public  function get_models()
    {

        global $wpdb;

        $result = $wpdb->get_results($this->sql_main, 'ARRAY_A');
        return $result;
    }

    function get_sql($per_page = 5, $page_number)
    {
        $sql = "";
        $field_query = "";
        $vir = "";

        $table_name = $this->model_table_name . "_meta";

        $search = " and ( ";
        $vir_search = "";


        if (isset($_POST["search-main-table"])) {
            update_option($_REQUEST["page"] . "_search", trim($_POST["search-main-table"]));
        }

        $this->text_search = trim(get_option($_REQUEST["page"] . "_search"));

        if (strlen($this->text_search) > 0) {
            $this->is_search = true;
        }
        else
        {
            $this->is_search = false; 
        }

        foreach ($this->data_model["fields"] as $field) {
            if (isset($field["in_table"]) && $field["in_table"]) {
                if ($this->get_type($field) == "select") {
                    $table = $field["type"]["select"]["model"];
                    $tit = "met." . $field["type"]["select"]["label"];
                    
                    if(!isset($field["is_title"]))
                    {
                        $tit = "meti." . $field["type"]["select"]["label"];
                        $field_query .= $vir . "(select $tit from $table as meti where meti.id=(select met.value_meta from $table_name as met where met.model_id =tb.id and met.key_meta='" . $field["title"] . "' limit 1)) as " . $field["title"];
                    }
                    else
                    {
                        $field_query .= $vir . "(select $tit from $table as met where met.id=tb.title) as " . $field["title"];
                    }

                    if ($this->is_search) {
                        $search = $search . $vir_search . " " . $field["title"] . " like '%" . $this->text_search . "%'";
                    }
                } else if ((isset($field["is_title"]) && $field["is_title"]) || (isset($field["is_primary"]) && $field["is_primary"])) {
                    $field_query .= $vir . $field["title"];

                    if ($this->is_search) {
                        $search = $search . $vir_search . " " . $field["title"] . " like '%" . $this->text_search . "%'";
                    }
                } else {
                    $field_query .= $vir . "(select met.value_meta from $table_name as met where met.model_id =tb.id and met.key_meta='" . $field["title"] . "' limit 1) as " . $field["title"];
                    if ($this->is_search) {
                        $search = $search . $vir_search . " " . $field["title"] . " like '%" . $this->text_search . "%'";
                    }
                }
                $vir = ",";

                if ($this->is_search) {
                    $vir_search = " or ";
                }
            }
        }



        if ($search == " and ( ") {
            $search = "";
        } else {
            $search = $search . " )";
        }




        $sql = "select * from (SELECT $field_query FROM {$this->model_table_name} as tb where 1=1 $this->where) as tb_all" . ' where 1=1 ' . $search;

        $sql_count = "select count(*) from (SELECT $field_query FROM {$this->model_table_name} as tb where 1=1 $this->where) as tb_all" . ' where 1=1 ' . $search;

        //echo $sql;

        if (!empty($_REQUEST['orderby'])) {
            $sql .= ' ORDER BY ' . esc_sql($_REQUEST['orderby']);
            $sql .= !empty($_REQUEST['order']) ? ' ' . esc_sql($_REQUEST['order']) : ' ASC';
        }

        $sql .= " LIMIT $per_page";
        $sql .= ' OFFSET ' . ($page_number - 1) * $per_page;

        $this->sql_main = $sql;



        $this->sql_count = $sql_count;
    }

    function get_type($field)
    {
        if (isset($field["type"]) && isset($field["type"]["type"])) {
            return $field["type"]["type"];
        }

        return "text";
    }

    /**
     * Delete a customer record.
     *
     * @param int $id customer ID
     */
    public  function delete_model($id)
    {
        global $wpdb;

        do_action($this->model_table_name . "_before_delete", $id);

        $wpdb->delete(
            "{$this->model_table_name}",
            [$this->primary_key => $id],
            ['%d']
        );

        $table_meta = $this->model_table_name . "_meta";

        $query_string       = $wpdb->prepare("delete from  $table_meta where model_id=%d", array($id));
        $query_result       = $wpdb->query($query_string);

        do_action($this->model_table_name . "_after_delete", $id);
    }


    /**
     * Returns the count of records in the database.
     *
     * @return null|string
     */
    public  function record_count()
    {
        global $wpdb;



        return $wpdb->get_var($this->sql_count);
    }


    /** Text displayed when no customer data is available */
    public function no_items()
    {
        _e('نتیجه ای یافت نشد', 'sp');
    }


    /**
     * Render a column when no column specific method exist.
     *
     * @param array $item
     * @param string $column_name
     *
     * @return mixed
     */
    public function column_default($item, $column_name)
    {
        switch ($column_name) {
            case 'title':
                return $item[$column_name];
            default:
                return print_r($item[$column_name], true); //Show the whole array for troubleshooting purposes
        }
    }

    /**
     * Render the bulk edit checkbox
     *
     * @param array $item
     *
     * @return string
     */
    function column_cb($item)
    {
        return sprintf(
            '<input type="checkbox" name="bulk-delete[]" value="%s" />',
            $item[$this->primary_key]
        );
    }


    /**
     * Method for name column
     *
     * @param array $item an array of DB data
     *
     * @return string
     */
    function column_id($item)
    {

        $delete_nonce = wp_create_nonce('sp_delete_' . $this->model);

        $title = '<strong>' . $item['id'] . '</strong>';

        $actions = [
            'delete' => sprintf('<a href="?page=%s&action=%s&' . $this->model . '=%s&_wpnonce=%s">حذف</a>', esc_attr($_REQUEST['page']), 'delete', absint($item[$this->primary_key]), $delete_nonce),
            'edit'   => '<a onclick="ipak_hesab_model_form(\'' . $this->model_obj["name"] . '\',' . absint($item[$this->primary_key]) . ');" data-toggle="modal" data-target="#ipak-model-form" href="#">ویرایش</a>'
        ];

        return $title . $this->row_actions($actions);
    }


    /**
     *  Associative array of columns
     *
     * @return array
     */
    function get_columns()
    {
        $columns = [
            'cb'      => '<input type="checkbox" />'
        ];

        foreach ($this->columns as $col) {
            if ($col["title"] != $this->primary_key || 1 == 1) {
                $columns[$col["title"]] = $col["label"];
            }
        }
        return $columns;
    }


    /**
     * Columns to make sortable.
     *
     * @return array
     */
    public function get_sortable_columns()
    {
        $sortable_columns = [];

        foreach ($this->columns as $col) {
            $sortable_columns[$col["title"]] = array($col["title"], $col["sortable"]);
        }

        return $sortable_columns;
    }

    /**
     * Returns an associative array containing the bulk action
     *
     * @return array
     */
    public function get_bulk_actions()
    {
        $actions = [
            'bulk-delete' => 'حذف'
        ];

        return $actions;
    }


    /**
     * Handles data query and filter, sorting, and pagination.
     */
    public function prepare_items()
    {

        $sql_main = "";
        $sql_count = "";
        $this->_column_headers = $this->get_column_info();

        /** Process bulk action */
        $this->process_bulk_action();

        $per_page     = $this->get_items_per_page($this->model . 's' . '_per_page', 5);
        $current_page = $this->get_pagenum();
        $this->get_sql($per_page, $current_page);
        $total_items  = $this->record_count($sql_count);

        $this->set_pagination_args([
            'total_items' => $total_items, //WE have to calculate the total number of items
            'per_page'    => $per_page //WE have to determine how many items to show on a page
        ]);

        $this->items = $this->get_models();
    }

    public function process_bulk_action()
    {

        //Detect when a bulk action is being triggered...
        if ('delete' === $this->current_action()) {

            // In our file that handles the request, verify the nonce.
            $nonce = esc_attr($_REQUEST['_wpnonce']);

            if (!wp_verify_nonce($nonce, 'sp_delete_' . $this->model)) {
                die('Go get a life script kiddies');
            } else {
                $this->delete_model(absint($_GET[$this->model]));

                // esc_url_raw() is used to prevent converting ampersand in url to "#038;"
                // add_query_arg() return the current url
                // wp_redirect(esc_url_raw(add_query_arg()));
                // exit;
            }
        }

        // If the delete bulk action is triggered
        if ((isset($_POST['action']) && $_POST['action'] == 'bulk-delete')
            || (isset($_POST['action2']) && $_POST['action2'] == 'bulk-delete')
        ) {

            $delete_ids = esc_sql($_POST['bulk-delete']);

            // loop over the array of record IDs and delete them
            foreach ($delete_ids as $id) {
                $this->delete_model($id);
            }

            // esc_url_raw() is used to prevent converting ampersand in url to "#038;"
            // add_query_arg() return the current url
            // wp_redirect(esc_url_raw(add_query_arg()));
            //  exit;
        }
    }
}
