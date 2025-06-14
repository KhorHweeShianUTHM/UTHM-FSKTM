<?php
include("config.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $supplier_id = mysqli_real_escape_string($conn, $_POST['supplier_id']);
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $contact_person = mysqli_real_escape_string($conn, $_POST['contact_person']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $phone = mysqli_real_escape_string($conn, $_POST['phone']);
    $category = mysqli_real_escape_string($conn, $_POST['category']);

    $sql = "UPDATE supplier
            SET name='$name',
                contact_person='$contact_person',
                email='$email',
                phone='$phone',
                category='$category'
            WHERE supplier_id='$supplier_id'";

    if (mysqli_query($conn, $sql)) {
        header("Location: staff_supplier.php?action=update&status=success");
        exit();
    } else {
        header("Location: staff_supplier.php?action=update&status=error");
        exit();
    }

    mysqli_close($conn);
} else {
    header("Location: staff_supplier.php");
    exit();
}
?>