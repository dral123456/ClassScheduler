<?php
require_once "../controllers/room.controller.php";
require_once "../models/room.model.php";

class roomList{
  public function roomList(){
    $courseID = $_POST['courseID'] ?? null;
    echo json_encode(ControllerRoom::roomList($courseID));
  }
}

$roomList = new roomList();
$roomList -> roomList();