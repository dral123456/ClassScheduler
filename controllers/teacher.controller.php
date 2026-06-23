<?php
class ControllerTeacher{
  public static function regTeacher($data){
    $response = ModelTeacher :: regTeacher($data);
    return $response;
  }
}