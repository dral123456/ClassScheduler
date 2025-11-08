<?php
    require_once __DIR__ . '/databaseConnector.php';
    header('Content-Type: application/json');

    $conn = getConnection();

    $sectionID = $_POST["sectionID"] ?? null;
    $sectionCourses = $_POST["sectionCourses"] ?? [];

    // Check for missing fields
    if (!$sectionID || empty($sectionCourses)) {
        echo json_encode([
            "status" => "error",
            "message" => "Missing required parameters."
        ]);
        exit;
    }

    $sectionCourses = serialize($sectionCourses);

    try {
        // ✅ Correct UPDATE syntax
        $stmt = $conn->prepare("UPDATE sections SET courses = ? WHERE id = ?");

        $stmt->bind_param("si", $sectionCourses, $sectionID);

        if ($stmt->execute()) {
            echo json_encode([
                "status" => "success",
                "message" => "Status updated successfully."
            ]);
        } else {
            echo json_encode([
                "status" => "error",
                "message" => "Failed to update status. SQL Error: " . $stmt->error
            ]);
        }

        $stmt->close();
        $conn->close();

    } catch (Exception $e) {
        echo json_encode([
            "status" => "error",
            "message" => "Error: " . $e->getMessage()
        ]);
    }
?>
