<?php
class ControllerTeacher{
  public static function regTeacher($data){
    $response = ModelTeacher :: regTeacher($data);
    return $response;
  }
  static public function teacherList($courseID = null) {
      $response = ModelTeacher::teacherList($courseID);
      return $response;
  }
}