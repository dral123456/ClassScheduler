<?php
class ControllerRoom{
  static public function regRoom($data){
    $response = ModelRoom::regRoom($data);
    return $response;
  }
  static public function roomList($courseID = null) {
      $response = ModelRoom::roomList($courseID);
      return $response;
  }
}