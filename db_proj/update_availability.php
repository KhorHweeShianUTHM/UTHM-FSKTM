<?php
$host = 'localhost';
$user = 'root';
$password = '';
$dbname = 'ahk_workshop';

$conn = new mysqli($host, $user, $password, $dbname);
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['availability']) && is_array($_POST['availability'])) {
  $allowed = ['available', 'not available', 'on leave'];  // use lowercase to match your form options

  foreach ($_POST['availability'] as $staff_id => $availability) {
    $staff_id = intval($staff_id);
   $availability = strtolower(trim($_POST['availability'][$staff_id]));

    if (!in_array($availability, $allowed)) {
      continue; // skip invalid values
    }

    $availability_escaped = $conn->real_escape_string($availability);

    $sql = "UPDATE staff SET availability='$availability_escaped' WHERE id=$staff_id";
    $conn->query($sql);
  }

  $conn->close();
  // Redirect back to admin dashboard or staff dashboard as you prefer
  header("Location: dashboard_admin.php?msg=updated");
  exit;
} else {
  echo "Invalid request";
}
?>
