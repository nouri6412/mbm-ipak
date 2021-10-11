<?php
$this->models["report_income"] = [];
$this->models["report_income"]["id"] = "4";
$this->models["report_income"]["name"] = "report_income";
$this->models["report_income"]["from_table"] = "cost";
$this->models["report_income"]["label"] = "درآمد";
$this->models["report_income"]["is_report"] = true;
$this->models["report_income"]["primary_key"] = "id";
$table_name=$wpdb->prefix . "hesab_sanad as san";
$this->models["report_income"]["fields"] = array(
    "id" => array(
        "title" => "id",
        "label" => "شماره سیستمی ",
        "sortable" => true,
        "in_table"=>true,
        "is_primary" => true
    ),
    "title" => array(
        "title" => "title",
        "label" => "عنوان درآمد",
        "sortable" => true,
        "is_title" => true,
        "in_table"=>true,
        "type" => array("type" => "text")
    ),
    "sum_mablagh" => array(
        "title" => "sum_mablagh",
        "label" => "جمع درآمد",
        "sortable" => true,
        "query" => "(select sum(san.bed) from  $table_name where san.model_id=tb.id ) as sum_mablagh",
        "in_table"=>true,
        "type" => array("type" => "number")
    ),
);
