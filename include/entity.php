<?php
class MBM_Ipak_Entity extends MBM_Ipak_Base_Class
{
    var $model = [];
    var $model_name="";
    var $opt = 'list';
    var $title_page = '';
    

    public function __construct($type, $op = 'list')
    {
        $this->model_name = $type;
        $this->opt = $op;
    }
    public function render()
    {
        global $wpdb, $ViewData;
        $this->model=$this->model_obj->model_obj;
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
