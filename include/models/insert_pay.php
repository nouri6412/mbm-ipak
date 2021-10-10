<?php
$this->models["insert_pay"] = [];
$this->models["insert_pay"]["id"] = "9";
$this->models["insert_pay"]["name"] = "insert_pay";
$this->models["insert_pay"]["label"] = "ثبت پرداخت نقدی";
$this->models["insert_pay"]["primary_key"] = "id";
$this->models["insert_pay"]["fields"] = array(
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
        "label" => "بانک",
        "sortable" => true,
        "in_form" => true,
        "is_title" => true,
        "in_table" => true,
        "type" => array("type" => "select", "select" => ["model"=> $wpdb->prefix . "hesab_model","where" => "type_id=1", "key" => "id", "label" => "title"], "size" => 50, "class" => "col-md-6")
    ),
    "contact" => array(
        "title" => "contact",
        "label" => "طرف حساب",
        "sortable" => true,
        "in_form" => true,
        "in_table" => true,
        "type" => array("type" => "select", "select" => ["model"=> $wpdb->prefix . "hesab_model","where" => "type_id=2", "key" => "id", "label" => "title"], "size" => 50, "class" => "col-md-6")
    ),
    "mablagh" => array(
        "title" => "mablagh",
        "label" => "مبلغ پرداخت نقدی",
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
