<?php
require_once "../controllers/room_availability.controller.php";
require_once "../models/room_availability.model.php";

class RoomAvailability {
    public $roomID;
    public $dayOfWeek;
    public $timeStart;
    public $timeEnd;

    public function regRoomAvailability() {
        $data = array(
            "roomID"    => $this->roomID,
            "dayOfWeek" => $this->dayOfWeek,
            "timeStart" => $this->timeStart,
            "timeEnd"   => $this->timeEnd,
        );
        echo ControllerRoomAvailability::regRoomAvailability($data);
    }
}

$save = new RoomAvailability();
$save->roomID    = $_POST['roomID'];
$save->dayOfWeek = $_POST['dayOfWeek'];
$save->timeStart = $_POST['timeStart'];
$save->timeEnd   = $_POST['timeEnd'];
$save->regRoomAvailability();