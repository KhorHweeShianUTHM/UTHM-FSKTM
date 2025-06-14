<!-- sidebar.php -->
<div class="sidebar">
  <!-- Logo -->
  <div class="logo-section">
    <img src="logo.png" alt="AHK Auto Logo" width="80" height="80" />
    <h2>AHK Auto</h2>
  </div>

  <!-- Navigation Menu -->
  <ul class="menu-top">
    <li>
      <a href="dashboard.php">
        <i class="fas fa-tachometer-alt"></i> Dashboard
      </a>
    </li>
    <li>
      <a href="inventory.php">
        <i class="fas fa-boxes"></i> Inventory
      </a>
    </li>
    <li>
      <a href="customer.php">
        <i class="fas fa-users"></i> Customers
      </a>
    </li>
    <li>
      <a href="services.php">
        <i class="fas fa-tools"></i> Services
      </a>
    </li>
    <li>
      <a href="appointments.php">
        <i class="fas fa-calendar-alt"></i> Appointments
      </a>
    </li>
  </ul>

  <!-- Bottom Menu (e.g., Logout) -->
  <ul class="menu-bottom">
    <li>
      <a href="logout.php">
        <i class="fas fa-sign-out-alt"></i> Logout
      </a>
    </li>
  </ul>
</div>

<!-- Main Content Container -->
<div class="main">
  <!-- Top Navbar -->
  <div class="navbar">
    <div class="page-info">
      <h1>Inventory</h1>
      <p>Manage your parts and stock</p>
    </div>

    <div class="user-info">
      <div class="notification-icon">
        <i class="fas fa-bell"></i>
      </div>

      <div class="user-profile-container">
        <div class="user-label">
          <div class="user-name">Admin</div>
          <div class="user-role">Manager</div>
        </div>
        <div class="user-icon">
          <i class="fas fa-user"></i>
        </div>
        <div class="dropdown-icon">
          <i class="fas fa-chevron-down"></i>
        </div>

        <!-- Dropdown Menu -->
        <ul class="profile-dropdown-menu" hidden>
          <li><a href="#">Profile</a></li>
          <li><a href="#">Settings</a></li>
          <li><a href="logout.php">Logout</a></li>
        </ul>
      </div>
    </div>
  </div>
</div>
