<?php
class MBM_Ipak_Shared extends MBM_Ipak_Base_Class
{
    public function footer()
    {
        $this->view('shared/footer');
    }
    public function header()
    {
        $this->view('shared/header');
    }
}

$MBM_Ipak_Shared = new MBM_Ipak_Shared;
add_action('admin_footer', array($MBM_Ipak_Shared, 'footer'));
add_action('admin_header', array($MBM_Ipak_Shared, 'header'));
