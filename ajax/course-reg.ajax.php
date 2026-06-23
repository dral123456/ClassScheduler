<?php
require_once "../controllers/course.controller.php";
require_once "../models/course.model.php";

class course{
  public $courseCode;
  public $courseName;
  public $roomNeed;
  public $courseHours;
  public $courseSessions;
  public $isSaturdayCourse;

  public function regCourse(){
    $data = array(
      "courseCode" => $this->courseCode,
      "courseName" => $this->courseName,
      "roomNeed" => $this->roomNeed,
      "courseHours" => $this->courseHours,
      "courseSessions" => $this->courseSessions,
      "isSaturdayCourse" => $this->isSaturdayCourse
    );
    $response = ControllerCourse::regCourse($data);
    echo ($response);
  }
}

$saveCourse = new course();
$saveCourse->courseCode = $_POST['courseCode'];
$saveCourse->courseName = $_POST['courseName'];
$saveCourse->roomNeed = $_POST['roomNeed'];
$saveCourse->courseHours = $_POST['courseHours'];
$saveCourse->courseSessions = $_POST['courseSessions'];
$saveCourse->isSaturdayCourse = $_POST['isSaturdayCourse'];
$saveCourse->regCourse();