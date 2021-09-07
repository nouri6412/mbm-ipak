<?php
$this->models["bank"] = [];
$this->models["bank"]["id"] = "1";
$this->models["bank"]["name"] = "bank";
$this->models["bank"]["label"] = "بانک";
$this->models["bank"]["primary_key"] = "id";
$this->models["bank"]["fields"] = array(
    "id" => array(
        "title" => "id",
        "label" => "شماره سیستمی بانک",
        "sortable" => true,
        "in_table"=>true,
        "is_primary" => true
    ),
    "title" => array(
        "title" => "title",
        "label" => "عنوان بانک",
        "sortable" => true,
        "in_form" => true,
        "is_title" => true,
        "is_require"=>true,
        "in_table"=>true,
        "type" => array("type" => "text", "size" => 50,"class"=>"col-md-6")
    ),
    "number" => array(
        "title" => "number",
        "label" => "شماره بانک",
        "sortable" => true,
        "in_form" => true,
        "in_table"=>true,
        "type" => array("type" => "number", "size" => 50,"class"=>"col-md-6")
    )
    ,
    "address" => array(
        "title" => "address",
        "label" => "آدرس بانک",
        "sortable" => true,
        "in_form" => true,
        "in_table"=>true,
        "type" => array("type" => "textarea", "size" => 500,"class"=>"col-md-12")
    )
);
