<?php
class MBM_Ipak_Base_Class
{
    var $ViewData=[];
    public function view($view)
    {
        $url = MBM_IPAK_View . $view . '.php';
        if (file_exists(stream_resolve_include_path($url))) {
            include $url;
        }
    }
}