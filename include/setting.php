<?php
class MBM_Ipak_Setting extends MBM_Ipak_Base_Class
{
    public $setting = array();

    public function __construct()
    {
        $str = get_option("mbm_ipak_setting");

        if (strlen($str) == 0) $str = '[]';

        $this->setting = json_decode($str);
    }

    public function render()
    {

        $this->post();
        $this->view('public/setting');
    }

    public function get_setting($key, $def = '')
    {
        if (isset($this->setting->$key)) {
            return $this->setting->$key;
        }
        return $def;
    }

    public function set_setting($key, $value, $def = '', $is_post = true)
    {

        if ($is_post) {
            if (isset($_POST[$key])) {
                $this->setting->$key = $value;
            } else {
                $this->setting->$key = $def;
            }
        } else {
            $this->setting->$key = $value;
        }
    }

    public function post()
    {

        if (isset($_POST["submit_model"])) {
            $this->set_setting("_woo_transition", 1, 0);

            if (isset($_POST["_CountPerPage"])) {
                $this->set_setting("_CountPerPage", sanitize_text_field($_POST["_CountPerPage"]), 10,false);
            }
            $this->save_setting();
        }
    }

    public function save_setting()
    {
        global $MBM_Ipak_Core;

        if (sanitize_option("mbm_ipak_setting", json_encode($this->setting))) {
            update_option("mbm_ipak_setting", json_encode($this->setting));
            $MBM_Ipak_Core->add_alert("تغییرات با موفقیت اعمال شد", "success");
        } else {
            $MBM_Ipak_Core->add_alert("خطایی رخ داده است", "danger");
        }
    }

    public function is_woocommerce_activated()
    {
        if (class_exists('woocommerce')) {
            return true;
        } else {
            return false;
        }
    }
}
