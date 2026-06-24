<?php
require_once "../controllers/teacher.controller.php";
require_once "../models/teacher.model.php";

class teacherList{
  public function teacherList(){
    $courseID = $_POST['courseID'] ?? null;
    echo json_encode(ControllerTeacher::teacherList($courseID));
  }
}

$teacherList = new teacherList();
$teacherList -> teacherList();