<?php
// 1. Sambung ke MySQL
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "ahk_workshop";

$conn = new mysqli($servername, $username, $password, $dbname);

// 2. Semak sambungan
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// 3. Semak jika form dihantar
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // 4. Ambil nilai POST
    $name = trim($_POST['name'] ?? '');
    $role = trim($_POST['role'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $password = trim($_POST['password'] ?? '');
    $contact = trim($_POST['contact_number'] ?? '');
    $dateEnroll = date("Y-m-d"); // Automatically set to today's date

    // 5. Validation nilai kosong
    if ($name && $role && $email && $password && $contact) {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        // 6. SQL Insert
        $stmt = $conn->prepare("INSERT INTO users (staff_name, role, email, password, contact_number, date_enroll) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssss", $name, $role, $email, $hashedPassword, $contact, $dateEnroll);

        if ($stmt->execute()) {
            // Redirect after successful signup
            header("Location: admin_staffList.php");
            exit;
        } else {
            echo "SQL error: " . $stmt->error;
        }

        $stmt->close();
    } else {
        header("Location: login.html?error=Please+fill+in+all+fields.");
        exit;
    
    }
}

$conn->close();
?>
