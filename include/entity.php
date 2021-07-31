<?php
class MBM_Ipak_Entity
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
        echo $this->model_type.'</br>'.$this->opt;
    }

    public function post()
    {
    }
}
