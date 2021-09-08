<?php
$this->models["cost"] = [];
$this->models["cost"]["id"] = "3";
$this->models["cost"]["name"] = "cost";
$this->models["cost"]["label"] = "هزینه";
$this->models["cost"]["primary_key"] = "id";
$this->models["cost"]["fields"] = array(
    "id" => array(
        "title" => "id",
        "label" => "شماره سیستمی هزینه",
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
    "description" => array(
        "title" => "description",
        "label" => "توضیحات",
        "sortable" => true,
        "in_form" => true,
        "in_table"=>true,
        "type" => array("type" => "textarea", "size" => 1000,"class"=>"col-md-12")
    )
);
