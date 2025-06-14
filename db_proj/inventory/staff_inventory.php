<?php
// staff_inventory.php
include 'config.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>AHK Auto Care - Staff Inventory</title>
  <link rel="stylesheet" href="sidenavbar_styles.css">
  <link rel="stylesheet" href="staff_inventory_styles.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>
<body>

<?php if (isset($_GET['updated'])): ?>
  <script>
    alert('Stock updated successfully');
  </script>
<?php endif; ?>

<!-- SIDEBAR -->
<div class="sidebar">
  <img src="logo.png" alt="AHK Auto Logo" width="80" height="80" />
  <h2>AHK Auto</h2>
  <ul class="menu-top">
    <li><i class="fas fa-home"></i> Dashboard</li>
      <li style="margin-left: 2px;"><i class="fas fa-toolbox" style="margin-right: 12px;"></i> Inventory</li>
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
  <div class="navbar">
    <div class="page-info">
      <h1>Inventory Stock Management</h1>
      <p>Allows staff to update inventory stock levels</p>
    </div>
    <div style="display: flex; align-items: center;">
        <div class="notification-icon">
          <i class="fas fa-bell"></i>
        </div>
        <div class="user-profile-container" style="position: relative;">
          <div class="user-info" style="cursor:pointer;">
            <div class="user-label">
              <span class="user-name">Dani</span>
              <span class="user-role">Mechanic</span>
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
        <input type="text" name="search" placeholder="Search inventory ..." value="<?php echo isset($_GET['search']) ? htmlspecialchars($_GET['search']) : ''; ?>">
        <button type="submit"><i class="fas fa-search"></i> Search</button>
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
            <th>Update Stock</th>
          </tr>
        </thead>
        <tbody>
          <?php
          include 'config.php';

          $search = isset($_GET['search']) ? $conn->real_escape_string($_GET['search']) : '';

          $records_per_page = 8;
          $page = isset($_GET['page']) && is_numeric($_GET['page']) ? (int)$_GET['page'] : 1;
          $offset = ($page - 1) * $records_per_page;

          $count_sql = "SELECT COUNT(*) AS total FROM inventory";
          if (!empty($search)) {
              $count_sql .= " WHERE inventory_name LIKE '%$search%'";
          }
          $count_result = $conn->query($count_sql);
          $total_records = $count_result->fetch_assoc()['total'];
          $total_pages = ceil($total_records / $records_per_page);

          $sql = "SELECT inventory_id, inventory_name, category, sku, stock, price, status FROM inventory";
          if (!empty($search)) {
              $sql .= " WHERE inventory_name LIKE '%$search%'";
          }
          $sql .= " LIMIT $records_per_page OFFSET $offset";
          $result = $conn->query($sql);

          if ($result && $result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
              echo "<tr>";
              echo "<td>" . htmlspecialchars($row['inventory_name']) . "</td>";
              echo "<td>" . htmlspecialchars($row['category']) . "</td>";
              echo "<td>" . htmlspecialchars($row['sku']) . "</td>";
              echo "<td>RM " . number_format($row['price'], 2) . "</td>";
              echo "<td>" . htmlspecialchars($row['stock']) . "</td>";
              echo "<td>" . htmlspecialchars($row['status']) . "</td>";
              echo "<td>
                      <form method='POST' action='staff_update_stock.php' style='display: flex; gap: 5px; align-items: center;'>
                        <input type='hidden' name='inventory_id' value='{$row['inventory_id']}'>
                        <button type='submit' name='action' value='decrease' class='stock-btn'>-</button>
                        <button type='submit' name='action' value='increase' class='stock-btn'>+</button>
                      </form>
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
      <div class="pagination" style="margin-bottom: 20px;">
        <a href="<?php echo ($page > 1) ? "?search=".urlencode($search)."&page=".($page - 1) : '#'; ?>"
          class="<?php echo ($page <= 1) ? 'disabled' : ''; ?>">
          <i class="fas fa-chevron-left"></i>
        </a>

        <?php for ($i = 1; $i <= $total_pages; $i++): ?>
          <a href="?search=<?php echo urlencode($search); ?>&page=<?php echo $i; ?>"
            class="<?php echo ($i == $page) ? 'active' : ''; ?>">
            <?php echo $i; ?>
          </a>
        <?php endfor; ?>

        <a href="<?php echo ($page < $total_pages) ? "?search=".urlencode($search)."&page=".($page + 1) : '#'; ?>"
          class="<?php echo ($page >= $total_pages) ? 'disabled' : ''; ?>">
          <i class="fas fa-chevron-right"></i>
        </a>
      </div>
    </div>
  </div>
</div>

<script src="sidenavbar_script.js"></script>
<script src="staff_inventory_script.js"></script>
<script>
  document.addEventListener('DOMContentLoaded', function () {
    const paginationLinks = document.querySelectorAll('.pagination a');

    paginationLinks.forEach(link => {
      if (link.classList.contains('active')) {
        // Already styled
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
</script>

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
    background-color: #c82333;
  }

  .pagination a.disabled {
    pointer-events: none;
    opacity: 0.5;
  }

  .pagination a.active {
    font-weight: bold;
    text-decoration: underline;
  }
</style>

</body>
</html>
