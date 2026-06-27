<?php
require_once "../controllers/room_availability.controller.php";
require_once "../models/room_availability.model.php";

echo ControllerRoomAvailability::clearRoomAvailability($_POST['roomID']);