<?php
require_once "../controllers/course.controller.php";
require_once "../models/course.model.php";

class courseList{
  public function courseList(){
    $response = ControllerCourse::courseList();
    echo json_encode($response);
  }
}

$courseList = new courseList();
$courseList -> courseList();