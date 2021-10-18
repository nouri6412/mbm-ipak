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

    function get_sql($per_page = 5, $page_number = 1, $all_data = false)
    {

        $data = mbm_ipak\tools::get_sql($per_page, $page_number, $all_data, $this->model_table_name, $this->data_model["fields"], $this->where);

        $this->sql_main = $data["sql"];

        $this->sql_count = $data["sql_count"];
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
        _e('نتیجه ای یافت نشد', 'mbm-ipak');
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

        $title = sprintf('<strong>%s</strong>', $item['id']);
        $actions = [];
        $page = isset($_REQUEST['page']) ? sanitize_text_field($_REQUEST['page']) : 1;

        if (!isset($this->model_obj["is_report"])) {
            $actions = [
                'delete' => sprintf('<a href="?page=%s&action=%s&%s=%s&_wpnonce=%s">حذف</a>', esc_attr($page), esc_attr('delete'), esc_attr($this->model), absint($item[$this->primary_key]), $delete_nonce),
                'edit'   => sprintf('<a onclick="ipak_hesab_model_form(\'%s\',%d);" type="button" data-bs-toggle="modal" data-bs-target="#ipak-model-form" href="#">ویرایش</a>', esc_attr($this->model_obj["name"]), esc_attr(absint($item[$this->primary_key])))
            ];
        }


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
        $actions = [];

        if (!isset($this->model_obj["is_report"])) {
            $actions = [
                'bulk-delete' => 'حذف'
            ];
        }


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
        if ('delete' === $this->current_action() && !empty($_REQUEST['_wpnonce'])) {

            // In our file that handles the request, verify the nonce.
            $nonce = esc_attr(sanitize_text_field($_REQUEST['_wpnonce']));

            if (!wp_verify_nonce($nonce, 'sp_delete_' . $this->model)) {
                die('Go get a life script kiddies');
            } else {
                if (isset($_GET[$this->model])) {
                    $this->delete_model(absint(sanitize_text_field($_GET[$this->model])));
                }

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

            $delete_ids = esc_sql(sanitize_text_field($_POST['bulk-delete']));

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
