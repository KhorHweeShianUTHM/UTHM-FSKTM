<?php
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['customer_id'])) {
    $customer_id = mysqli_real_escape_string($conn, $_POST['customer_id']);

    $sql = "DELETE FROM customer WHERE customer_id='$customer_id'";

    if (mysqli_query($conn, $sql)) {
        header("Location: admin_customer.php?action=delete&status=success");
        exit();
    } else {
        header("Location: admin_customer.php?action=delete&status=error");
        exit();
    }

    mysqli_close($conn);
} else {
    header("Location: admin_customer.php");
    exit();
}
?>
