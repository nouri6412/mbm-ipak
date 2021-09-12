<?php
global $wpdb;
$this->models["insert_cost"] = [];
$this->models["insert_cost"]["id"] = "5";
$this->models["insert_cost"]["name"] = "insert_cost";
$this->models["insert_cost"]["label"] = "ثبت هزینه";
$this->models["insert_cost"]["primary_key"] = "id";
$this->models["insert_cost"]["fields"] = array(
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
        "label" => "هزینه",
        "sortable" => true,
        "in_form" => true,
        "is_title" => true,
        "in_table" => true,
        "type" => array("type" => "select", "select" => ["model"=> $wpdb->prefix . "hesab_model","model_id" => "3", "key" => "id", "label" => "title"], "size" => 50, "class" => "col-md-6")
    ),
    "mablagh" => array(
        "title" => "mablagh",
        "label" => "مبلغ هزینه",
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
