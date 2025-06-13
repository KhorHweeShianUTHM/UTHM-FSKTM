<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $full_name = $_POST['full_name'];
    $phone = $_POST['phone'];
    $approval_status = 'pending';

    $query = "INSERT INTO bookings (full_name, phone, approval_status) VALUES (?, ?, ?)";
    $stmt = $pdo->prepare($query);
    $stmt->execute([$full_name, $phone, $approval_status]);

    $booking_id = $pdo->lastInsertId();
    echo "Thank you for your submission! Your Booking ID is: " . $booking_id;
}
?>
