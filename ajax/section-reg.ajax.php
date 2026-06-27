<?php
require_once "../controllers/section.controller.php";
require_once "../models/section.model.php";

class Section {
    public $sectionCode;
    public $sectionSY;
    public $sectionSemester;

    public function regSection() {
        $data = array(
            "sectionCode"     => $this->sectionCode,
            "sectionSY"       => $this->sectionSY,
            "sectionSemester" => $this->sectionSemester,
        );
        $response = ControllerSection::regSection($data);
        echo $response;
    }
}

$saveSection = new Section();
$saveSection->sectionCode     = $_POST['sectionCode'];
$saveSection->sectionSY       = $_POST['sectionSY'];
$saveSection->sectionSemester = $_POST['sectionSemester'];
$saveSection->regSection();