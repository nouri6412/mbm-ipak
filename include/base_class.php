<?php
class MBM_Ipak_Base_Class
{
    var $ViewData=[];
    public function view($view,$base_url='')
    {
        $url = MBM_IPAK_View . $view . '.php';

        if(strlen($base_url)>0)
        {
            $url = $base_url . $view . '.php';
        }
        
        if (file_exists(stream_resolve_include_path($url))) {
            include $url;
        }
    }
}