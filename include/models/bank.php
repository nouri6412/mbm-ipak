<?php
$this->models["bank"] = [];
$this->models["bank"]["id"] = "1";
$this->models["bank"]["label"] = "بانک";
$this->models["bank"]["primary_key"] = "id";
$this->models["bank"]["fields"] = array(
    "id" => array(
        "title" => "id",
        "label" => "آی دی بانک",
        "sortable" => true,
        "is_primary" => true
    ),
    "title" => array(
        "title" => "title",
        "label" => "عنوان بانک",
        "sortable" => true
    )
);
