<?php
class MBM_Ipak_Entity extends MBM_Ipak_Base_Class
{
    var $model_type = '';
    var $opt = 'list';

    public function __construct($type, $op = 'list')
    {
        $this->model_type = $type;
        $this->opt = $op;
    }
    public function render()
    {
        $this->view('model/insert');
    }

    public function post()
    {
    }


}
