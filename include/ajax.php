<?php
class MBM_Ipak_Ajax
{
    function model_insert()
    {
        $output = 'ok';
    
        echo json_encode( [
            'success'       => true,
            'html'          => $output,
            'max_num_pages' => 1
        ] );
        die();
    }
}
$MBM_Ipak_Ajax=new MBM_Ipak_Ajax;
//add_action( 'wp_ajax_nopriv_ajax_submit_like', 'submit' );
add_action( 'wp_ajax_ipak_hesab_model_insert', array($MBM_Ipak_Ajax,'model_insert') );