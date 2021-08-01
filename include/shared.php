<?php
class MBM_Ipak_Shared extends MBM_Ipak_Base_Class
{
    public function footer()
    {
        $this->view('shared/footer');
    }
}

$MBM_Ipak_Shared = new MBM_Ipak_Shared;
add_action('admin_footer', array($MBM_Ipak_Shared, 'footer'));
