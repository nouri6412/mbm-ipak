<?php
$this->models["report_cost"] = [];
$this->models["report_cost"]["id"] = "3";
$this->models["report_cost"]["name"] = "report_cost";
$this->models["report_cost"]["from_table"] = "cost";
$this->models["report_cost"]["label"] = "هزینه";
$this->models["report_cost"]["is_report"] = true;
$this->models["report_cost"]["primary_key"] = "id";
$table_name=$wpdb->prefix . "hesab_sanad as san";
$this->models["report_cost"]["fields"] = array(
    "id" => array(
        "title" => "id",
        "label" => "شماره سیستمی ",
        "sortable" => true,
        "in_table"=>true,
        "is_primary" => true
    ),
    "title" => array(
        "title" => "title",
        "label" => "عنوان هزینه",
        "sortable" => true,
        "is_title" => true,
        "in_table"=>true,
        "type" => array("type" => "text")
    ),
    "sum_mablagh" => array(
        "title" => "sum_mablagh",
        "label" => "جمع هزینه",
        "sortable" => true,
        "query" => "(select sum(san.bes) from  $table_name where san.model_id=tb.id ) as sum_mablagh",
        "in_table"=>true,
        "type" => array("type" => "number")
    ),
);
