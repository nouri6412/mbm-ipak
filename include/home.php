<?php
class MBM_Ipak_Home extends MBM_Ipak_Base_Class
{
    public function __construct()
    {
       
    }

    function home()
    {
        $this->view("home/home");
    }
}