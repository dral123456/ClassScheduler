<?php
class ControllerCourse{
  
  static public function regCourse($data){
    $response = ModelCourse::regCourse($data);
    return $response;
  }

  static public function courseList(){
    $response = ModelCourse::courseList();
    return $response;
  }
}