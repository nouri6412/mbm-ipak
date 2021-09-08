<?php
$this->models["income"] = [];
$this->models["income"]["id"] = "4";
$this->models["income"]["name"] = "income";
$this->models["income"]["label"] = "درآمد";
$this->models["income"]["primary_key"] = "id";
$this->models["income"]["fields"] = array(
    "id" => array(
        "title" => "id",
        "label" => "شماره سیستمی درآمد",
        "sortable" => true,
        "in_table"=>true,
        "in_form" => true,
        "is_primary" => true
    ),
    "title" => array(
        "title" => "title",
        "label" => "عنوان درآمد",
        "sortable" => true,
        "in_form" => true,
        "is_title" => true,
        "is_require"=>true,
        "in_table"=>true,
        "type" => array("type" => "text", "size" => 50,"class"=>"col-md-6")
    ),
    "description" => array(
        "title" => "description",
        "label" => "توضیحات درآمد",
        "sortable" => true,
        "in_form" => true,
        "in_table"=>true,
        "type" => array("type" => "textarea", "size" => 1000,"class"=>"col-md-12")
    )
);
