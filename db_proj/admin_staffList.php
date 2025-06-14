<?php
// staff_inventory.php
include 'config.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>AHK Auto Care - Staff List</title>
  <link rel="stylesheet" href="sidenavbar_styles.css">
  <link rel="stylesheet" href="admin_staffList_styles.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>
<body>

<!-- SIDEBAR -->
<div class="sidebar">
  <img src="logo.png" alt="AHK Auto Logo" width="80" height="80" />
  <h2>AHK Auto</h2>
  <ul class="menu-top">
    <li><i class="fas fa-home"></i> Dashboard</li>
    <li><a href="staff_inventory.php"><i class="fas fa-box"></i> Inventory</a></li>
    <li><a href="customer.php"><i class="fas fa-users"></i> Customers</a></li>
  </ul>
  <ul class="menu-bottom">
    <li><a href="logout.php"><i class="fas fa-sign-out-alt"></i> Sign Out</a></li>
  </ul>
</div>

<!-- MAIN CONTENT -->
<div class="main">
  <div class="navbar">
    <div class="page-info">
      <h1>Admin Staff Management</h1>
      <p>Allows admin to update and manage staffs</p>
    </div>
    <div style="display: flex; align-items: center;">
        <div class="notification-icon">
          <i class="fas fa-bell"></i>
        </div>
        <div class="user-profile-container" style="position: relative;">
          <div class="user-info" style="cursor:pointer;">
            <div class="user-label">
              <span class="user-name">Haziqah</span>
              <span class="user-role">Admin</span>
            </div>
            <div class="user-icon">
              <i class="fas fa-user"></i>
            </div>
            <span class="dropdown-icon"><i class="fas fa-chevron-down"></i></span>
          </div>
          <ul class="profile-dropdown-menu" hidden>
            <li><a href="profile.html">My Profile</a></li>
            
            <li><a href="#">Settings</a></li>
            <li><a href="#">Logout</a></li>
          </ul>
        </div>
      </div>
    </div>

  <div class="content">
    <!-- TOP BAR -->
    <div class="top-bar">
      <form method="GET" style="display: flex; gap: 10px;">
        <input type="text" name="search" placeholder="Search staff ..." value="<?php echo isset($_GET['search']) ? htmlspecialchars($_GET['search']) : ''; ?>">
        <button type="submit"><i class="fas fa-search"></i> Search</button>
         <button type="button" style="margin-left: 810px;" onclick="window.location.href='signup.html'">
        <i class="fas fa-plus"></i> Add Staff
      </button>
    </form>
    </div>

    <!-- INVENTORY TABLE -->
    <div class="table-pagination-wrapper">
      <table>
        <thead>
          <tr>
            <th>Staff Name</th>
            <th>Role</th>
            <th>Email</th>
            <th>Contact Number</th>
            <th>Date Enroll</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          <?php
          include 'config.php';

          $search = isset($_GET['search']) ? $conn->real_escape_string($_GET['search']) : '';

          // Tetapkan berapa rekod per halaman
          $records_per_page = 8;

          
          // Dapatkan nombor halaman dari URL, default 1
          $page = isset($_GET['page']) && is_numeric($_GET['page']) ? (int)$_GET['page'] : 1;

          // Kira OFFSET untuk SQL
          $offset = ($page - 1) * $records_per_page;

          
          // Query kira jumlah rekod dulu (untuk pagination)
          $count_sql = "SELECT COUNT(*) AS total FROM users";
          if (!empty($search)) {
              $count_sql .= " WHERE staff_name LIKE '%$search%'";
          }
          $count_result = $conn->query($count_sql);
          $total_records = $count_result->fetch_assoc()['total'];

          
          // Kira jumlah halaman
          $total_pages = ceil($total_records / $records_per_page);

          $sql = "SELECT staff_id, staff_name, role, date_enroll, email, contact_number FROM users";
          if (!empty($search)) {
              $sql .= " WHERE staff_name LIKE '%$search%'";
          }
          $sql .= " LIMIT $records_per_page OFFSET $offset";
          $result = $conn->query($sql);


          if ($result && $result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
              echo "<tr>";
              echo "<td>" . htmlspecialchars($row['staff_name']) . "</td>";
              echo "<td>" . htmlspecialchars($row['role']) . "</td>";
              echo "<td>" . htmlspecialchars($row['email']) . "</td>";
              echo "<td>" . htmlspecialchars($row['contact_number']) . "</td>";
              echo "<td>" . htmlspecialchars($row['date_enroll']) . "</td>";
              echo "<td class='actions'>
                <i class='fas fa-eye' onclick='viewStaff(" . json_encode($row) . ")'></i>
                <i class='fas fa-pen' onclick='editStaff(" . json_encode($row) . ")'></i>
                <i class='fas fa-trash' onclick='confirmDelete(" . $row['staff_id'] . ")'></i>
                </td>";
              echo "</tr>";
            }
          } else {
            echo "<tr><td colspan='7'>No staff name found.</td></tr>";
          }
          $conn->close();
          ?>
        </tbody>
      </table>
      
      <!-- PAGINATION -->
       <!-- Prev button -->
      <div class="pagination" style="margin-bottom: 20px;">
        <a href="<?php echo ($page > 1) ? "?search=".urlencode($search)."&page=".($page - 1) : '#'; ?>"
          class="<?php echo ($page <= 1) ? 'disabled' : ''; ?>">
          <i class="fas fa-chevron-left"></i>
          </a>

          <!-- Page numbers -->
        <?php for ($i = 1; $i <= $total_pages; $i++): ?>
          <a href="?search=<?php echo urlencode($search); ?>&page=<?php echo $i; ?>"
            class="<?php echo ($i == $page) ? 'active' : ''; ?>">
            <?php echo $i; ?>
          </a>
        <?php endfor; ?>

        <!-- Next button -->
        <a href="<?php echo ($page < $total_pages) ? "?search=".urlencode($search)."&page=".($page + 1) : '#'; ?>"
          class="<?php echo ($page >= $total_pages) ? 'disabled' : ''; ?>">
          <i class="fas fa-chevron-right"></i>
        </a>
      </div>
      </div>
     
      
    <!-- View Staff Modal -->
    <div id="viewStaffModal" class="modal">
      <div class="modal-content">
        <span class="close-btn" onclick="closeViewModal()">&times;</span>
        <h2 style="margin-bottom: 20px;">Staff Details</h2>
        <div id="staffDetails" class="customer-info-grid">
          <div class="info-box">
            <i class="fas fa-user"></i>
            <div><strong>Staff Name:</strong><br><span id="viewStaffName"></span></div>
          </div>
          
          <div class="info-box">
            <i class="fas fa-car"></i>
            <div><strong>Role:</strong><br><span id="viewRole"></span></div>
          </div>
          <div class="info-box">
            <i class="fas fa-id-card"></i>
            <div><strong>Email:</strong><br><span id="viewEmail"></span></div>
          </div>
          <div class="info-box">
            <i class="fas fa-phone"></i>
            <div><strong>Contact Number:</strong><br><a id="viewContactNumber" href="#"></a></div>
          </div>
          <div class="info-box">
            <i class="fas fa-calendar-check"></i>
            <div><strong>Date Enroll:</strong><br><span id="viewDateEnroll"></span></div>
          </div>
        </div>
        <div style="margin-top: 20px; text-align: right;">
          <button id="viewEditBtn" class="submit-btn">Edit</button>
          <button class="submit-btn" style="background-color: #6c757d;" onclick="closeViewModal()">Close</button>
        </div>
      </div>
    </div>

    <!-- Edit Staff Modal -->
    <div id="editStaffModal" class="modal">
      <div class="modal-content">
        <span class="close-btn" onclick="closeEditModal()">&times;</span>
        <h2>Edit Staff Details</h2>
        <form method="POST" action="admin_staffList_update.php" id="editStaffForm">
          <input type="hidden" id="editStaffId" name="staff_id">

          <div class="form-group">
            <label>Staff Name</label>
            <input type="text" name="staff_name" id="editStaffName" required>
          </div>
          
          <div class="form-group">
            <label>Role</label>
            <input type="text" name="role" id="editRole" required>
          </div>
          <div class="form-group">
            <label>Email</label>
            <input type="text" name="email" id="editEmail" required>
          </div>
          <div class="form-group">
            <label>Contact Number</label>
            <input type="text" name="contact_number" id="editContactNumber" required>
          </div>
          <div class="form-group">
            <label>Date Enroll</label>
            <input type="date" name="date_enroll" id="editDateEnroll" required>
          </div>
          <button type="submit" class="submit-btn">Save Changes</button>
        </form>
      </div>
    </div>

    <!-- Delete Confirmation Modal -->
    <div id="deleteConfirmModal" class="modal">
      <div class="modal-content">
        <span class="close-btn" onclick="closeDeleteModal()">&times;</span>
        <h2>Confirm Delete</h2>
        <p>Are you sure you want to delete this staff ?</p>
        <form method="POST" action="admin_staffList_delete.php">
          <input type="hidden" name="staff_id" id="deleteStaffId" />
            <div style="margin-top: 20px; text-align: right;">
              <button type="submit" class="submit-btn" style="background-color: #dc3545;">Delete</button>
              <button type="button" class="submit-btn" style="background-color: #6c757d;" onclick="closeDeleteModal()">Close</button>

            </div>
        </form>
      </div>
    </div>
    </div> 
  </div>

<!-- content -->
  </div>
  <script src="sidenavbar_script.js"></script>
  <script src="admin_staffList_script.js"></script>
  <script>
    document.addEventListener('DOMContentLoaded', function() {
    const paginationLinks = document.querySelectorAll('.pagination a');
    
    paginationLinks.forEach(link => {
      if (link.classList.contains('active')) {
        // Already handled by PHP for active page
      }
    });
  
    // Disable prev/next if needed
    const prev = document.querySelector('.pagination a[href*="page=' + (<?php echo $page ?> - 1) + '"]');
    const next = document.querySelector('.pagination a[href*="page=' + (<?php echo $page ?> + 1) + '"]');

    if (!prev) {
      const leftArrow = document.querySelector('.pagination a i.fa-chevron-left');
      if (leftArrow) leftArrow.parentElement.classList.add('disabled');
    }
    if (!next) {
      const rightArrow = document.querySelector('.pagination a i.fa-chevron-right');
      if (rightArrow) rightArrow.parentElement.classList.add('disabled');
    }
  });

  document.querySelectorAll('.pagination a.disabled').forEach(el => {
    el.addEventListener('click', e => {
      e.preventDefault(); // prevent click action
    });
  });
  </script>
</body>
</html>
    </div>
  </div>
</div>

<style>
  .stock-btn {
    background-color: #dc3545;
    color: white;
    border: none;
    padding: 8px 12px;
    cursor: pointer;
    font-size: 16px;
    border-radius: 4px;
  }

  .stock-btn:hover {
    background-color: #dc3545;
  }
</style>

</body>
</html>
