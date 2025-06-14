<?php
session_start();
include('config/db.php'); // Database connection

// INPUT FILTERING
$period = $_GET['user_filter'] ?? 'day';         // Filter period: day, week, month, year
$activity_filter = $_GET['activity_filter'] ?? ''; // Filter activity: online, offline
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1; // Current pagination page
$limit = 5;                                       // Items per page
$offset = ($page - 1) * $limit;                   // Offset for pagination

// ACTIVITY CONDITION (Online/Offline)
$activity_condition = match ($activity_filter) {
    'online' => "WHERE last_login >= NOW() - INTERVAL 10 MINUTE",   // User active within 10 mins
    'offline' => "WHERE last_login < NOW() - INTERVAL 10 MINUTE",   // User inactive for more than 10 mins
    default => "", // No filter
};

// TOTAL USERS COUNT (for summary card)
$query_users = match ($period) {
    'week' => "SELECT COUNT(*) AS total_users FROM users WHERE YEARWEEK(created_at, 1) = YEARWEEK(CURDATE(), 1)",
    'month' => "SELECT COUNT(*) AS total_users FROM users WHERE MONTH(created_at) = MONTH(CURDATE()) AND YEAR(created_at) = YEAR(CURDATE())",
    'year' => "SELECT COUNT(*) AS total_users FROM users WHERE YEAR(created_at) = YEAR(CURDATE())",
    default => "SELECT COUNT(*) AS total_users FROM users WHERE DATE(created_at) = CURDATE()" // Default = today
};

$result_users = $conn->query($query_users);
if (!$result_users) die("Error fetching total users: " . $conn->error);

$total_users = $result_users->fetch_assoc()['total_users'];

// CHART DATA (Users registered over time)
$trend_labels = []; // X-axis labels (days, dates, or months)
$trend_counts = []; // Y-axis data points (counts)

switch ($period) {
    case 'week':
        $start = strtotime('monday this week');
        for ($i = 0; $i < 7; $i++) {
            $date = date('Y-m-d', $start + (86400 * $i));
            $trend_labels[] = date('D', strtotime($date)); // Mon, Tue, etc.
            $row = $conn->query("SELECT COUNT(*) AS count FROM users WHERE DATE(created_at) = '$date'")->fetch_assoc();
            $trend_counts[] = (int)$row['count'];
        }
        break;

    case 'month':
        $daysInMonth = date('t');
        for ($d = 1; $d <= $daysInMonth; $d++) {
            $date = date('Y-m-' . str_pad($d, 2, '0', STR_PAD_LEFT));
            $trend_labels[] = (string)$d; // 1, 2, ..., 31
            $row = $conn->query("SELECT COUNT(*) AS count FROM users WHERE DATE(created_at) = '$date'")->fetch_assoc();
            $trend_counts[] = (int)$row['count'];
        }
        break;

    case 'year':
        for ($m = 1; $m <= 12; $m++) {
            $trend_labels[] = date('M', mktime(0, 0, 0, $m, 1)); // Jan, Feb, ...
            $row = $conn->query("SELECT COUNT(*) AS count FROM users WHERE MONTH(created_at) = $m AND YEAR(created_at) = YEAR(CURDATE())")->fetch_assoc();
            $trend_counts[] = (int)$row['count'];
        }
        break;

    case 'day':
    default:
        for ($i = 6; $i >= 0; $i--) {
            $date = date('Y-m-d', strtotime("-$i days"));
            $trend_labels[] = date('D', strtotime($date)); // Mon, Tue, etc.
            $row = $conn->query("SELECT COUNT(*) AS count FROM users WHERE DATE(created_at) = '$date'")->fetch_assoc();
            $trend_counts[] = (int)$row['count'];
        }
        break;
}

// PAGINATION SETUP (for user list table)
$count_query = "SELECT COUNT(*) AS total FROM users $activity_condition";
$total_result = $conn->query($count_query);
$total_users_paginated = $total_result->fetch_assoc()['total'];
$total_pages = ceil($total_users_paginated / $limit); // For pagination buttons

// FINAL DATA FETCH (Paginated user activity list)
$query_activity = "
    SELECT id, name, role, created_at, last_login
    FROM users
    $activity_condition
    ORDER BY last_login DESC
    LIMIT $limit OFFSET $offset";

$result_activity = $conn->query($query_activity);

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"/>
  <title>AHK Auto Care - Admin Dashboard</title>
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
  height: auto;
  min-height: 100vh; /* Ensure sidebar spans full height */
  background-color: #5a5a59;
  color: white;
  padding: 20px 0;
  align-items: center;
}
.sidebar img {
  margin-top: 10px;
}
.sidebar h2 {
  margin-top: 30px;
  font-size: 20px;
  text-align: center;
}
.sidebar ul,
.sidebar .menu-top {
  margin-top: 30px;
  list-style: none;
  width: 100%;
}
.sidebar ul li {
  display: flex;
  align-items: center;
  padding: 15px 30px;
  cursor: pointer;
  transition: background 0.2s;
}
.sidebar ul li:hover {
  background-color: #dc3545; /* Highlight on hover */
}
.sidebar ul li i {
  margin-right: 10px;
  flex-shrink: 0;
}
.sidebar ul li a {
  display: flex;
  align-items: center;
  width: 100%;
  height: 100%;
  text-decoration: none;
  color: white;
}
.sidebar ul li a:hover {
  text-decoration: none;
  color: white;
}
.main {
  flex: 1;
  display: flex;
  flex-direction: column;
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
.navbar .user-icon,
.navbar .notification-icon {
  width: 32px;
  height: 32px;
  background-color: #EFF4FB;
  border-radius: 50%;
  display: flex;
  justify-content: center;
  align-items: center;
  font-size: 14px;
  border: 1px solid #E2E8F0;
  cursor: pointer;
}
.navbar .notification-icon {
  margin-right: 40px;
}
.navbar .notification-icon i,
.navbar .dropdown-icon i {
  color: #333;
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
/* line */

.card-container {
  display: flex;
  gap: 20px;
  justify-content: space-between;
  margin: 30px 30px;
}

.card {
  background-color: #ffffff;
  border-radius: 8px;
  padding: 20px;
  box-shadow: 0 4px 12px rgba(0,0,0,0.1);
  width: 48%;
  height: 300px; /* Set a fixed height to make all cards the same height */
}


.card h3 {
  font-size: 18px;
  font-weight: 600;
  color: #212B36;
  margin-bottom: 10px;
}

.card .card-value {
  font-size: 22px;
  font-weight: 700;
  color: #dc3545;
}

.card .chart-container {
  height: 300px;
}

.card-container .card:nth-child(5) {
  width: 48%;
}


.welcome-box {
  margin: 20px 30px 10px 30px;
  background-color: #dc3545;
  border-radius: 8px;
  padding: 20px 30px;
  color: white;
  font-weight: 600;
  font-size: 20px;
  user-select: none;
  max-width: 100%;
  box-shadow: 0 2px 8px rgba(0,0,0,0.12);
  text-align: center;
}

.image-container {
  text-align: center;
  margin: 20px 30px;
  display: none;
}
.image-container.active {
  display: block;
}
.image-container img {
  width: 100%;
  max-width: 100%;
  height: auto;
  border-radius: 8px;
  box-shadow: 0 2px 8px rgba(0,0,0,0.15);
  display: block;
}

.card canvas {
  margin-top: 15px;
  height: 140px !important;
}

/* Container for Recently Active Users */
.recent-users-container {
  margin: 20px 30px;
  background-color: #ffffff; /* white background for modern UI */
  border-radius: 8px;
  padding: 20px 30px;
  color: #212B36;
  font-weight: 600;
  font-size: 18px;
  user-select: none;
  box-shadow: 0 2px 8px rgba(0,0,0,0.12);
  overflow-x: auto; /* allow horizontal scroll on small screens */
}

.recent-users-container h3 {
  margin-bottom: 15px;
  color: #dc3545;
}

.recent-users {
  width: 100%;
  border-collapse: collapse;
  font-size: 14px;
}

.recent-users th,
.recent-users td {
  padding: 12px 16px;
  text-align: left;
  border-bottom: 1px solid #ddd;
  background-color:rgb(207, 207, 207);
}

.recent-users th {
  background-color:rgb(164, 174, 183);
  color: #212B36;
  font-size: 14px;
}

.recent-users tr:hover {
  background-color: #f1f1f1;
}

.maps-section {
  display: flex;
  justify-content: center;
  margin: 20px 30px;
  padding: 20px 0;
  background-color: #dc3545;
  border-radius: 8px;
  box-shadow: 0 2px 8px rgba(0, 0, 0, 0.12);
  flex-direction: column;
  align-items: center;
  text-align: center;
}

</style>

<body>

<!-- Sidebar with navigation menu -->
<div class="sidebar">
  <img src="ahk_logo.png"/>
  <h2>Admin Menu</h2>
  <ul class="menu-top">
    <li class="active"><a href="admin_dashboard.php">
      <i class="fas fa-home"></i> Dashboard
    </a></li>
    <li style="margin-left: 2px;"><a href="admin_inventory.php">
      <i class="fas fa-toolbox" style="margin-right: 12px;"></i> Inventory
    </a></li>
    <li><a href="admin_customer.php">
      <i class="fas fa-users"></i> Customers
    </a></li>
    <li style="margin-left: 3px;"><a href="admin_jobcards.php">
      <i class="fas fa-file-alt" style="margin-right: 12px;"></i> Job Cards
    </a></li>
    <li><a href="admin_payment.php">
      <i class="fas fa-credit-card"></i> Payment
  </a></li>
    <li><a href="admin_analytics.php">
      <i class="fas fa-chart-line"></i> Analytics
    </a></li>
    <li><a href="admin_supplier.php">
      <i class="fas fa-boxes"></i> Suppliers
    </a></li>
    <li><a href="admin_setting.php">
      <i class="fas fa-cog"></i> Settings
    </a></li>
  </ul>
</div>

<!-- Main content section -->
<div class="main">
  <div class="navbar">
    <div class="page-info">
      <h1>Admin Dashboard</h1>
    </div>
    <div class="user-info">
      <div class="notification-icon"><i class="fas fa-bell"></i></div>
      <div class="user-profile-container" style="position: relative;">
        <div class="user-info" style="cursor:pointer;">
          <div class="user-label"></div>
          <div class="user-icon"><i class="fas fa-user"></i></div>
          <span class="dropdown-icon"><i class="fas fa-chevron-down"></i></span>
        </div>
        <ul class="profile-dropdown-menu hidden">
          <li><a href="admin_profile.php">My Profile</a></li>
          <li><a href="admin_setting.php">Settings</a></li>
          <li><a href="logout.php">Logout</a></li>
        </ul>
      </div>
    </div>
  </div>

  <div class="welcome-box">
    Welcome back, <b>Admin</b>!<br /><br /> Have a nice day!
  </div>

  <?php if (isset($_GET['msg']) && $_GET['msg'] == 'updated'): ?>
  <div style="margin: 10px 30px; padding: 10px; background: #d4edda; color: #155724; border: 1px solid #c3e6cb; border-radius: 5px;">
    Staff availability successfully updated.
  </div>
<?php endif; ?>

  <div class="image-container active" id="dashboard-image-container">
    <img src="img/dashboard_admin.png" alt="Dashboard background" id="dashboard-image" />
  </div>

  <!-- Staff Availability Management -->
<div class="recent-users-container" style="margin-top: 20px;">
  <h3 style="margin-bottom: 10px;">Staff Availability</h3><br>
  <form method="POST" action="update_availability.php">
    <table class="recent-users">
      <thead>
        <tr>
          <th>Name</th>
          <th>Role</th>
          <th>Availability</th>
        </tr>
      </thead>
      <tbody>
        <?php
        include('config/db.php');
        $staff_result = $conn->query("SELECT id, name, role, availability FROM staff");
        while ($staff = $staff_result->fetch_assoc()):
        ?>
        <tr>
          <td><?php echo htmlspecialchars($staff['name']); ?></td>
          <td><?php echo htmlspecialchars($staff['role']); ?></td>
          <td>
            <?php
$availabilityOptions = [
  'Available' => 'Available',
  'Not Available' => 'Not Available',
  'On Leave' => 'On Leave'
];

?>
<select name="availability[<?php echo $staff['id']; ?>]">
  <?php foreach ($availabilityOptions as $value => $label): ?>
    <option value="<?php echo $value; ?>" <?php echo (strtolower($staff['availability']) === strtolower($value)) ? 'selected' : ''; ?>>
  <?php echo $label; ?>
</option>

  <?php endforeach; ?>
</select>

          </td>
        </tr>
        <?php endwhile; ?>
      </tbody>
    </table>
    
    <div style="margin-top: 15px;">
      <button type="submit" style="padding: 10px 20px; background-color: #dc3545; color: white; border: none; border-radius: 5px; cursor: pointer;">
        Update Availability
      </button>
    </div>
  </form>
</div>


<div class="card-container">
  <!-- Total Users Card -->
 <div class="card">
  <h3>Total Users</h3>
  <!-- Filter dropdown -->
  <form method="GET" action="" style="margin-bottom: 10px;">
    <select name="user_filter" onchange="this.form.submit()" style="padding: 5px; width: 100%;">
      <option value="">Filter by</option>
      <option value="day" <?php if ($period == 'day') echo 'selected'; ?>>Today</option>
      <option value="week" <?php if ($period == 'week') echo 'selected'; ?>>This Week</option>
      <option value="month" <?php if ($period == 'month') echo 'selected'; ?>>This Month</option>
      <option value="year" <?php if ($period == 'year') echo 'selected'; ?>>This Year</option>
    </select>
  </form>

  <!-- Chart canvas -->
  <canvas id="userChart" style="width:100%; height:120px;"></canvas>
</div>


  <!-- User Activity Card -->
  <div class="card">
    <h3>User Activity</h3>
    <!-- Filter dropdown -->
    <form method="GET" action="" style="margin-bottom: 10px;">
     <select name="activity_filter" onchange="this.form.submit()" style="padding: 5px; width: 100%;">
  <option value="">Filter by</option>
  <option value="online" <?php if ($activity_filter === 'online') echo 'selected'; ?>>Online</option>
  <option value="offline" <?php if ($activity_filter === 'offline') echo 'selected'; ?>>Offline</option>
</select>
</form>
    
    <!-- User Activity Table -->
    <table class="recent-users" style="width: 100%; margin-top: 20px;">
      <thead>
        <tr>
          <th>Username</th>
          <th>Last Login</th>
          <th>Status</th>
        </tr>
      </thead>
      <tbody>
        <?php while ($row_activity = $result_activity->fetch_assoc()): 
          $status = (strtotime($row_activity['last_login']) > strtotime('-10 minutes')) ? 'online' : 'offline';
        ?>
          <tr>
            <td>
              <a href="admin_user_profile.php?id=<?php echo $row_activity['id']; ?>" title="Last login: <?php echo $row_activity['last_login']; ?>" style="color: #000000; text-decoration: none;">
                <?php echo htmlspecialchars($row_activity['name']); ?>
              </a>
            </td>
            <td><?php echo date('Y-m-d H:i:s', strtotime($row_activity['last_login'])); ?></td>
            <td>
              <span class="badge <?php echo $status; ?>">
                <?php echo ucfirst($status); ?>
              </span>
            </td>
          </tr>
        <?php endwhile; ?>
      </tbody>
    </table>
    <!-- Pagination links -->
<div class="text-center mt-3">
  <?php for ($i = 1; $i <= $total_pages; $i++): ?>
    <a 
      href="?activity_filter=<?= $activity_filter ?>&page=<?= $i ?>" 
      class="btn btn-sm <?= ($i == $page) ? 'btn-primary' : 'btn-outline-primary' ?>"
    >
      <?= $i ?>
    </a>
  <?php endfor; ?>
</div>
  </div>
</div>

<!-- Location Map Section -->
<div class="maps-section">
  <h2 style="margin-bottom: 10px; color: #ffffff">Location Map</h2><br><br>
  <div class="card conversion-rate-card" style="height: auto;">
    <div style="width: 100%; height: 450px;">
      <iframe 
        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3983.4173264619294!2d101.4272239!3d3.2459577!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31cc59a479f18167%3A0x6e45dabb20090071!2sAHK%20Auto%20Services!5e0!3m2!1sen!2smy!4v1749308199569!5m2!1sen!2smy" 
        width="100%" 
        height="100%" 
        style="border:0; border-radius: 8px;" 
        allowfullscreen="" 
        loading="lazy" 
        referrerpolicy="no-referrer-when-downgrade">
      </iframe>
    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <script>
  const ctx = document.getElementById('userChart').getContext('2d');

  const userChart = new Chart(ctx, {
    type: 'line',
    data: {
      labels: <?php echo json_encode($trend_labels); ?>,
      datasets: [{
        label: 'New Users',
        data: <?php echo json_encode($trend_counts); ?>,
        backgroundColor: 'rgba(220, 53, 69, 0.2)',
        borderColor: 'rgba(220, 53, 69, 1)',
        borderWidth: 2,
        pointBackgroundColor: 'rgba(220, 53, 69, 1)',
        pointBorderColor: '#fff',
        tension: 0.4,
        fill: true
      }]
    },
    options: {
      responsive: true,
      maintainAspectRatio: false,
      scales: {
        y: {
          beginAtZero: true,
          ticks: {
            stepSize: 1
          }
        }
      },
      plugins: {
        legend: {
          display: false
        }
      }
    }
  });
</script>
</body>
</html>


