<?php
class ControllerCourseTeacher{
  static public function regCourseTeacher($data){
    $response = ModelCourseTeacher::regCourseTeacher($data);
    return $response;
  }
}