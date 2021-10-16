<?php
class MBM_Ipak_Woocommerce extends MBM_Ipak_Setting
{

    public function __construct()
    {
    }

    function so_payment_complete($order_id)
    {
        $order = wc_get_order($order_id);
        $user = $order->get_user();
        if ($user) {
            //$this->_woo_transition
        }
    }
}
$MBM_Ipak_Woocommerce = new MBM_Ipak_Woocommerce;
add_action('woocommerce_payment_complete', array($MBM_Ipak_Woocommerce, 'so_payment_complete'),10,1);
