<?php
class ControllerRoomAvailability {
    static public function regRoomAvailability($data) {
        return ModelRoomAvailability::regRoomAvailability($data);
    }

    static public function clearRoomAvailability($roomID) {
        return ModelRoomAvailability::clearRoomAvailability($roomID);
    }
}