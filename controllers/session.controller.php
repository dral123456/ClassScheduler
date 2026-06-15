<?php
class ControllerSession{
    public function setSchoolYear() {
        if(isset($_POST['submitSY'])) {
            $_SESSION['schoolYear'] = $_POST['schoolYear'];
            echo '<script>alert("School year set to: " + "' . $_SESSION['schoolYear'] . '");</script>';
        }
    }
}