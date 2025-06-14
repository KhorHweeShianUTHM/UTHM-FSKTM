<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>AHK Auto Care - Inventory</title>
  <link rel="stylesheet" href="sidenavbar_styles.css">
  <link rel="stylesheet" href="admin_inventory_styles.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <!--<script src="https://kit.fontawesome.com/your-fontawesome-key.js" crossorigin="anonymous"></script>
  <script src="sidenavbar_script.js" defer></script>-->
</head>
<body>

  <!-- SIDEBAR -->
  <div class="sidebar">
    <img src="logo.png" alt="AHK Auto Logo" width="80" height="80" />
    <h2>AHK Auto</h2>
    <ul class="menu-top">
      <li><i class="fas fa-home"></i> Dashboard</li>
      <li><a href="admin_inventory.php"><i class="fas fa-users"></i> Inventory</a></li>
      <li><a href="customer.php"><i class="fas fa-users"></i> Customers</a></li>
      <li style="margin-left: 3px;"><i class="fas fa-file-alt" style="margin-right: 12px;"></i> Job Cards</li>
      <li><i class="fas fa-credit-card"></i> Payment</li>
      <li><i class="fas fa-chart-line"></i> Analytics</li>
      <li><i class="fas fa-boxes"></i> Suppliers</li>
      <li><i class="fas fa-cog"></i> Settings</li></ul>
    <ul class="menu-bottom">
      <li><a href="logout.php"><i class="fas fa-sign-out-alt"></i> Sign Out</a></li>
    </ul>
  </div>

  <!-- MAIN CONTENT -->
  <div class="main">

    <!-- NAVBAR -->
    <div class="navbar">
      <div class="page-info">
        <h1>Inventory Management</h1>
        <p>Allows the admin to manage and track inventory items</p>
      </div>
       <div style="display: flex; align-items: center;">
        <div class="notification-icon">
          <i class="fas fa-bell"></i>
        </div>
        <div class="user-profile-container" style="position: relative;">
          <div class="user-info" style="cursor:pointer;">
            <div class="user-label">
              <span class="user-name">Boss</span>
              <span class="user-role">Admin</span>
            </div>
            <div class="user-icon">
              <i class="fas fa-user"></i>
            </div>
            <span class="dropdown-icon"><i class="fas fa-chevron-down"></i></span>
          </div>
          <ul class="profile-dropdown-menu" hidden>
            <li><a href="profile.html">My Profile</a></li>
            <li><a href="admin_staffList.php">Manage Staff</a></li>
            <li><a href="#">Settings</a></li>
            <li><a href="#">Logout</a></li>
          </ul>
        </div>
      </div>
    </div>

    <!-- CONTENT CONTAINER -->
    <div class="content">
      <!-- TOP BAR (Search + Add Button) -->
      <div class="top-bar">
        <form method="GET" action="" style="display: flex; gap: 10px;">
          <input type="text" name="search" placeholder="Search inventory ..." value="<?php echo isset($_GET['search']) ? htmlspecialchars($_GET['search']) : ''; ?>">
          <button type="submit"><i class="fas fa-search"></i> Search</button>
          <button type="button" style="margin-left: 810px;" onclick="openModal()"><i class="fas fa-plus"></i> Add Inventory</button>
        </form>
      </div>

      <!-- INVENTORY TABLE -->
       <div class="table-pagination-wrapper">
      <table>
        <thead>
          <tr>
            <th>Inventory Name</th>
            <th>Category</th>
            <th>SKU</th>
            <th>Price</th>
            <th>Stock</th>
            <th>Status</th>
            <th>Actions</th>
          </tr>
        </thead>
        <!-- <tbody id="inventoryTable"> -->
          <tbody>
          <!-- Dynamic rows will be added via PHP or JavaScript -->
           <?php
    // Connect to database
    include 'config.php';

    $search = isset($_GET['search']) ? $conn->real_escape_string($_GET['search']) : '';

          // Tetapkan berapa rekod per halaman
          $records_per_page = 8;

          // Dapatkan nombor halaman dari URL, default 1
          $page = isset($_GET['page']) && is_numeric($_GET['page']) ? (int)$_GET['page'] : 1;

          // Kira OFFSET untuk SQL
          $offset = ($page - 1) * $records_per_page;

          // Query kira jumlah rekod dulu (untuk pagination)
          $count_sql = "SELECT COUNT(*) AS total FROM inventory";
          if (!empty($search)) {
              $count_sql .= " WHERE inventory_name LIKE '%$search%'";
          }
          $count_result = $conn->query($count_sql);
          $total_records = $count_result->fetch_assoc()['total'];

          // Kira jumlah halaman
          $total_pages = ceil($total_records / $records_per_page);
    // Fetch inventory
    $sql = "SELECT inventory_id, inventory_name, category, sku, stock, price, status FROM inventory";
          if (!empty($search)) {
              $sql .= " WHERE inventory_name LIKE '%$search%'";
          }
          $sql .= " LIMIT $records_per_page OFFSET $offset";
    $result = $conn->query($sql);

    if (!empty($search)) {
            echo "<p>Showing results for \"<strong>" . htmlspecialchars($search) . "</strong>\"</p>";
          }

    if ($result->num_rows > 0) {
      while ($row = $result->fetch_assoc()) {
        /*echo "<tr data-id='" . $row['inventory_id'] . "'>";
        echo "<td class='col-name'>" . htmlspecialchars($row['inventory_name']) . "</td>";
        echo "<td class='col-category'>" . htmlspecialchars($row['category']) . "</td>";
        echo "<td class='col-sku'>" . htmlspecialchars($row['sku']) . "</td>";
        echo "<td class='col-price'>RM " . number_format($row['price'], 2) . "</td>";
        echo "<td class='col-stock'>" . htmlspecialchars($row['stock']) . "</td>";
        echo "<td class='col-status'>" . htmlspecialchars($row['status']) . "</td>"; */
        echo "<tr>";
        echo "<td>" . htmlspecialchars($row['inventory_name']) . "</td>";
        echo "<td>" . htmlspecialchars($row['category']) . "</td>";
        echo "<td>" . htmlspecialchars($row['sku']) . "</td>";
        echo "<td>RM " . htmlspecialchars($row['price']) . "</td>";
        echo "<td>" . htmlspecialchars($row['stock']) . "</td>";
        echo "<td>" . htmlspecialchars($row['status']) . "</td>";
        echo "<td class='actions'>
          <i class='fas fa-eye' onclick='viewInventory(" . json_encode($row) . ")'></i>
          <i class='fas fa-pen' onclick='editInventory(" . json_encode($row) . ")'></i>
          <i class='fas fa-trash' onclick='confirmDelete(" . $row['inventory_id'] . ")'></i>
          </td>";
        echo "</tr>";

      }
    } else {
      echo "<tr><td colspan='7'>No inventory items found.</td></tr>";
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
        
  <!-- MODALS HERE -->

  <!-- Add Inventory Modal -->
<div id="addInventoryModal" class="modal">
  <div class="modal-content">
    <span class="close-btn" onclick="closeModal()">&times;</span>
    <h2>Add New Staff</h2>
    <form method="POST" action="admin_inventory_add.php" id="inventoryForm">
    <div class="form-group">
      <label >Inventory Name</label>
      <input type="text" name="inventory_name" required>
      </div>
      
      <div class="form-group">
      <label>Category</label>
      <input type="text" name="category" required>
      </div>

      <div class="form-group">
      <label>SKU</label>
      <input type="text" name="sku" required>
      </div>

      <div class="form-group">
      <label>Price (RM)</label>
      <input type="number" name="price" step="0.01" required>
      </div>

       <div class="form-group">
      <label>Stock</label>
      <input type="number" name="stock" required>
      </div>

      <div class="form-group">
      <label>Status</label>
      <select name="status" required>
        <option value="">Select Status</option>
        <option value="In Stock">In Stock</option>
        <option value="Low Stock">Low Stock</option>
        <option value="Out of Stock">Out of Stock</option>
      </select>
</div>
      <button type="submit" class="submit-btn">Add Inventory</button>
    </form>
  </div>
</div>

<!-- View Inventory Modal -->
    <div id="viewInventoryModal" class="modal">
      <div class="modal-content">
        <span class="close-btn" onclick="closeViewModal()">&times;</span>
        <h2 style="margin-bottom: 20px;">Inventory Details</h2>
        <div id="inventoryDetails" class="inventory-info-grid">
          <div class="info-box">
            <i class="fas fa-box"></i>
            <div><strong>Inventory Name:</strong><br><span id="viewInventoryName"></span></div>
          </div>
          <div class="info-box">
            <i class="fas fa-tags"></i>
            <div><strong>Category:</strong><br><a id="viewCategory" ></a></div>
          </div>
          <div class="info-box">
            <i class="fas fa-barcode"></i>
            <div><strong>SKU:</strong><br><span id="viewSKU"></span></div>
          </div>
          <div class="info-box">
            <i class="fas fa-dollar-sign"></i>
            <div><strong>Price:</strong><br><span id="viewPrice"></span></div>
          </div>
          <div class="info-box">
            <i class="fas fa-warehouse"></i>
            <div><strong>Stock:</strong><br><span id="viewStock"></span></div>
          </div>
          <div class="info-box">
            <i class="fas fa-info-circle"></i>
            <div><strong>Status:</strong><br><span id="viewStatus"></span></div>
          </div>
        </div>
        <div style="margin-top: 20px; text-align: right;">
          <button id="viewEditBtn" class="submit-btn">Edit</button>
          <button class="submit-btn" style="background-color: #6c757d;" onclick="closeViewModal()">Close</button>
        </div>
      </div>
    </div>

<!-- Edit modal -->
    <div id="editInventoryModal" class="modal">
  <div class="modal-content">
    <span class="close-btn" onclick="closeEditModal()">&times;</span>
    <h2>Edit Inventory Details</h2>
    <form method="POST" action="admin_inventory_update.php" id="editInventoryForm">
  <input type="hidden" id="editInventoryId" name="inventory_id">

    <div class="form-group">
      <label >Inventory Name</label>
      <input type="text" name="inventory_name" id="editInventoryName"  required>
      </div>
      
      <div class="form-group">
      <label>Category</label>
      <input type="text" name="category" id="editCategory"  required>
      </div>

      <div class="form-group">
      <label>SKU</label>
      <input type="text" name="sku" id="editSku"  required>
      </div>

      <div class="form-group">
      <label>Price</label>
      <input type="number" name="price" step="0.01" id="editPrice" required>
      </div>

       <div class="form-group">
      <label>Stock</label>
      <input type="number" name="stock" id="editStock" required>
      </div>

      <div class="form-group">
      <label>Status</label>
      <select name="status" id="editStatus" required>
        <option value="">Select Status</option>
        <option value="In Stock">In Stock</option>
        <option value="Low Stock">Low Stock</option>
        <option value="Out of Stock">Out of Stock</option>
      </select>
</div>
      <button type="submit" class="submit-btn">Save Changes</button>
      </form>
    </div>
  </div>


<!-- Delete modal -->
<div id="deleteConfirmModal" class="modal">
  <div class="modal-content">
    <span class="close-btn" onclick="closeDeleteModal()">&times;</span>
    <h2>Confirm Delete</h2>
    <p>Are you sure you want to delete this inventory?</p>
        <form method="POST" action="admin_inventory_delete.php">
          <input type="hidden" name="inventory_id" id="deleteInventoryId" />
            <div style="margin-top: 20px; text-align: right;">
              <button type="submit" class="submit-btn" style="background-color: #dc3545;">Delete</button>
              <button type="button" class="submit-btn" style="background-color: #6c757d;" onclick="closeDeleteModal()">Close</button>

            </div>
        </form>
      </div>
    </div>

<!-- content -->
  </div>
  <script src="sidenavbar_script.js"></script>
  <script src="admin_inventory_script.js"></script>
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

