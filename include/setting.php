<?php
class MBM_Ipak_Setting extends MBM_Ipak_Base_Class
{
    public $_woo_transition = "0";

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
        $page = '';
        if (!empty($_REQUEST['page'])) {
            $page = $_REQUEST['page'];
        }   
        if (isset($_POST["submit_model"])) {
            
            if (isset($_POST["chk-woo-to-ipak-sanad"])) {
                
                $search_main_table = sanitize_text_field($_POST["chk-woo-to-ipak-sanad"]);
                if (sanitize_option($page . "_woo_transition", $search_main_table)) {
                    update_option($page . "_woo_transition", $search_main_table);
                    $MBM_Ipak_Core->add_alert( "تغییرات با موفقیت اعمال شد", "success");
                }
                else
                {
                    update_option($page . "_woo_transition", '0');
                    $MBM_Ipak_Core->add_alert( "خطایی رخ داده است" , "danger");
                }
            }else{
                update_option($page . "_woo_transition", '0');
                $MBM_Ipak_Core->add_alert( "تغییرات با موفقیت اعمال شد", "success");
            } 
        }
        $this->_woo_transition = esc_sql(get_option($page . "_woo_transition"));
    }
}
