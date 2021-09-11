<?php

class MBM_Ipak_Sanad_Hooks
{
    public function insert($insert_id, $model_id, $title, $values)
    {
        // var_dump($values);
        global $wpdb;

        if ($model_id == 5) {
            $table     = $wpdb->prefix . "hesab_sanad";

            $query_string       = $wpdb->prepare("insert into $table( `sanad_date`, `description`, `hesab_model_id`, `bed`, `bes`) VALUES (%s,%s, %d,%d,%d)", array($values["sanad_date_miladi"]["value"], $values["description"]["value"], $insert_id, 0, $values["mablagh"]["value"]));
            $query_result       = $wpdb->query($query_string);
            $id =  $wpdb->insert_id;
        }
    }

    public function update($id, $model_id, $title, $values)
    {
        // var_dump($values);
        global $wpdb;

        if ($model_id == 5) {
            $table     = $wpdb->prefix . "hesab_sanad";

            $query_string       = $wpdb->prepare("update $table set sanad_date=%s,description=%s,bed=%d,bes=%d where hesab_model_id=%d ", array($values["sanad_date_miladi"]["value"], $values["description"]["value"], 0, $values["mablagh"]["value"], $id));
            //  echo $query_string ;

            $query_result       = $wpdb->query($query_string);
            $id =  $wpdb->insert_id;
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
