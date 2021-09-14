<?php
class MBM_Ipak_Entity extends MBM_Ipak_Base_Class
{
    var $model = [];
    var $model_name = "";
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
        $this->model = $this->model_obj->model_obj;

        $this->post();

        if ($this->opt == "list") {
            $this->view('model/list');
        } elseif ($this->opt == "create") {
            $this->view('model/form');
        }
    }

    public function post()
    {
        if (isset($_POST["submit_model"])) {
            $MBM_Ipak_Ajax_Form = new MBM_Ipak_Ajax_Form;
            $MBM_Ipak_Ajax_Form->submit($this->model);
        }
    }
}
