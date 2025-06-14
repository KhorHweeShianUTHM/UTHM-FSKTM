<?php
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['job_id'])) {
    $job_id = mysqli_real_escape_string($conn, $_POST['job_id']);

    $sql = "DELETE FROM job_cards WHERE job_id='$job_id'";

    if (mysqli_query($conn, $sql)) {
        header("Location: admin_jobcards.php?action=delete&status=success");
        exit();
    } else {
        header("Location: admin_jobcards.php?action=delete&status=error");
        exit();
    }

    mysqli_close($conn);
} else {
    header("Location: admin_jobcards.php");
    exit();
}

?>
