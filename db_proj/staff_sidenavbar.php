<?php
/* session_start();
** include('staff_auth.php');
** 
** // Fetch user data from database
** $stmt = $conn->prepare("SELECT * FROM users WHERE username = ?");
** $stmt->bind_param("s", $username);
** $stmt->execute();
** $result = $stmt->get_result();
**
** if ($result->num_rows === 1) {
**    $user = $result->fetch_assoc();
**
**    // Store required user info in session
**    $_SESSION['username'] = $user['username'];
**    $_SESSION['role'] = $user['role'];
**    
**    // Redirect to dashboard or protected page
**    header("Location: dashboard.php");
**    exit();
** } else {
**    // Invalid login
**    header("Location: login.html");
**    exit();
** }
*/
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>AHK Auto Care</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
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
      color: #333
    }
    .sidebar {
      width: 240px;
      height: auto; 
      min-height: 100vh; 
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
    .sidebar ul {
      margin-top: 30px;
      list-style: none;
      width: 100%;
    }
    .sidebar .menu-top {
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
      background-color: #dc3545;
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
  </style>
</head>

<body>
<!-- Sidebar with navigation menu -->
<div class="sidebar">
  <img src="ahk_logo.png"/>
  <h2>Staff Menu</h2>
  <ul class="menu-top">
    <!-- Navigation links -->
    <li><a href="staff_dashboard.php"><i class="fas fa-home"></i> Dashboard</a></li>
    <li style="margin-left: 2px;"><a href="staff_inventory.php"><i class="fas fa-toolbox" style="margin-right: 12px;"></i> Inventory</a></li>
    <li><a href="staff_customer.php"><i class="fas fa-users"></i> Customers</a></li>
    <li style="margin-left: 3px;"><a href="staff_jobcards.php"><i class="fas fa-file-alt" style="margin-right: 12px;"></i> Job Cards</a></li>
    <li><a href="staff_payment.php"><i class="fas fa-credit-card"></i> Payment</a></li>
    <li class="active"><a href="staff_supplier.php"><i class="fas fa-boxes"></i> Suppliers</a></li>
  </ul>
</div>

  <div class="main">
    <div class="navbar">
      <div class="page-info">
        <h1>Title name</h1>
        <p>description</p>
      </div>
      <div style="display: flex; align-items: center;">
        <div class="notification-icon">
          <i class="fas fa-bell"></i>
        </div>
        <div class="user-profile-container" style="position: relative;">
          <div class="user-info" style="cursor:pointer;">
            <div class="user-label">
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
  </div>

<script>
  // --- Profile Dropdown Logic ---
  document.addEventListener('DOMContentLoaded', () => {
    const userProfile = document.querySelector('.user-profile-container');
    const dropdown = document.querySelector('.profile-dropdown-menu');
    const icon = userProfile.querySelector('.dropdown-icon i');

    userProfile.addEventListener('click', e => {
      e.stopPropagation(); // Prevent click from bubbling up
      const isHidden = dropdown.hasAttribute('hidden');

      // Toggle dropdown visibility
      dropdown.toggleAttribute('hidden');
      icon.classList.toggle('fa-chevron-down', !isHidden);
      icon.classList.toggle('fa-chevron-up', isHidden);
      userProfile.classList.toggle('active', isHidden);
    });

    // Hide dropdown when clicking outside
    document.addEventListener('click', () => {
      if (!dropdown.hasAttribute('hidden')) {
        dropdown.setAttribute('hidden', '');
        icon.classList.replace('fa-chevron-up', 'fa-chevron-down');
        userProfile.classList.remove('active');
      }
    });
  });
</script>

</body>
</html>