<?php
class ControllerSession{
    public function setSchoolYear() {
        if(isset($_POST['submitSY'])) {
            $_SESSION['schoolYear'] = $_POST['schoolYear'];
            echo '<script>
                    Swal.fire({
                      title: "Success!",
                      text: "School year has been set to ' . $_SESSION['schoolYear'] . '",
                      icon: "success"
                    }).then(() => {
                      window.location.href = "room-reg";
                    });
                  </script>';
        }
    }
}