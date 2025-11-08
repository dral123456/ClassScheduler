<?php
    require_once __DIR__ . "/databaseConnector.php";

    header('Content-Type: application/json');

    $conn = getConnection();

    // Get POST data safely
    $name = $_POST["courseName"] ?? null;
    $hours = $_POST["hours"] ?? null;
    $sessions = $_POST["sessions"] ?? null;
    $term = $_POST["term"] ?? null;
    $year = $_POST["year"] ?? null;
    $teachers = $_POST["teachers"] ?? [];
    $sections = $_POST["sections"] ?? [];
    $code = $_POST["code"] ?? [];
    $category = $_POST["category"] ?? [];
    

    // Validate required fields
    if (!$name || !$hours || !$sessions || !$term || !$year || empty($teachers) || empty($sections) || !$code || !$category) {
        echo json_encode([
            "status" => "error",
            "message" => "Missing required input fields"
        ]);
        exit;
    }

    // Convert array to storable string
    $teachers = serialize($teachers);
    $sections = serialize($sections);

    // Prepare query safely
    $stmt = $conn->prepare("
        INSERT INTO courses (name, hours, sessions, teachers, term, year, sections, code, category)
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)
    ");

    $stmt->bind_param(
        "siisiisss",
        $name,
        $hours,
        $sessions,
        $teachers,
        $term,
        $year,
        $sections,
        $code,
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