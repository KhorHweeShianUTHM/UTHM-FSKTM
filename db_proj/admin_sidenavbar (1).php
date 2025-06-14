<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>AHK Auto Care</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>

<style>
/* =============== Global Reset & Font =============== */
* {
  margin: 0;
  padding: 0;
  box-sizing: border-box;
  font-family: 'Inter', sans-serif;
}

/* =============== Page Body Layout =============== */
body {
  display: flex;
  background-color: #f0f2f5;
  color: #333;
}

/* =============== Sidebar Styles =============== */
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

/* =============== Main Content Area =============== */
.main {
  flex: 1;
  display: flex;
  flex-direction: column;
}

/* =============== Navbar Styles =============== */
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
  position: relative; /* Added for notification popup positioning */
}
.navbar .notification-icon i,
.navbar .dropdown-icon i {
  color: #333;
}

/* =============== Dropdown Menu Styles =============== */
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

/* =============== Notification Popup Styles =============== */
.notification-popup {
  position: absolute;
  top: 100%;
  right: 0;
  width: 380px;
  background-color: #ffffff;
  border: 1px solid #e0e0e0;
  border-radius: 8px;
  box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
  overflow: hidden;
  display: flex;
  flex-direction: column;
  z-index: 1000;
  margin-top: 10px;
}

.notification-popup[hidden] {
  display: none;
}

.popup-header {
  display: flex;
  justify-content: space-between;
  align-items: center;
  padding: 16px;
  border-bottom: 1px solid #e0e0e0;
}

.popup-header h2 {
  margin: 0;
  font-size: 18px;
  font-weight: 600;
}

.popup-header .mark-all-read {
  font-size: 14px;
  font-weight: 600;
  color: #d9534f;
  text-decoration: none;
  cursor: pointer;
}

.popup-header .mark-all-read:hover {
  text-decoration: underline;
}

.notification-list {
  padding: 0;
  margin: 0;
  list-style: none;
  max-height: 400px;
  overflow-y: auto;
}

.notification-item {
  padding: 16px;
  border-bottom: 1px solid #e0e0e0;
}

.notification-item:last-child {
  border-bottom: none;
}

.notification-item h3 {
  margin: 0 0 4px 0;
  font-size: 16px;
  font-weight: 600;
}

.notification-item .notification-message {
  margin: 0;
  font-size: 14px;
  color: #555;
  line-height: 1.4;
}

.notification-item .notification-timestamp {
  margin: 8px 0 0 0;
  font-size: 12px;
  color: #888;
}

.no-notifications {
  text-align: center;
  padding: 40px 20px;
  color: #888;
  font-size: 15px;
}

.popup-footer {
  padding: 12px;
  text-align: center;
  border-top: 1px solid #e0e0e0;
}

.popup-footer .view-all-btn {
  background-color: transparent;
  border: none;
  color: #333;
  font-size: 14px;
  font-weight: 600;
  cursor: pointer;
  width: 100%;
  padding: 8px;
  border-radius: 6px;
  transition: background-color 0.2s ease;
}

.popup-footer .view-all-btn:hover {
  background-color: #f8f9fa;
}

/* Active state for notification icon */
.notification-container.active .notification-icon {
  background-color: rgba(157, 157, 157, 0.1);
}
</style>

<body>

<!-- Sidebar with navigation menu -->
<div class="sidebar">
  <img src="ahk_logo.png"/>
  <h2>Admin Menu</h2>
  <ul class="menu-top">
    <li><a href="admin_dashboard.php"><i class="fas fa-home"></i> Dashboard</a></li>
    <li style="margin-left: 2px;"><a href="admin_inventory.php"><i class="fas fa-toolbox" style="margin-right: 12px;"></i> Inventory</a></li>
    <li class="active"><a href="admin_customer.php"><i class="fas fa-users"></i> Customers</a></li>
    <li style="margin-left: 3px;"><a href="admin_jobcards.php"><i class="fas fa-file-alt" style="margin-right: 12px;"></i> Job Cards</a></li>
    <li><a href="admin_payment.php"><i class="fas fa-credit-card"></i> Payment</a></li>
    <li><a href="admin_analytics.php"><i class="fas fa-chart-line"></i> Analytics</a></li>
    <li><a href="admin_supplier.php"><i class="fas fa-boxes"></i> Suppliers</a></li>
    <li><a href="admin_setting.php"><i class="fas fa-cog"></i> Settings</a></li>
  </ul>
</div>

<!-- Main content section -->
<div class="main">
  <!-- Top navbar -->
  <div class="navbar">
    <div class="page-info">
      <h1>Project Title</h1>
      <p>Project Description</p>
    </div>
    <!-- User profile and notification -->
    <div style="display: flex; align-items: center;">
      <!-- Notification Container -->
      <div class="notification-container" style="position: relative;">
        <div class="notification-icon"><i class="fas fa-bell"></i></div>
        <!-- Notification Popup -->
        <div class="notification-popup" hidden>
          <div class="popup-header">
            <h2>Notifications</h2>
            <a href="notification.html" class="mark-all-read">Mark as all read</a>
          </div>
          
          <div class="notification-list" id="notification-list-container">
          </div>

          <div class="popup-footer">
            <button class="view-all-btn" onclick="window.location.href='notification.html';">
              View all Notifications
            </button>
          </div>
        </div>
      </div>
      
      <div class="user-profile-container" style="position: relative;">
        <div class="user-info" style="cursor:pointer;">
          <div class="user-label">
              <!-- <span class="user-name"><?php echo htmlspecialchars($username); ?></span> -->
              <!-- <span class="user-role"><?php echo htmlspecialchars($role); ?></span> -->
          </div>
          <div class="user-icon"><i class="fas fa-user"></i></div>
          <span class="dropdown-icon"><i class="fas fa-chevron-down"></i></span>
        </div>
        <!-- Dropdown menu for user options -->
        <ul class="profile-dropdown-menu" hidden>
          <li><a href="admin_profile.php">My Profile</a></li>
          <li><a href="admin_setting.php">Settings</a></li>
          <li><a href="logout.php">Logout</a></li>
        </ul>
      </div>
    </div>
  </div>
</div>

<script>
  // --- Notification Functions ---
  async function fetchNotifications() {
    try {
      const response = await fetch('fetch_notifications.php');
      if (!response.ok) throw new Error('Network response was not ok');
      const data = await response.json();
      return data;
    } catch (error) {
      console.error('Fetch error:', error);
      return [];
    }
  }

  function renderNotifications(notifications) {
    const container = document.getElementById('notification-list-container');
    container.innerHTML = '';

    if (!notifications.length) {
      container.innerHTML = `<div class="no-notifications">You're all caught up!</div>`;
      return;
    }

    const ul = document.createElement('ul');
    ul.style.listStyle = 'none';
    ul.style.padding = '0';
    ul.style.margin = '0';

    notifications.forEach(notification => {
      const li = document.createElement('li');
      li.className = 'notification-item';

      li.innerHTML = `
        <h3>${notification.title}</h3>
        <p class="notification-message">${notification.description}</p>
        <p class="notification-timestamp">${notification.timestamp}</p>
      `;
      ul.appendChild(li);
    });
    container.appendChild(ul);
  }

  // --- Profile Dropdown Logic ---
  document.addEventListener('DOMContentLoaded', () => {
    const userProfile = document.querySelector('.user-profile-container');
    const dropdown = document.querySelector('.profile-dropdown-menu');
    const icon = userProfile.querySelector('.dropdown-icon i');

    userProfile.addEventListener('click', e => {
      e.stopPropagation();
      const isHidden = dropdown.hasAttribute('hidden');

      // Close notification popup if open
      const notificationPopup = document.querySelector('.notification-popup');
      const notificationContainer = document.querySelector('.notification-container');
      if (!notificationPopup.hasAttribute('hidden')) {
        notificationPopup.setAttribute('hidden', '');
        notificationContainer.classList.remove('active');
      }

      dropdown.toggleAttribute('hidden');
      icon.classList.toggle('fa-chevron-down', !isHidden);
      icon.classList.toggle('fa-chevron-up', isHidden);
      userProfile.classList.toggle('active', isHidden);
    });

    // --- Notification Popup Logic ---
    const notificationContainer = document.querySelector('.notification-container');
    const notificationPopup = document.querySelector('.notification-popup');

    notificationContainer.addEventListener('click', async e => {
      e.stopPropagation();
      const isHidden = notificationPopup.hasAttribute('hidden');

      // Close profile dropdown if open
      if (!dropdown.hasAttribute('hidden')) {
        dropdown.setAttribute('hidden', '');
        icon.classList.replace('fa-chevron-up', 'fa-chevron-down');
        userProfile.classList.remove('active');
      }

      // Toggle notification popup
      notificationPopup.toggleAttribute('hidden');
      notificationContainer.classList.toggle('active', isHidden);

      // Load notifications when opening popup
      if (isHidden) {
        const notifications = await fetchNotifications();
        renderNotifications(notifications);
      }
    });

    // Hide dropdowns when clicking outside
    document.addEventListener('click', () => {
      if (!dropdown.hasAttribute('hidden')) {
        dropdown.setAttribute('hidden', '');
        icon.classList.replace('fa-chevron-up', 'fa-chevron-down');
        userProfile.classList.remove('active');
      }
      
      if (!notificationPopup.hasAttribute('hidden')) {
        notificationPopup.setAttribute('hidden', '');
        notificationContainer.classList.remove('active');
      }
    });
  });
</script>

</body>
</html>