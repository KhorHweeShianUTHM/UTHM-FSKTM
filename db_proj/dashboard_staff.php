<?php
$host = 'localhost';
$user = 'root';
$password = '';
$dbname = 'ahk_workshop';

// Create connection
$conn = new mysqli($host, $user, $password, $dbname);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>AHK Auto Care</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
</head>
  
<style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
      font-family: 'Inter', sans-serif;
    }
    body {
      display: flex;
      background-color: #f0f2f5;
      color: #333;
    }
    .sidebar {
      width: 240px;
      min-height: 100vh;
      background-color: #5a5a59;
      color: white;
      padding: 20px 0;
      position: fixed;
      top: 0;
      left: 0;
      overflow-y: auto;
      z-index: 1000;
    }
    .sidebar img {
      margin: 0 auto;
      display: block;
      width: 120px;
    }
    .sidebar h2 {
      margin-top: 30px;
      font-size: 20px;
      text-align: center;
    }
    .sidebar ul {
      margin-top: 30px;
      list-style: none;
      padding: 0;
    }
    .sidebar ul li {
      display: flex;
      align-items: center;
      padding: 15px 30px;
      cursor: pointer;
      transition: background 0.2s;
    }
    .sidebar ul li:hover {
      background-color: #dc3545;
    }
    .sidebar ul li i {
      margin-right: 10px;
    }
    .sidebar ul li a {
      text-decoration: none;
      color: white;
      width: 100%;
      display: flex;
      align-items: center;
    }
    .main {
      margin-left: 240px; /* account for fixed sidebar */
      flex: 1;
      display: flex;
      flex-direction: column;
      overflow-x: hidden;
    }
    .navbar {
      height: 120px;
      background-color: white;
      display: flex;
      justify-content: space-between;
      align-items: center;
      padding: 0 20px;
      border-bottom: 1px solid #ccc;
      box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }
    .navbar .page-info h1 {
      font-size: 20px;
      margin-bottom: 5px;
      color: #212B36;
    }
    .navbar .page-info p {
      font-size: 14px;
      color: #637381;
    }
    .navbar .user-info {
      display: flex;
      align-items: center;
      gap: 10px;
    }
    .navbar .user-label {
      display: flex;
      flex-direction: column;
      align-items: flex-end;
      margin-right: 15px;
    }
    .navbar .user-name {
      font-weight: 600;
      font-size: 14px;
      color: #212B36;
    }
    .navbar .user-role {
      font-size: 12px;
      color: #637381;
    }
    .navbar .user-icon {
      width: 32px;
      height: 32px;
      background-color: #EFF4FB;
      border-radius: 50%;
      display: flex;
      justify-content: center;
      align-items: center;
      color: #333;
      font-size: 14px;
      border: 1px solid #E2E8F0;
      cursor: pointer;
    }
    .navbar .dropdown-icon i {
      font-size: 12px;
      color: #555;
      margin-right: 10px;
    }
    .navbar .notification-icon {
      width: 32px;
      height: 32px;
      background-color: #EFF4FB;
      border-radius: 50%;
      display: flex;
      justify-content: center;
      align-items: center;
      margin-right: 40px;
      cursor: pointer;
      border: 1px solid #E2E8F0;
    }
    .navbar .notification-icon i {
      color: #333;
      font-size: 14px;
    }
    .profile-dropdown-menu {
      position: absolute;
      top: 100%;
      right: 0;
      background-color: #fff;
      border: 1px solid #E2E8F0;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
      list-style: none;
      padding: 5px 0;
      margin-top: 10px;
      z-index: 1000;
      min-width: 160px;
      border-radius: 8px;
      overflow: hidden;
    }
    .profile-dropdown-menu li a {
      display: block;
      padding: 10px 20px;
      text-decoration: none;
      color: #212B36;
      font-size: 14px;
      transition: background-color 0.2s;
    }
    .profile-dropdown-menu li a:hover {
      background-color: #EFF4FB;
      color: #dc3545;
    }
    .profile-dropdown-menu[hidden] {
      display: none;
    }
    .user-profile-container.active {
      background-color: rgba(157, 157, 157, 0.1);
      border-radius: 8px;
    }

    .dashboard-image-section {
      padding: 30px 20px;
      width: 100%;
    }

    .dashboard-image-section img {
      width: 100%;
      display: block;
      margin: 0 auto;
      border-radius: 12px;
      box-shadow: 0 4px 12px rgba(0,0,0,0.1);
    }

    .container {
      padding: 30px 20px;
      max-width: 1200px;
      width: 100%;
      margin: 0 auto;
    }

   table {
  width: 90%;
  border-collapse: collapse;
  background: linear-gradient(to right, #d3d3d3, #e0e0e0); /* gradient grey */
  border-radius: 12px;
  overflow: hidden;
  box-shadow: 0 4px 12px rgba(0,0,0,0.05);
}


    thead {
      background-color:rgb(160, 166, 171);
    }
    th, td {
      padding: 14px;
      text-align: left;
      border-bottom: 1px solid #dee2e6;
    }

    span.badge {
      padding: 6px 14px;
      border-radius: 20px;
      color: white;
      font-size: 13px;
      display: inline-block;
    }

  </style>
</head>
<body>

<!-- Sidebar -->
<div class="sidebar">
  <img src="ahk_logo.png" alt="AHK Logo"/>
  <h2>Staff Menu</h2>
  <ul>
    <li><a href="staff_dashboard.php"><i class="fas fa-home"></i> Dashboard</a></li>
    <li><a href="staff_inventory.php"><i class="fas fa-toolbox"></i> Inventory</a></li>
    <li><a href="staff_customer.php"><i class="fas fa-users"></i> Customers</a></li>
    <li><a href="staff_jobcards.php"><i class="fas fa-file-alt"></i> Job Cards</a></li>
    <li><a href="staff_payment.php"><i class="fas fa-credit-card"></i> Payment</a></li>
    <li><a href="staff_supplier.php"><i class="fas fa-boxes"></i> Suppliers</a></li>
  </ul>
</div>

<!-- Main Content -->
<div class="main">
  <!-- Navbar -->
  <div class="navbar">
    <div class="page-info">
      <h1>AHK Auto Care Dashboard</h1>
      <p>Staff access to job cards, inventory, and more.</p>
    </div>
    <div style="display: flex; align-items: center;">
      <div class="notification-icon">
        <i class="fas fa-bell"></i>
      </div>
      <div class="user-profile-container" style="position: relative;">
        <div class="user-info" style="cursor:pointer;">
          <div class="user-label">
            <!-- Optional PHP user info -->
            <!-- <span class="user-name"><?php echo htmlspecialchars($username); ?></span> -->
            <!-- <span class="user-role"><?php echo htmlspecialchars($role); ?></span> -->
          </div>
          <div class="user-icon">
            <i class="fas fa-user"></i>
          </div>
          <span class="dropdown-icon"><i class="fas fa-chevron-down"></i></span>
        </div>
        <ul class="profile-dropdown-menu" hidden>
          <li><a href="staff_profile.php">My Profile</a></li>
          <li><a href="staff_settings.php">Settings</a></li>
          <li><a href="logout.php">Logout</a></li>
        </ul>
      </div>
    </div>
  </div>

  <div class="container">
    <!-- Image Section -->
    <div class="dashboard-image-section">
      <img src="dashboard_staff.png" alt="Dashboard Banner" />
    </div>

   <!-- Staff Availability Section -->
<div class="staff-availability-section container" style="margin-top: 40px; background: white; padding: 20px; border-radius: 12px; box-shadow: 0 4px 12px rgba(0,0,0,0.1); max-width: 100%;">
  <h2 style="margin-bottom: 15px; font-size: 24px; color: #212B36;">Staff Availability</h2>

  <table class="table table-hover">
    <thead style="background-color: rgb(122, 126, 129);">
      <tr>
        <th>Name</th>
        <th>Role</th>
        <th>Availability</th>
      </tr>
    </thead>
    <tbody>
      
<?php
  $sql = "SELECT id, name, role, availability FROM staff";
  $result = $conn->query($sql);

  $availability_classes = [
    'Available' => 'btn-success',
    'Not Available' => 'btn-danger',
    'On Leave' => 'btn-warning'
  ];
  $availability_icons = [
    'Available' => 'bi-check-circle-fill',
    'Not Available' => 'bi-x-circle-fill',
    'On Leave' => 'bi-clock-fill'
  ];

  if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
      $availability = $row['availability'];
      $btn_class = $availability_classes[$availability] ?? 'btn-secondary';
      $icon = $availability_icons[$availability] ?? 'bi-question-circle-fill';

      echo '<tr>';
      echo '<td>' . htmlspecialchars($row['name']) . '</td>';
      echo '<td>' . htmlspecialchars($row['role']) . '</td>';
      echo '<td>
        <form method="post" action="update_availability.php" style="margin:0;">
          <input type="hidden" name="staff_id" value="' . $row['id'] . '"/>
          <div class="dropdown">
            <button class="btn ' . $btn_class . ' dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
              <i class="bi ' . $icon . '"></i> ' . htmlspecialchars($availability) . '
            </button>
            <ul class="dropdown-menu">
              <li><button class="dropdown-item" name="availability" value="Available" type="submit">Available</button></li>
              <li><button class="dropdown-item" name="availability" value="Not Available" type="submit">Not Available</button></li>
              <li><button class="dropdown-item" name="availability" value="On Leave" type="submit">On Leave</button></li>
            </ul>
          </div>
        </form>
      </td>';
      echo '</tr>';
    }
  } else {
    echo '<tr><td colspan="3" class="text-center">No staff data found.</td></tr>';
  }
?>
    </tbody>
  </table>
</div>

<!-- Job Cards Section -->
<div class="job-cards-section container" style="margin-top: 40px; background: white; padding: 20px; border-radius: 12px; box-shadow: 0 4px 12px rgba(0,0,0,0.1); max-width: 100%;">
<h2 style="margin-bottom: 15px; font-size: 24px; color: #212B36;">Job Cards Overview</h2>
<form method="GET" class="mb-3">
  <label for="status" class="form-label fw-bold">Filter by Status:</label>
  <div class="input-group" style="max-width: 300px;">
    <select name="status" id="status" class="form-select">
      <option value="">-- All Statuses --</option>
      <option value="Pending" <?= isset($_GET['status']) && $_GET['status'] === 'Pending' ? 'selected' : '' ?>>Pending</option>
      <option value="In Progress" <?= isset($_GET['status']) && $_GET['status'] === 'In Progress' ? 'selected' : '' ?>>In Progress</option>
      <option value="Completed" <?= isset($_GET['status']) && $_GET['status'] === 'Completed' ? 'selected' : '' ?>>Completed</option>
      <option value="Cancelled" <?= isset($_GET['status']) && $_GET['status'] === 'Cancelled' ? 'selected' : '' ?>>Cancelled</option>
    </select>
    <button type="submit" class="btn btn-primary">Filter</button>
  </div>
</form>
<table class="table table-striped table-hover">
  <thead class="table-dark">
    <tr>
      <th>Job ID</th>
      <th>Customer</th>
      <th>Vehicle</th>
      <th>Service</th>
      <th>Status</th>
      <th>Date In</th>
      <th>Date Out</th>
    </tr>
  </thead>
  <tbody>
<?php
  $status_filter = '';
if (isset($_GET['status']) && $_GET['status'] !== '') {
  $selected_status = $conn->real_escape_string($_GET['status']);
  $status_filter = "WHERE LOWER(status) = LOWER('$selected_status')";
}

$sql = "SELECT job_id, customer_name, vehicles, service, status, date_in, date_out 
        FROM job_cards 
        $status_filter 
        ORDER BY created_at DESC";

  $sql = "SELECT job_id, customer_name, vehicles, service, status, date_in, date_out FROM job_cards ORDER BY created_at DESC";
  $result = $conn->query($sql);

  $status_classes = [
    'Pending' => 'badge bg-warning text-dark',
    'In Progress' => 'badge bg-info text-dark',
    'Completed' => 'badge bg-success',
    'Cancelled' => 'badge bg-danger'
  ];

  if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
      $status_clean = ucwords(strtolower(trim($row['status'])));
      $status_class = $status_classes[$status_clean] ?? 'badge bg-secondary';
      echo '<tr>';
      echo '<td>' . htmlspecialchars($row['job_id']) . '</td>';
      echo '<td>' . htmlspecialchars($row['customer_name']) . '</td>';
      echo '<td>' . htmlspecialchars($row['vehicles']) . '</td>';
      echo '<td>' . htmlspecialchars($row['service']) . '</td>';
      echo '<td><span class="' . $status_class . '">' . $status_clean . '</span></td>';
      echo '<td>' . date('d M Y', strtotime($row['date_in'])) . '</td>';
      echo '<td>' . ($row['date_out'] ? date('d M Y', strtotime($row['date_out'])) : '-') . '</td>';
      echo '</tr>';
    }
  } else {
    echo '<tr><td colspan="7" class="text-center">No job cards available.</td></tr>';
  }
?>
  </tbody>
</table>
<div class="text-end mt-2">
  <a href="job_cards.php" class="text-decoration-underline fw-semibold">More</a>
</div>

</div>

<!-- Google Map Section -->
<div class="container" style="margin-top: 40px; background: #dc3545; padding: 20px; border-radius: 12px; box-shadow: 0 4px 12px rgba(0,0,0,0.1); max-width: 100%;">
  <h2 style="margin-bottom: 10px; text-align: center; color: #ffffff">Location Map</h2><br><br>
  <div style="width: 100%; height: 400px;">
    <iframe 
      src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3983.4173264619294!2d101.4272239!3d3.2459577!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31cc59a479f18167%3A0x6e45dabb20090071!2sAHK%20Auto%20Services!5e0!3m2!1sen!2smy!4v1749308199569!5m2!1sen!2smy" 
      width="100%" 
      height="100%" 
      style="border:0;" 
      allowfullscreen="" 
      loading="lazy" 
      referrerpolicy="no-referrer-when-downgrade">
    </iframe>
  </div>
</div>


<!-- Dropdown Script -->
<script>
  document.addEventListener('DOMContentLoaded', () => {
    const userProfile = document.querySelector('.user-profile-container');
    const dropdown = document.querySelector('.profile-dropdown-menu');
    const icon = userProfile.querySelector('.dropdown-icon i');

    userProfile.addEventListener('click', e => {
      e.stopPropagation();
      const isHidden = dropdown.hasAttribute('hidden');
      dropdown.toggleAttribute('hidden');
      icon.classList.toggle('fa-chevron-down', !isHidden);
      icon.classList.toggle('fa-chevron-up', isHidden);
      userProfile.classList.toggle('active', isHidden);
    });

    document.addEventListener('click', () => {
      if (!dropdown.hasAttribute('hidden')) {
        dropdown.setAttribute('hidden', '');
        icon.classList.replace('fa-chevron-up', 'fa-chevron-down');
        userProfile.classList.remove('active');
      }
    });
  });

function fetchAvailability() {
    fetch('get_staff_availability.php')
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            const tbody = document.getElementById('availability-table-body');
            tbody.innerHTML = ''; // Clear previous data

            data.data.forEach(staff => {
                const row = document.createElement('tr');
                row.innerHTML = 
                    <td>${staff.name}</td>
                    <td>${staff.role}</td>
                    <td><span class="badge" style="background-color: ${staff.availability === 'available' ? '#28a745' : '#dc3545'}">
                        ${staff.availability.charAt(0).toUpperCase() + staff.availability.slice(1)}
                    </span></td>
                ;
                tbody.appendChild(row);
            });
        } else {
            console.error('Error fetching availability:', data.message);
        }
    })
    .catch(err => console.error('Fetch error:', err));
}

setInterval(fetchAvailability, 5000);
fetchAvailability();

</script>

</body>
</html>