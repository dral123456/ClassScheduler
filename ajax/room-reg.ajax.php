<?php
require_once "../controllers/room.controller.php";
require_once "../models/room.model.php";

class room{
  public $roomNum;
  public $roomType;

  public function regRoom(){
    $data = array(
      "roomNum" => $this->roomNum,
      "roomType" => $this->roomType
    );
    $response = ControllerRoom::regRoom($data);
    echo ($response);
  }
}

$saveRoom = new room();
$saveRoom->roomNum = $_POST['roomNum'];
$saveRoom->roomType = $_POST['roomType'];
$saveRoom->regRoom();