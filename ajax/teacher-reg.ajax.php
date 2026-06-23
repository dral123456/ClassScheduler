<?php
require_once "../controllers/teacher.controller.php";
require_once "../models/teacher.model.php";

class teacher{
  public $teacherFName;
  public $teacherMName;
  public $teacherLName;
  public $teacherSuffix;

  public function regTeacher(){
    $data = array(
      "teacherFName" => $this->teacherFName,
      "teacherMName" => $this->teacherMName,
      "teacherLName" => $this->teacherLName,
      "teacherSuffix" => $this->teacherSuffix
    );
    $response = ControllerTeacher::regTeacher($data);
    echo json_encode($response);
  }
}

$saveTeacher = new teacher();
$saveTeacher->teacherFName = $_POST['teacherFName'];
$saveTeacher->teacherMName = $_POST['teacherMName'];
$saveTeacher->teacherLName = $_POST['teacherLName'];
$saveTeacher->teacherSuffix = $_POST['teacherSuffix'];
$saveTeacher->regTeacher();