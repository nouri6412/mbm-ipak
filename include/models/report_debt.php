<?php
$this->models["report_debt"] = [];
$this->models["report_debt"]["id"] = "2";
$this->models["report_debt"]["name"] = "report_debt";
$this->models["report_debt"]["from_table"] = "contact";
$this->models["report_debt"]["label"] = "بدهکاران و طلبکاران";
$this->models["report_debt"]["is_report"] = true;
$this->models["report_debt"]["primary_key"] = "id";
$table_name=$wpdb->prefix . "hesab_sanad as san";
$this->models["report_debt"]["fields"] = array(
    "id" => array(
        "title" => "id",
        "label" => "شماره سیستمی ",
        "sortable" => true,
        "in_table"=>true,
        "is_primary" => true
    ),
    "title" => array(
        "title" => "title",
        "label" => "طرف حساب",
        "sortable" => true,
        "is_title" => true,
        "in_table"=>true,
        "type" => array("type" => "text")
    ),
    "sum_mablagh" => array(
        "title" => "sum_mablagh",
        "label" => "جمع حساب",
        "sortable" => true,
        "query" => "(select 
        CASE
    WHEN (sum(san.bed)-sum(san.bes)) > 0 THEN concat((sum(san.bed)-sum(san.bes)),' ','طلبکار') 
    ELSE concat((sum(san.bed)-sum(san.bes))*-1,' ','بدهکار')
END
         as sum_mablagh from  $table_name where san.model_id=tb.id ) as sum_mablagh",
        "in_table"=>true,
        "type" => array("type" => "number")
    ),
);
