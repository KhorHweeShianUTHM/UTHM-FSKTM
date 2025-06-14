<?php
// Mulakan sesi
session_start();

// Sambung ke MySQL
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "ahk_workshop";

$conn = new mysqli($servername, $username, $password, $dbname);

// Semak sambungan
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Proses login bila POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = trim($_POST['email'] ?? '');
    $input_password = trim($_POST['password'] ?? '');

    if ($email && $input_password) {
        // Dapatkan rekod user ikut email
        $stmt = $conn->prepare("SELECT staff_id, staff_name, password FROM users WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows == 1) {
            $stmt->bind_result($user_id, $user_name, $stored_hashed_password);
            $stmt->fetch();

            // Semak password
            if (password_verify($input_password, $stored_hashed_password)) {
                // Login berjaya
                $_SESSION['user_id'] = $user_id;
                $_SESSION['user_name'] = $user_name;
                // *** echo "Login successful! Welcome, $user_name.";
                // Boleh redirect ke dashboard kalau nak:
                 header("Location: staff_inventory.php");
                // exit;
            } else {
                header("Location: login.html?error=Incorrect+password.");
                exit;
            }
        } else {
            header("Location: login.html?error=Email+not+found.");
            exit;
        }
        $stmt->close();
    } else {
        header("Location: login.html?error=Please+fill+in+all+fields.");
            exit;
    }
}

$conn->close();
?>
