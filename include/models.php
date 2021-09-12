<?php
class MBM_Ipak_Models
{
    var $models=[];
    public function __construct()
    {
        global $wpdb;
        foreach (glob(MBM_IPAK_Include."models/*.php") as $filename)
        {
            include $filename;
        }
    }
    public function get_model($model)
    {
        if(isset($this->models[$model]))
        {
            $mod=apply_filters("filter_mbm_ipak_get_model_".$model,$this->models[$model]);
            return $mod;
        }
        return [];
    }
    
}