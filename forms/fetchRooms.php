<?php
    header('Content-Type: application/json');

    require_once __DIR__ . "/databaseConnector.php";

    $conn = getConnection();

    if (!$conn) {
        echo json_encode([
            "status" => "error",
            "data" => [],
            "error" => "Database connection failed."
        ]);
        exit;
    }

    $sql = "SELECT * FROM rooms";
    $result = $conn->query($sql);

    $rooms = [];
    $status = "success";
    $error_message = null;

    if ($result) {
        while ($row = $result->fetch_assoc()) {
            $rooms[] = $row;
        }
    } else {
        $status = "error";
        $error_message = "Query failed: " . $conn->error;
    }

    // Return JSON response
    echo json_encode([
        "status" => $status,
        "data" => $rooms,
        "error" => $error_message
    ]);

    $conn->close();
?>
