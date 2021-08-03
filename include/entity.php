<?php
class MBM_Ipak_Entity extends MBM_Ipak_Base_Class
{
    var $model = '';
    var $opt = 'list';
    var $model_obj;
    var $title_page='';

    public function __construct($type, $op = 'list')
    {
        $this->model = $type;
        $this->opt = $op;
    }
    public function render()
    {
        global $wpdb;
        if ($this->opt == "list") {
            $this->view('model/list');
        } elseif ($this->opt == "create") {
            $this->view('model/form');
        }
    }

    public function post()
    {
    }
}
