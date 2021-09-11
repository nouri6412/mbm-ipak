<?php
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
        "in_table"=>true,
        "in_form" => true,
        "is_primary" => true
    ),
    "title" => array(
        "title" => "title",
        "label" => "عنوان هزینه",
        "sortable" => true,
        "in_form" => true,
        "is_title" => true,
        "is_require"=>true,
        "in_table"=>true,
        "type" => array("type" => "text", "size" => 50,"class"=>"col-md-6")
    ),
    "title" => array(
        "title" => "title",
        "label" => "مبلغ هزینه",
        "sortable" => true,
        "in_form" => true,
        "is_title" => true,
        "is_require"=>true,
        "in_table"=>true,
        "type" => array("type" => "text", "size" => 50,"class"=>"col-md-6")
    ),
    "date" => array(
        "title" => "date",
        "label" => " تاریخ",
        "sortable" => true,
        "in_form" => true,
        "in_table"=>true,
        "type" => array("type" => "date", "size" => 50,"class"=>"col-md-6")
    ),
    "description" => array(
        "title" => "description",
        "label" => "توضیحات",
        "sortable" => true,
        "in_form" => true,
        "in_table"=>true,
        "type" => array("type" => "textarea", "size" => 1000,"class"=>"col-md-12")
    )
);
