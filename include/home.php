<?php
class MBM_Ipak_Home extends MBM_Ipak_Base_Class
{
    public function __construct()
    {
    }

    function home()
    {
        global $wpdb;

        $table = $wpdb->prefix . "hesab_model";
        $table_sanad = $wpdb->prefix . "hesab_sanad";

        $sql = "SELECT sum(san.bed)-sum(san.bes) as mablagh FROM $table as tb , $table_sanad as san WHERE
        tb.id=san.model_id and tb.type_id=1";


        $results = $wpdb->get_results($sql, 'ARRAY_A');

        $this->ViewData["bank"] = number_format($results[0]["mablagh"]);

        //
        $sql = "SELECT sum(san.bes) as mablagh FROM $table as tb , $table_sanad as san WHERE
        tb.id=san.model_id and tb.type_id=3";


        $results = $wpdb->get_results($sql, 'ARRAY_A');

        $this->ViewData["cost"] = number_format($results[0]["mablagh"]);

        $sql = "SELECT sum(san.bed) as mablagh FROM $table as tb , $table_sanad as san WHERE
        tb.id=san.model_id and tb.type_id=4";


        $results = $wpdb->get_results($sql, 'ARRAY_A');

        $this->ViewData["income"] = number_format($results[0]["mablagh"]);

        $this->ViewData["sod"] = $this->ViewData["income"] - $this->ViewData["cost"];


        if ($this->ViewData["sod"] > 0) {
            $this->ViewData["sod"] = number_format($this->ViewData["sod"]) . " " . "سود";
        } else {
            $this->ViewData["sod"] = number_format(($this->ViewData["sod"] * -1)) . " " . "ضرر";
        }

        $this->view("home/home");
    }
}
