<?php
  include 'config.php'; // database connection

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['staff_id'])) {
        $staff_id = mysqli_real_escape_string($conn, $_POST['staff_id']);

      $sql = "DELETE FROM users WHERE staff_id='$staff_id'";

        if (mysqli_query($conn, $sql)) {
            // Success — redirect back
            header("Location: admin_staffList.php");
            exit();
        } else {
            echo "Error deleting record: " . mysqli_error($conn);
        }
        mysqli_close($conn);
        } else {
            header("Location:admin_staffList.php");
            exit();
        }
?>
