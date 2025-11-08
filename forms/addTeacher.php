<?php
    require_once __DIR__ . "/databaseConnector.php";

    header('Content-Type: application/json');

    $conn = getConnection();

    // Get POST data safely
    $name = $_POST["teacherName"] ?? null;
    $term = $_POST["term"] ?? null;
    $year = $_POST["year"] ?? null;
    $courses[] = $_POST["courses"] ?? [];

    // Validate required fields
    if (!$name || !$term || !$year || empty($courses) ) {
        echo json_encode([
            "status" => "error",
            "message" => "Missing required input fields"
        ]);
        exit;
    }

    $courses = serialize($courses);

    $stmt = $conn->prepare("
        INSERT INTO teachers (name, term, year, courses)
        VALUES (?, ?, ?, ?)
    ");

    $stmt->bind_param(
        "siss",
        $name,
        $term,
        $year,
        $courses
    );

    if ($stmt->execute()) {
        echo json_encode([
            "status" => "success",
            "message" => "Successfully added teacher!"
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