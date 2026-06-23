<?php
require_once "../controllers/course_teacher.controller.php";
require_once "../models/course_teacher.model.php";

class CourseTeacher{
  public $courseID;
  public $teacherID;

  public function regCourseTeacher(){
    $data = array(
      "courseID" => $this->courseID,
      "teacherID" => $this->teacherID,
    );
    $response = ControllerCourseTeacher::regCourseTeacher($data);
    echo ($response);
  }
}

$saveCourseTeacher = new CourseTeacher();
$saveCourseTeacher->courseID = $_POST['courseID'];
$saveCourseTeacher->teacherID = $_POST['teacherID'];
$saveCourseTeacher->regCourseTeacher();