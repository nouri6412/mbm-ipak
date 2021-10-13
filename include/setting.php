<?php
class MBM_Ipak_Setting extends MBM_Ipak_Base_Class
{


    public function __construct()
    {

    }
    
    public function render()
    {
       
        $this->post();

        $this->view('public/setting');
    }

    public function post()
    {
        global $MBM_Ipak_Core;
        if (isset($_POST["submit_model"])) {
            // $MBM_Ipak_Core->add_alert( "نباید خالی بماند", "success");
            // $MBM_Ipak_Core->add_alert( "نباید خالی بماند", "danger");
        }
    }
}
