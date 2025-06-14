<?php
include("config.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Escape and assign data dari borang POST
    $staff_id = mysqli_real_escape_string($conn, $_POST['staff_id']);
    $staff_name = mysqli_real_escape_string($conn, $_POST['staff_name']);
    $role = mysqli_real_escape_string($conn, $_POST['role']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $contact_number = mysqli_real_escape_string($conn, $_POST['contact_number']);
    $date_enroll = mysqli_real_escape_string($conn, $_POST['date_enroll']);

    // SQL Query untuk update
    $sql = "UPDATE users 
            SET staff_name='$staff_name', role='$role', email='$email', 
                contact_number='$contact_number', date_enroll='$date_enroll'
            WHERE staff_id='$staff_id'";

    if (mysqli_query($conn, $sql)) {
        // Redirect balik ke staffList page jika berjaya
        header("Location: admin_staffList.php");
        exit();
    } else {
        echo "Ralat semasa kemas kini: " . mysqli_error($conn);
    }

    mysqli_close($conn);
} else {
    header("Location: admin_staffList.php");
    exit();
}
?>