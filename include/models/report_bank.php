<?php
$this->models["report_bank"] = [];
$this->models["report_bank"]["id"] = "1";
$this->models["report_bank"]["name"] = "report_bank";
$this->models["report_bank"]["from_table"] = "contact";
$this->models["report_bank"]["label"] = "گزارش موجودی بانک";
$this->models["report_bank"]["is_report"] = true;
$this->models["report_bank"]["primary_key"] = "id";
$table_name = $wpdb->prefix . "hesab_sanad as san";
$this->models["report_bank"]["fields"] = array(
    "id" => array(
        "title" => "id",
        "label" => "شماره سیستمی ",
        "sortable" => true,
        "in_table" => true,
        "is_primary" => true
    ),
    "title" => array(
        "title" => "title",
        "label" => "بانک",
        "sortable" => true,
        "is_title" => true,
        "in_table" => true,
        "type" => array("type" => "text")
    ),
    "sum_mablagh" => array(
        "title" => "sum_mablagh",
        "label" => "موجودی بانک",
        "sortable" => true,
        "query" => "(select 
        CASE
    WHEN (sum(san.bed)-sum(san.bes)) > 0 THEN concat((sum(san.bed)-sum(san.bes)),' ','') 
    ELSE concat((sum(san.bed)-sum(san.bes))*-1,' ','-')
END
         as sum_mablagh from  $table_name where san.model_id=tb.id ) as sum_mablagh",
        "in_table" => true,
        "type" => array("type" => "number")
    ),
);
$this->models["report_bank"]["filter"] = array("sanad_date" => array(
    "title" => "sanad_date",
    "label" => "تاریخ",
    "sortable" => true,
    "in_form" => true,
    "type" => array("type" => "date")
));
