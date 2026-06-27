<?php
require_once "../controllers/teacher_availability.controller.php";
require_once "../models/teacher_availability.model.php";

echo ControllerTeacherAvailability::clearTeacherAvailability($_POST['teacherID']);