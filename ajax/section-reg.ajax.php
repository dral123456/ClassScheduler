<?php
require_once "../controllers/section.controller.php";
require_once "../models/section.model.php";

class Section {
    public $sectionCode;

    public function regSection() {
        $data = array(
            "sectionCode" => $this->sectionCode,
        );
        $response = ControllerSection::regSection($data);
        echo $response;
    }
}

$saveSection = new Section();
$saveSection->sectionCode = $_POST['sectionCode'];
$saveSection->regSection();