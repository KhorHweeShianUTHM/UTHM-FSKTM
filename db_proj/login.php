<?php
session_start();
include("config/db.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $userid = trim($_POST['userid'] ?? '');
    $input_password = trim($_POST['password'] ?? '');

    if ($userid && $input_password) {
        // Query using userid (login ID)
        $stmt = $conn->prepare("SELECT userid, name, password_hash, role FROM users WHERE userid = ?");
        $stmt->bind_param("s", $userid);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows == 1) {
            $stmt->bind_result($fetched_userid, $user_name, $stored_hashed_password, $role);
            $stmt->fetch();

            if (password_verify($input_password, $stored_hashed_password)) {
                // Store session info
                $_SESSION['userid'] = $fetched_userid;
                $_SESSION['name'] = $user_name;
                $_SESSION['role'] = $role;

                // Redirect based on role
                if ($role === 'admin') {
                    header("Location: dashboard_admin.html"); // if have any change
                } else {
                    header("Location: dashboard_staff.html"); // if have any change
                }
                exit;
            } else {
                echo "<script>
                    alert('Incorrect password'); 
                    window.location.href='login.html';
                </script>";
                exit;
            }
        } else {
            echo "<script>
                alert('User ID not found'); 
                window.location.href='login.html';
            </script>";
            exit;
        }

        $stmt->close();
    } else {
        echo "<script>
            alert('Please fill in all fields'); 
            window.location.href='login.html';
        </script>";
        exit;
    }
}

$conn->close();
?>