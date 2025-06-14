<?php
  include 'config.php'; // database connection

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['inventory_id'])) {
        $inventory_id = mysqli_real_escape_string($conn, $_POST['inventory_id']);

      $sql = "DELETE FROM inventory WHERE inventory_id='$inventory_id'";

        if (mysqli_query($conn, $sql)) {
            // Success — redirect back
            header("Location: inventory.php");
            exit();
        } else {
            echo "Error deleting record: " . mysqli_error($conn);
        }
        mysqli_close($conn);
        } else {
            header("Location:inventory.php");
            exit();
        }
?>
