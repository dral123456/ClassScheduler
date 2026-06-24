<?php
require_once "../controllers/csrt.controller.php";
require_once "../models/csrt.model.php";

class Csrt {
    public $courseID;
    public $sectionID;
    public $roomID;
    public $teacherID;

    public function regCsrt() {
        $data = array(
            "courseID"  => $this->courseID,
            "sectionID" => $this->sectionID,
            "roomID"    => $this->roomID,
            "teacherID" => $this->teacherID,
        );
        $response = ControllerCsrt::regCsrt($data);
        echo $response;
    }
}

$saveCsrt = new Csrt();
$saveCsrt->courseID  = $_POST['courseID'];
$saveCsrt->sectionID = $_POST['sectionID'];
$saveCsrt->roomID    = $_POST['roomID'];
$saveCsrt->teacherID = $_POST['teacherID'];
$saveCsrt->regCsrt();