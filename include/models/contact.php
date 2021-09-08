<?php
$this->models["contact"] = [];
$this->models["contact"]["id"] = "2";
$this->models["contact"]["name"] = "contact";
$this->models["contact"]["label"] = "طرف حساب";
$this->models["contact"]["primary_key"] = "id";
$this->models["contact"]["fields"] = array(
    "id" => array(
        "title" => "id",
        "label" => "شماره سیستمی طرف حساب",
        "sortable" => true,
        "in_table"=>true,
        "in_form" => true,
        "is_primary" => true
    ),
    "title" => array(
        "title" => "title",
        "label" => "عنوان طرف حساب",
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
