<?php
class MBM_Ipak_Woocommerce extends MBM_Ipak_Base_Class
{


    public function __construct()
    {
    }

    public function so_payment_complete($order_id)
    {
        $MBM_Ipak_Setting = new MBM_Ipak_Setting();

        if ($MBM_Ipak_Setting->get_setting("_woo_transition") == 1) {

            $order = wc_get_order($order_id);
            $user = $order->get_user();
            $price =  $order->get_total();
            
            if ($user) {

                global $wpdb;
                $table     = $wpdb->prefix . "hesab_sanad";
                $description = sprintf( 'نام مشتری: %s %s شماره سفارش: %d' , $user->first_name , $user->last_name , $order_id );
                $query_string       = $wpdb->prepare("insert into $table( `sanad_date`, `description`, `hesab_model_id`, `bed`, `bes`,`model_id`) VALUES (%s,%s, %d,%d,%d,%d)", array(date('Y-m-d'), $description, $order_id, $price, 0, -1));
                $query_result       = $wpdb->query($query_string);

                $query_string       = $wpdb->prepare("insert into $table( `sanad_date`, `description`, `hesab_model_id`, `bed`, `bes`,`model_id`) VALUES (%s,%s, %d,%d,%d,%d)", array(date('Y-m-d'), $description, $order_id, $price, 0, -2));
                $query_result       = $wpdb->query($query_string);

                $query_string       = $wpdb->prepare("insert into $table( `sanad_date`, `description`, `hesab_model_id`, `bed`, `bes`,`model_id`) VALUES (%s,%s, %d,%d,%d,%d)", array(date('Y-m-d'), $description, $order_id, 0, $price, -3));
                $query_result       = $wpdb->query($query_string);
            }
        }
    }
}

$MBM_Ipak_Woocommerce = new MBM_Ipak_Woocommerce;
add_action('woocommerce_checkout_order_processed', array($MBM_Ipak_Woocommerce, 'so_payment_complete'), 10, 1);
