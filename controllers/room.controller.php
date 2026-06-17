<?php
class ControllerRoom{
  static public function regRoom($data){
    $response = ModelRoom::regRoom($data);
    return $response;
  }
}