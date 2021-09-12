<?php
$this->models["insert_debt"] = [];
$this->models["insert_debt"]["id"] = "7";
$this->models["insert_debt"]["name"] = "insert_debt";
$this->models["insert_debt"]["label"] = "ثبت بدهی";
$this->models["insert_debt"]["primary_key"] = "id";
$this->models["insert_debt"]["fields"] = array(
    "id" => array(
        "title" => "id",
        "label" => "شماره سیستمی ثبت",
        "sortable" => true,
        "in_table" => true,
        "in_form" => true,
        "is_primary" => true
    ),
    "title" => array(
        "title" => "title",
        "label" => "بدهی",
        "sortable" => true,
        "in_form" => true,
        "is_title" => true,
        "in_table" => true,
        "type" => array("type" => "select", "select" => ["model"=> $wpdb->prefix . "hesab_model","where" => "type_id=2", "key" => "id", "label" => "title"], "size" => 50, "class" => "col-md-6")
    ),
    "mablagh" => array(
        "title" => "mablagh",
        "label" => "مبلغ بدهی",
        "sortable" => true,
        "in_form" => true,
        "is_require" => true,
        "in_table" => true,
        "type" => array("type" => "text", "size" => 50, "class" => "col-md-6")
    ),
    "sanad_date" => array(
        "title" => "sanad_date",
        "label" => " تاریخ",
        "sortable" => true,
        "in_form" => true,
        "in_table" => true,
        "type" => array("type" => "date", "size" => 50, "class" => "col-md-6")
    ),
    "description" => array(
        "title" => "description",
        "label" => "توضیحات",
        "sortable" => true,
        "in_form" => true,
        "in_table" => true,
        "type" => array("type" => "textarea", "size" => 1000, "class" => "col-md-12")
    )
);
