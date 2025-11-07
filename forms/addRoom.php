<?php
    require_once __DIR__ . "/databaseConnector.php";

    header('Content-Type: application/json');

    $conn = getConnection();

    // Get POST data safely
    $name = $_POST["name"] ?? null;
    $number = $_POST["number"] ?? null;
    $category = $_POST["category"] ?? null;

    // Validate required fields
    if (!$name || !$number || !$category ) {
        echo json_encode([
            "status" => "error",
            "message" => "Missing required input fields"
        ]);
        exit;
    }

    $stmt = $conn->prepare("
        INSERT INTO rooms (name, number, category)
        VALUES (?, ?, ?)
    ");

    $stmt->bind_param(
        "sis",
        $name,
        $number,
        $category
    );

    if ($stmt->execute()) {
        echo json_encode([
            "status" => "success",
            "message" => "Successfully added course!"
        ]);
    } else {
        echo json_encode([
            "status" => "error",
            "message" => "Query failed: " . $stmt->error
        ]);
    }

    $stmt->close();
    $conn->close();
?>