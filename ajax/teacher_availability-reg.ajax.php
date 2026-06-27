<?php
require_once "../controllers/teacher_availability.controller.php";
require_once "../models/teacher_availability.model.php";

class TeacherAvailability {
    public $teacherID;
    public $dayOfWeek;
    public $timeStart;
    public $timeEnd;

    public function regTeacherAvailability() {
        $data = array(
            "teacherID" => $this->teacherID,
            "dayOfWeek" => $this->dayOfWeek,
            "timeStart" => $this->timeStart,
            "timeEnd"   => $this->timeEnd,
        );
        echo ControllerTeacherAvailability::regTeacherAvailability($data);
    }
}

$save = new TeacherAvailability();
$save->teacherID = $_POST['teacherID'];
$save->dayOfWeek = $_POST['dayOfWeek'];
$save->timeStart = $_POST['timeStart'];
$save->timeEnd   = $_POST['timeEnd'];
$save->regTeacherAvailability();