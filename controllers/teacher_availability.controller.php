<?php
class ControllerTeacherAvailability {
    static public function regTeacherAvailability($data) {
        return ModelTeacherAvailability::regTeacherAvailability($data);
    }

    static public function clearTeacherAvailability($teacherID) {
        return ModelTeacherAvailability::clearTeacherAvailability($teacherID);
    }
}