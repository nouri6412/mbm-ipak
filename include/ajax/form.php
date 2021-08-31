<?php
class MBM_Ipak_Ajax_Form
{
    function form()
    {
        $model_name = $_POST["model_name"];
        $MBM_Ipak_Models = new MBM_Ipak_Models;

        $model = $MBM_Ipak_Models->get_model($model_name);

        $output = '<form method="post" action="' . esc_html(admin_url('admin.php')) . '?page=' . $_POST["page"] . '" class="model-form">';
        $output .= '<div class="row">';

        foreach ($model["fields"] as $field) {
            $output .= $this->field_form($field);
        }

        $output .= '<div class="col-md-12">'
            . '<input name="submit_model" class="btn btn-primary" type="submit" value="ذخیره" />'
            . '</div>';

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
                    } else if ($field["type"]["type"] == "number") {
                        return $this->field_text($field);
                    } else if ($field["type"]["type"] == "textarea") {
                        return $this->field_textarea($field);
                    }
                } else {
                    $field["type"]["type"] = "text";
                    return $this->field_text($field);
                }
            } else {
                $field["type"] = [];
                $field["type"]["type"] = "text";
                return $this->field_text($field);
            }
        }
    }
    function get_values($field)
    {
        $values = [];


        $values["label_title"] = $field["title"];

        if (isset($field["label"])) {
            $values["label_title"] = $field["label"];
        }

        $values["value"] = "";

        if (isset($field["value"])) {
            $values["value"] = $field["value"];
        }

        $values["type"] = [];

        if (isset($field["type"])) {
            $values["type"]  = $field["type"];
        }

        $values["class"] = "col-md-4";

        if (isset($values["type"]["class"])) {
            $values["class"] = $values["type"]["class"];
        }

        $values["type_field"] = '';

        if ($values["type"] == "number") {
            $values["type_field"]  = ' type="number" ';
        }

        $values["input_class"] = '';

        if (isset($values["type"]["input_class"])) {
            $values["input_class"] = $values["type"]["input_class"];
        }

        return $values;
    }

    function field_text($field)
    {
        $values = $this->get_values($field);

        $ret = '<div class="' . $values["class"] . ' form-group">';
        $ret .= '<label class="label-control">' . $values["label_title"] . '</label>';
        $ret .= '<input id="' . $field["title"] . '" name="' . $field["title"] . '" ' .  $values["type_field"] . ' value="' . $values["value"] . '" class="form-control ' . $values["input_class"] . '" />';
        $ret .= '</div>';

        return $ret;
    }

    function field_textarea($field)
    {
        $values = $this->get_values($field);

        $ret = '<div class="' . $values["class"] . ' form-group">';
        $ret .= '<label class="label-control">' . $values["label_title"] . '</label>';
        $ret .= '<textarea  id="' . $field["title"] . '" name="' . $field["title"] . '" ' .  $values["type_field"] . ' class="form-control ' . $values["input_class"] . '" >' . $values["value"] . '</textarea>';
        $ret .= '</div>';

        return $ret;
    }

    function submit($model)
    {
        global $wpdb, $MBM_Ipak_Core;
        $title = "";
        foreach ($model["fields"] as $field) {
            if (isset($field["in_form"]) && $field["in_form"]) {
                if (isset($_POST[$field["title"]])) {
                    if (isset($field["is_title"]) && $field["is_title"]) {
                        $title = $_POST[$field["title"]];
                    }
                }
            }
        }

        $table     = $wpdb->prefix . "hesab_model";

        $query_string       = $wpdb->prepare("insert into $table(type_id,title) values(%d,%s)", array($model["id"], $title));
        $query_result       = $wpdb->query($query_string);
        $insert_id=  $wpdb->insert_id;

        $MBM_Ipak_Core->add_alert("با موفقیت ثبت شد "." ".$insert_id,"success");
    }
}
$MBM_Ipak_Ajax_Form = new MBM_Ipak_Ajax_Form;
//add_action( 'wp_ajax_nopriv_ajax_submit_like', 'submit' );
add_action('wp_ajax_ipak_hesab_model_form', array($MBM_Ipak_Ajax_Form, 'form'));
