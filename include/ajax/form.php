<?php
class MBM_Ipak_Ajax_Form
{
    function form()
    {
        $model_name = $_POST["model_name"];
        $MBM_Ipak_Models = new MBM_Ipak_Models;

        $model = $MBM_Ipak_Models->get_model($model_name);

        $output = $model["label"];
        echo json_encode( [
            'success'       => true,
            'html'          => $output,
            'max_num_pages' => 1
        ] );
        die();
    }
}
$MBM_Ipak_Ajax_Form=new MBM_Ipak_Ajax_Form;
//add_action( 'wp_ajax_nopriv_ajax_submit_like', 'submit' );
add_action( 'wp_ajax_ipak_hesab_model_form', array($MBM_Ipak_Ajax_Form,'form') );