<?php
    require_once __DIR__ . "/databaseConnector.php";

    header('Content-Type: application/json');

    $conn = getConnection();

    $name = $_GET["sectionName"] ?? null;
    $term = $_GET["term"] ?? null;
    $year = $_GET["year"] ?? null;

    if (!$name || !$term || !$year) {
        echo json_encode([
            "status" => "error",
            "message" => "Missing required input fields"
        ]);
        exit;
    }

    $stmt = $conn->prepare("
        SELECT * FROM sections
        WHERE name = ? AND term = ? AND year = ?
    ");
    $stmt->bind_param("sis", $name, $term, $year);
    $stmt->execute();

    $result = $stmt->get_result();
    $data = [];

    while ($row = $result->fetch_assoc()) {
        if (isset($row['courses'])) {
            $row['courses'] = unserialize($row['courses']);
        }
        $data[] = $row;
    }

    if (!empty($data)) {
        echo json_encode([
            "status" => "success",
            "message" => "Section(s) found",
            "data" => $data
        ]);
    } else {
        echo json_encode([
            "status" => "none",
            "message" => "No matching section found",
            "data" => []
        ]);
    }

    $stmt->close();
    $conn->close();
?>
