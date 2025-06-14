<?php
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['supplier_id'])) {
    $supplier_id = mysqli_real_escape_string($conn, $_POST['supplier_id']);

    $sql = "DELETE FROM supplier WHERE supplier_id='$supplier_id'";

    if (mysqli_query($conn, $sql)) {
        header("Location: staff_supplier.php?action=delete&status=success");
        exit();
    } else {
        header("Location: staff_supplier.php?action=delete&status=error");
        exit();
    }

    mysqli_close($conn);
} else {
    header("Location: staff_supplier.php");
    exit();
}
?>