<?php
include("config.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $customer_id = mysqli_real_escape_string($conn, $_POST['customer_id']);
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $contact = mysqli_real_escape_string($conn, $_POST['contact']);
    $vehicle = mysqli_real_escape_string($conn, $_POST['vehicle']);
    $plate_number = mysqli_real_escape_string($conn, $_POST['plate_number']);
    $service = mysqli_real_escape_string($conn, $_POST['service']);
    $last_visit = mysqli_real_escape_string($conn, $_POST['last_visit']);

    $sql = "UPDATE customer 
            SET name='$name', contact='$contact', vehicle='$vehicle', 
                plate_number='$plate_number', service='$service', last_visit='$last_visit'
            WHERE customer_id='$customer_id'";

    if (mysqli_query($conn, $sql)) {
        header("Location: staff_customer.php?action=update&status=success");
        exit();
    } else {
        header("Location: staff_customer.php?action=update&status=error");
        exit();
    }

    mysqli_close($conn);
} else {
    header("Location: staff_customer.php");
    exit();
}
?>
