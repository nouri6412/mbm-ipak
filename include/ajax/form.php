<?php
class MBM_Ipak_Ajax_Form
{
    function form()
    {
        $model_name = $_POST["model_name"];
        $MBM_Ipak_Models = new MBM_Ipak_Models;

        $model = $MBM_Ipak_Models->get_model($model_name);

        $output = '<form>';
        $output .= '<div class="row">';

        foreach ($model["fields"] as $field) {
            $output .= $this->field_form($field);
        }

        $output .= '</div>';
        $output .= '</form>';

        echo json_encode([
            'success'       => true,
            'html'          => $output,
            'max_num_pages' => 1
        ]);
        
        die();
    }
    function field_form($field)
    {
        if (isset($field["in_form"]) && $field["in_form"]) {
            if (isset($field["type"]) && $field["type"]) {
                if (isset($field["type"]["type"]) && $field["type"]["type"]) {
                    if ($field["type"]["type"] == "text") {
                        return $this->field_text($field);
                    }
                } else {
                    return $this->field_text($field);
                }
            }
        }
    }
    function field_text($field)
    {
        $class = "col-md-4";
        $label_title = $field["title"];

        if (isset($field["label"]) && $field["label"]) {
            $label_title = $field["label"];
        }

        $value = "";

        if (isset($field["value"]) && $field["value"]) {
            $value = $field["value"];
        }

        $type = [];

        if (isset($field["type"]) && $field["type"]) {
            $type = $field["type"];
        }

        if (isset($type["class"])) {
            $class = $type["class"];
        }

        $ret = '<div class="' . $class . '">';
        $ret .= '<label class="label-control">' . $label_title . '</label>';
        $ret .= '<input value="' . $value . '" class="form-control" />';
        $ret .= '<div>';

        return $ret;
    }
}
$MBM_Ipak_Ajax_Form = new MBM_Ipak_Ajax_Form;
//add_action( 'wp_ajax_nopriv_ajax_submit_like', 'submit' );
add_action('wp_ajax_ipak_hesab_model_form', array($MBM_Ipak_Ajax_Form, 'form'));
