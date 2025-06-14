<?php
include("config.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $job_id = mysqli_real_escape_string($conn, $_POST['job_id']);
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $vehicles = mysqli_real_escape_string($conn, $_POST['vehicles']);
    $date_in = mysqli_real_escape_string($conn, $_POST['date_in']);
    $date_out = mysqli_real_escape_string($conn, $_POST['date_out']);
    $status = mysqli_real_escape_string($conn, $_POST['status']);
    $service = mysqli_real_escape_string($conn, $_POST['service']);
    $remarks = mysqli_real_escape_string($conn, $_POST['remarks']);
    $amount = mysqli_real_escape_string($conn, $_POST['amount']);
    $updated_at = date('Y-m-d H:i:s'); // Assuming update time is current

    $sql =  "UPDATE job_cards 
            SET name='$name',
                vehicles='$vehicles',
                date_in='$date_in',
                date_out='$date_out',
                status='$status',
                service='$service',
                remarks='$remarks',
                amount='$amount',
                updated_at='$updated_at'
            WHERE job_id='$job_id'";

    if (mysqli_query($conn, $sql)) {
        header("Location: admin_jobcards.php?action=update&status=success");
        exit();
    } else {
        header("Location: admin_jobcards.php?action=update&status=error");
        exit();
    }

    mysqli_close($conn);
} else {
    header("Location: admin_jobcards.php");
    exit();
}
?>
