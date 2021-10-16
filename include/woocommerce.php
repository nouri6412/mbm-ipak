<?php
class MBM_Ipak_Woocommerce extends MBM_Ipak_Base_Class
{


    public function __construct()
    {
    }

    public function so_payment_complete($order_id)
    {
        $MBM_Ipak_Setting = new MBM_Ipak_Setting();

        $order = wc_get_order($order_id);
        $user = $order->get_user();

        if ($user) {
            if ($MBM_Ipak_Setting->get_setting("_woo_transition") == 1) {
                
            }
        }
    }
}

$MBM_Ipak_Woocommerce = new MBM_Ipak_Woocommerce;
add_action('woocommerce_payment_complete', array($MBM_Ipak_Woocommerce, 'so_payment_complete'), 10, 1);
