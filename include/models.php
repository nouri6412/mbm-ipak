<?php
class MBM_Ipak_Models
{
    var $models=[];
    public function __construct()
    {
        foreach (glob(MBM_IPAK_Include."models/*.php") as $filename)
        {
            include $filename;
        }
    }
    public function get_model($model)
    {
        if(isset($this->models[$model]))
        {
            return $this->models[$model];
        }
        return [];
    }
    
}