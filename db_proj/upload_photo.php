<?php
session_start();
$_SESSION['staff_id'] = 1; // Hardcoded for testing
$staff_id = $_SESSION['staff_id'];

if(isset($_FILES['profile_photo'])){
    $file = $_FILES['profile_photo'];
    $target_dir = "uploads/";
    if (!is_dir($target_dir)) mkdir($target_dir, 0777, true);

    $filename = uniqid() . '_' . basename($file["name"]);
    $target_file = $target_dir . $filename;

    if (move_uploaded_file($file["tmp_name"], $target_file)) {
        // Update the database
        $pdo = new PDO('mysql:host=localhost;dbname=ahk_workshop', 'root', '');
        $stmt = $pdo->prepare("UPDATE staff SET profile_photo = ? WHERE id = ?");
        $stmt->execute([$target_file, $staff_id]);
        echo $target_file;
    } else {
        http_response_code(500);
        echo "Upload failed";
    }
}
?>