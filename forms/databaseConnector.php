<?php
    function getConnection() {
        $host = "localhost";
        $user = "root";
        $pass = "";
        $db   = "class_scheduler";

        $conn = new mysqli($host, $user, $pass, $db);

        if ($conn->connect_error) {
            die("DB connection failed: " . $conn->connect_error);
        }

        return $conn;
    }
?>
