<?php
$conn = new mysqli("localhost", "root", "", "ahk_payments");

if ($conn->connect_error) {
    http_response_code(500);
    echo json_encode(["error" => "DB connection failed"]);
    exit;
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Step 1: Load current settings
    $currentSettings = [];
    $sql = "SELECT workshop_name, contact_number, email, address, logo_path FROM settings WHERE id = 1 LIMIT 1";
    $result = $conn->query($sql);

    if ($result && $result->num_rows > 0) {
        $currentSettings = $result->fetch_assoc();
    } else {
        http_response_code(500);
        echo json_encode(["error" => "Settings not found"]);
        exit;
    }

    // Step 2: Use POST values or fall back to existing values
    $workshop_name  = $_POST["workshop_name"]  ?? $currentSettings["workshop_name"];
    $contact_number = $_POST["contact_number"] ?? $currentSettings["contact_number"];
    $email          = $_POST["email"]          ?? $currentSettings["email"];
    $address        = $_POST["address"]        ?? $currentSettings["address"];
    $logo_path      = $_POST["logo_path"]      ?? $currentSettings["logo_path"];

    // Step 3: Update database
    $sql = "UPDATE settings SET 
        workshop_name = ?, 
        contact_number = ?, 
        email = ?, 
        address = ?, 
        logo_path = ?
        WHERE id = 1";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssss", $workshop_name, $contact_number, $email, $address, $logo_path);

    if ($stmt->execute()) {
        echo "success";
    } else {
        echo "error";
    }

    $stmt->close();
}

else if ($_SERVER["REQUEST_METHOD"] === "GET") {
    // Return current settings as JSON
    $sql = "SELECT workshop_name, contact_number, email, address, logo_path FROM settings WHERE id = 1 LIMIT 1";
    $result = $conn->query($sql);

    header('Content-Type: application/json');
    if ($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc();
        echo json_encode($row);
    } else {
        echo json_encode([]);
    }
}

$conn->close();
?>
