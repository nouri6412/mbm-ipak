<?php

class MBM_Ipak_Sanad_Hooks
{
    public function insert($insert_id, $model_id, $title, $values)
    {
        // var_dump($values);
        global $wpdb;

        if ($model_id >= 5 && $model_id <= 10) {
            $table     = $wpdb->prefix . "hesab_sanad";

            $bed=0;
            $bes=0;

            if($model_id==5)
            {
                $bed=0;
                $bes=$values["mablagh"]["value"];
            }
           else if($model_id==6)
            {
                $bed=$values["mablagh"]["value"];
                $bes=0;
            }
           else if($model_id==7)
            {
                $bed=0;
                $bes=$values["mablagh"]["value"];
            }
            else if($model_id==8)
            {
                $bed=$values["mablagh"]["value"];
                $bes=0;
            }

            if ($model_id >= 5 && $model_id <= 8)
            {
                $query_string       = $wpdb->prepare("insert into $table( `sanad_date`, `description`, `hesab_model_id`, `bed`, `bes`,`model_id`) VALUES (%s,%s, %d,%d,%d,%d)", array($values["sanad_date_miladi"]["value"], $values["description"]["value"], $insert_id, $bed, $bes,$values["title"]["value"]));
                $query_result       = $wpdb->query($query_string);
            }
            else 
            {
                if($model_id==9)
                {
                    $bed=$values["mablagh"]["value"];
                    $bes=0;
                    $query_string       = $wpdb->prepare("insert into $table( `sanad_date`, `description`, `hesab_model_id`, `bed`, `bes`,`model_id`) VALUES (%s,%s, %d,%d,%d,%d)", array($values["sanad_date_miladi"]["value"], $values["description"]["value"], $insert_id, $bed, $bes,$values["contact"]["value"]));
                    $query_result       = $wpdb->query($query_string);

                    $bed=0;
                    $bes=$values["mablagh"]["value"];
                    $query_string       = $wpdb->prepare("insert into $table( `sanad_date`, `description`, `hesab_model_id`, `bed`, `bes`,`model_id`) VALUES (%s,%s, %d,%d,%d,%d)", array($values["sanad_date_miladi"]["value"], $values["description"]["value"], $insert_id, $bed, $bes,$values["title"]["value"]));
                    $query_result       = $wpdb->query($query_string);
                }
                else{
                    $bed=$values["mablagh"]["value"];
                    $bes=0;
                    $query_string       = $wpdb->prepare("insert into $table( `sanad_date`, `description`, `hesab_model_id`, `bed`, `bes`,`model_id`) VALUES (%s,%s, %d,%d,%d,%d)", array($values["sanad_date_miladi"]["value"], $values["description"]["value"], $insert_id, $bed, $bes,$values["title"]["value"]));
                    $query_result       = $wpdb->query($query_string);

                    $bed=0;
                    $bes=$values["mablagh"]["value"];
                    $query_string       = $wpdb->prepare("insert into $table( `sanad_date`, `description`, `hesab_model_id`, `bed`, `bes`,`model_id`) VALUES (%s,%s, %d,%d,%d,%d)", array($values["sanad_date_miladi"]["value"], $values["description"]["value"], $insert_id, $bed, $bes,$values["contact"]["value"]));
                    $query_result       = $wpdb->query($query_string);
                }

            }

            $id =  $wpdb->insert_id;
        }
    }

    public function update($id, $model_id, $title, $values)
    {
        // var_dump($values);
        global $wpdb;

        if ($model_id >= 5 && $model_id <= 10)  {

            $bed=0;
            $bes=0;

            if($model_id==5)
            {
                $bed=0;
                $bes=$values["mablagh"]["value"];
            }
           else if($model_id==6)
            {
                $bed=$values["mablagh"]["value"];
                $bes=0;
            }
           else if($model_id==7)
            {
                $bed=0;
                $bes=$values["mablagh"]["value"];
            }
            else if($model_id==8)
            {
                $bed=$values["mablagh"]["value"];
                $bes=0;
            }
            
            $table     = $wpdb->prefix . "hesab_sanad";

            if ($model_id >= 5 && $model_id <= 8)
            {
                $query_string       = $wpdb->prepare("update $table set sanad_date=%s,description=%s,bed=%d,bes=%d where hesab_model_id=%d ", array($values["sanad_date_miladi"]["value"], $values["description"]["value"], $bed, $bes, $id));
                //  echo $query_string ;
    
                $query_result       = $wpdb->query($query_string);
                $id =  $wpdb->insert_id;
            }
            else
            {
                if($model_id==9)
                {
                    $bed=$values["mablagh"]["value"];
                    $bes=0;
                    $query_string       = $wpdb->prepare("update $table set sanad_date=%s,description=%s,bed=%d,bes=%d where hesab_model_id=%d and model_id=%d", array($values["sanad_date_miladi"]["value"], $values["description"]["value"], $bed, $bes, $id,$values["contact"]["value"]));
                    $query_result       = $wpdb->query($query_string);

                    $bed=0;
                    $bes=$values["mablagh"]["value"];
                    $query_string       = $wpdb->prepare("update $table set sanad_date=%s,description=%s,bed=%d,bes=%d where hesab_model_id=%d and model_id=%d", array($values["sanad_date_miladi"]["value"], $values["description"]["value"], $bed, $bes, $id,$values["title"]["value"]));
                    $query_result       = $wpdb->query($query_string);
                }
                else{
                    $bed=0;
                    $bes=$values["mablagh"]["value"];
                    $query_string       = $wpdb->prepare("update $table set sanad_date=%s,description=%s,bed=%d,bes=%d where hesab_model_id=%d and model_id=%d", array($values["sanad_date_miladi"]["value"], $values["description"]["value"], $bed, $bes, $id,$values["contact"]["value"]));
                    $query_result       = $wpdb->query($query_string);

                    $bed=$values["mablagh"]["value"];
                    $bes=0;
                    $query_string       = $wpdb->prepare("update $table set sanad_date=%s,description=%s,bed=%d,bes=%d where hesab_model_id=%d and model_id=%d", array($values["sanad_date_miladi"]["value"], $values["description"]["value"], $bed, $bes, $id,$values["title"]["value"]));
                    $query_result       = $wpdb->query($query_string);
                }
            }
       


        }
    }

    public function delete($id)
    {
        // var_dump($values);
        global $wpdb;
        $table     = $wpdb->prefix . "hesab_sanad";

        $query_string       = $wpdb->prepare("delete from $table  where hesab_model_id=%d ", array($id));
        $query_result       = $wpdb->query($query_string);
    }

}

$table     = $wpdb->prefix . "hesab_model";

$MBM_Ipak_Sanad_Hooks = new MBM_Ipak_Sanad_Hooks;

add_action($table . "_after_insert", array($MBM_Ipak_Sanad_Hooks, "insert"), 10, 4);

add_action($table . "_after_update", array($MBM_Ipak_Sanad_Hooks, "update"), 10, 4);

add_action($table . "_after_delete", array($MBM_Ipak_Sanad_Hooks, "delete"), 10, 1);

add_filter($table . "_title_insert", array($MBM_Ipak_Sanad_Hooks, "filter_title"), 10, 3);
