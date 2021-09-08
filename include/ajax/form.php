<?php
class MBM_Ipak_Ajax_Form
{
    function form()
    {
        global $wpdb;
        $model_name = $_POST["model_name"];
        $model_id = $_POST["model_id"];
        $MBM_Ipak_Models = new MBM_Ipak_Models;
        $item_edit = [];
        $output='';

        if ($model_id > 0) {
            $table     = $wpdb->prefix . "hesab_model";
            $query_string       = $wpdb->prepare("select * from $table where id=%d", array($model_id));
            $items       = $wpdb->get_results($query_string, ARRAY_A);
            if($items>0)
            {
                $item_edit=$items[0];

                $table     = $wpdb->prefix . "hesab_model_meta";
                $query_string       = $wpdb->prepare("select * from $table where model_id=%d", array($model_id));
                $items_meta       = $wpdb->get_results($query_string, ARRAY_A);

                foreach($items_meta  as $item)
                {
                   // $output .= 'salam '.$item["key_meta"].' '.$item["value_meta"].'<br>';
                    $item_edit[$item["key_meta"]]=$item["value_meta"];
                }
            }
        }

        $model = $MBM_Ipak_Models->get_model($model_name);

        $output .= '<form method="post" action="' . esc_html(admin_url('admin.php')) . '?page=' . $_POST["page"] . '" class="model-form">';
        $output .= '<div class="row">';

        foreach ($model["fields"] as $field) {
            if(count($item_edit)>0 && isset($item_edit[$field["title"]]))
            {
                $field["value"]=$item_edit[$field["title"]];
            }
            $output .= $this->field_form($field);
        }

        $output .= '<div class="col-md-12">'
            . '<input name="submit_model" class="btn btn-primary" type="submit" value="ذخیره" />'
            . '</div>';

        $output .= '</div>';
        $output .= '</form>';

        echo json_encode([
            'success'       => true,
            'html'          => $output
        ]);

        die();
    }
    function field_form($field)
    {
        if (isset($field["in_form"]) && $field["in_form"]) {

            if (isset($field["is_primary"]))
            {
                $field["type"] = [];
                $field["type"]["type"] = "hidden";
                return $this->field_hidden($field);
            }
            else if (isset($field["type"]) && $field["type"]) {
                if (isset($field["type"]["type"]) && $field["type"]["type"]) {
                    if ($field["type"]["type"] == "text") {
                        return $this->field_text($field);
                    } else if ($field["type"]["type"] == "number") {
                        return $this->field_text($field);
                    } else if ($field["type"]["type"] == "textarea") {
                        return $this->field_textarea($field);
                    }
                    else if ($field["type"]["type"] == "date") {
                        return $this->field_date($field);
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

    function field_hidden($field)
    {
        $values = $this->get_values($field);

        $ret = '<input id="' . $field["title"] . '" name="' . $field["title"] . '" type="hidden" value="' . $values["value"] . '" class="form-control ' . $values["input_class"] . '" />';


        return $ret;
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

    function field_date($field)
    {
        $values = $this->get_values($field);

        $ret = '<div class="' . $values["class"] . ' form-group">';
        $ret .= '<label class="label-control">' . $values["label_title"] . '</label>';

        if(strlen($values["value"])==0)
        {
            $values["value"] = mbm_ipak\tools::to_shamsi(date('Y-m-d', strtotime(date("Y-m-d") . ' - 0 days')));
        }


        $ret .= '<input onclick="Mh1PersianDatePicker.Show(this,'."'".$values["value"]."'".',window.holidays)" id="' . $field["title"] . '" name="' . $field["title"] . '" ' .  $values["type_field"] . ' value="' . $values["value"] . '" class="form-control ' . $values["input_class"] . '" />';
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
        $is_true = true;
        $primary_value=0;
        $primary_key='';
        $values = [];

        
        foreach ($model["fields"] as $field) {
            if (isset($field["in_form"]) && $field["in_form"]) {
                if (isset($_POST[$field["title"]])) {
                    $value = trim($_POST[$field["title"]]);

                    if (isset($field["is_primary"]) && $field["is_primary"]) {
                        $primary_value=$value;
                        $primary_key=$field["title"];
                    }
                    else if (isset($field["is_title"]) && $field["is_title"]) {
                        $title = $value;
                    } else {
                        $values[] = ["key" => $field["title"], "value" => $value];
                    }
                    if (isset($field["is_require"]) && $field["is_require"] && strlen($value) == 0) {
                        $is_true = false;
                        $MBM_Ipak_Core->add_alert($field["label"] . " " . "نباید خالی بماند", "danger");
                    }
                }
            }
        }
        if ($is_true) {
            $table     = $wpdb->prefix . "hesab_model";
             
            if($primary_value==0)
            {
                $query_string       = $wpdb->prepare("insert into $table(type_id,title) values(%d,%s)", array($model["id"], $title));
                $query_result       = $wpdb->query($query_string);
                $insert_id =  $wpdb->insert_id;
    
                if ($insert_id > 0) {
                    $table_meta=$table."_meta";
                    foreach ($values as $key => $item) {
                        if (strlen($item["value"]) > 0) {
                            $query_string       = $wpdb->prepare("insert into $table_meta(model_id,key_meta,value_meta) values(%d,%s,%s)", array($insert_id, $item["key"], $item["value"]));
                            $query_result       = $wpdb->query($query_string);
                        }
                    }
    
                    $MBM_Ipak_Core->add_alert("با موفقیت ثبت شد " . " " . $insert_id, "success");
                } else {
                    $MBM_Ipak_Core->add_alert("خطا در ثبت اطلاعات دوباره امتحان فرمائید " . " " . $insert_id, "danger");
                }
            }
            else
            {
               // $query_result= $wpdb->update($table, array("title"=>$title),  array("id"=>$primary_value) );

                $query_string       = $wpdb->prepare("update $table set title=%s where $primary_key=%d", array($title,$primary_value));
                $query_result       = $wpdb->query($query_string);
              //  if($query_result>0)
                {
                    $table_meta=$table."_meta";

                    foreach ($values as $key => $item) {

                        $sql       = $wpdb->prepare("select model_id from $table_meta where model_id=%d and key_meta=%s", array($primary_value, $item["key"]));
                        $result = $wpdb->get_results($sql, 'ARRAY_A');

                        if (strlen($item["value"]) > 0 || count($result) > 0) {  

                            if(count($result)==0)
                            {
                                $query_string       = $wpdb->prepare("insert into $table_meta(model_id,key_meta,value_meta) values(%d,%s,%s)", array($primary_value, $item["key"], $item["value"]));
                                $query_result       = $wpdb->query($query_string);
                            }
                            else
                            {
                                if(strlen($item["value"])==0)
                                {
                                  $query_string       = $wpdb->prepare("delete from  $table_meta where model_id=%d and key_meta=%s", array($primary_value, $item["key"]));
                                  $query_result       = $wpdb->query($query_string);
                                }
                                else
                                {
                                    $query_string       = $wpdb->prepare("update $table_meta set value_meta =%s where model_id=%d and key_meta=%s", array($item["value"],$primary_value, $item["key"]));
                                    $query_result       = $wpdb->query($query_string);
                                }
                            }
                        }
                    }
    
                    $MBM_Ipak_Core->add_alert("با موفقیت ثبت شد " . " " . $query_result, "success");
                }
            }
        }
        
    }
}
$MBM_Ipak_Ajax_Form = new MBM_Ipak_Ajax_Form;
//add_action( 'wp_ajax_nopriv_ajax_submit_like', 'submit' );
add_action('wp_ajax_ipak_hesab_model_form', array($MBM_Ipak_Ajax_Form, 'form'));
