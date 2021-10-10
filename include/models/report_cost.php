<?php
$this->models["report_cost"] = [];
$this->models["report_cost"]["id"] = "3";
$this->models["report_cost"]["name"] = "report_cost";
$this->models["report_cost"]["label"] = "هزینه";
$this->models["report_cost"]["primary_key"] = "id";
$table_name=$wpdb->prefix . "hesab_model_meta";
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
    "title" => array(
        "title" => "sum_mablagh",
        "label" => "جمع هزینه",
        "sortable" => true,
        "query" => "(select sum(met.value_meta) from $table_name as met where met.model_id =tb.id and met.key_meta='mablagh' ) as sum_mablagh",
        "in_table"=>true,
        "type" => array("type" => "number")
    ),
);
