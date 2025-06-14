// Payment.js - Handles profile dropdown, payment CRUD operations, notification logic, and popup handling

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

document.addEventListener('DOMContentLoaded', () => {
  // === Profile Dropdown Logic ===
  const userProfile = document.querySelector('.user-profile-container');
  const dropdown = document.querySelector('.profile-dropdown-menu');
  const icon = userProfile.querySelector('.dropdown-icon i');

  userProfile.addEventListener('click', e => {
    e.stopPropagation();
    const isHidden = dropdown.hasAttribute('hidden');

    // Close notification popup if open
    if (!notificationPopup.hasAttribute('hidden')) {
      notificationPopup.setAttribute('hidden', '');
      notificationContainer.classList.remove('active');
    }

    dropdown.toggleAttribute('hidden');
    icon.classList.toggle('fa-chevron-down', !isHidden);
    icon.classList.toggle('fa-chevron-up', isHidden);
    userProfile.classList.toggle('active', isHidden);
  });

  // === Notification Popup Logic ===
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

  // === Hide all popups when clicking outside ===
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

  // === Add Payment Popup Logic ===
  const popup = document.getElementById("popup");
  const addBtn = document.getElementById("add-payment");
  const closeBtn = document.getElementById("closePopup");
  const form = document.getElementById("payment-form");

  addBtn.addEventListener("click", () => {
    popup.style.display = "flex";
  });

  closeBtn.addEventListener("click", () => {
    popup.style.display = "none";
  });

  form.addEventListener("submit", async (e) => {
    e.preventDefault();

    const data = {
      fullname: document.getElementById("fullname").value,
      method: document.getElementById("payment-method").value,
      status: document.getElementById("payment-status").value,
      amount: document.getElementById("amount").value
    };

    try {
      const response = await fetch("insert_payment.php", {
        method: "POST",
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify(data)
      });

      const result = await response.json();
      if (result.success) {
        addPaymentToTable(result.payment);
        popup.style.display = "none";
        form.reset();
      } else {
        alert("Failed to add payment.");
      }
    } catch (err) {
      console.error("Error:", err);
      alert("An error occurred while processing payment.");
    }
  });

  // === Add Row to Table ===
  function addPaymentToTable(payment) {
    const tbody = document.querySelector("#payment-records tbody");
    const row = document.createElement("tr");

    const displayID = 'P' + payment.paymentID.toString().padStart(2, '0');

    row.innerHTML = `
      <td>${displayID}</td>
      <td>${payment.fullname}</td>
      <td>${payment.method}</td>
      <td>${payment.status}</td>
      <td>${payment.amount}</td>
      <td>${payment.datetime}</td>
      <td>${payment.updated_at || ''}</td>
      <td>
        <button class="btn-edit" data-paymentid="${payment.paymentID}" title="Edit">
          <i class="fas fa-pen"></i>
        </button>
        <button class="btn-delete" data-paymentid="${payment.paymentID}" title="Delete">
          <i class="fas fa-trash"></i>
        </button>
      </td>

    `;

    tbody.appendChild(row);
  }

  // === Load Existing Payments on Page Load ===
  async function loadPayments() {
    try {
      const response = await fetch("get_payments.php");
      if (!response.ok) throw new Error("Failed to fetch payments");
      const payments = await response.json();

      const tbody = document.querySelector("#payment-records tbody");
      tbody.innerHTML = "";

      payments.forEach(payment => addPaymentToTable(payment));
    } catch (error) {
      console.error("Error loading payments:", error);
    }
  }

  loadPayments();

  // === Handle Edit Button Click ===
  document.addEventListener("click", function (e) {
    if (e.target.classList.contains("btn-edit")) {
      const paymentID = e.target.getAttribute("data-paymentid");

      fetch(`get_payment.php?id=${paymentID}`)
        .then(res => res.json())
        .then(data => {
          document.getElementById("edit-paymentID").value = data.paymentID;
          document.getElementById("edit-fullname").value = data.fullname;
          document.getElementById("edit-method").value = data.method;
          document.getElementById("edit-status").value = data.status;
          document.getElementById("edit-amount").value = data.amount;

          // Store original values in a data attribute
          editForm.dataset.original = JSON.stringify({
            fullname: data.fullname,
            method: data.method,
            status: data.status,
            amount: data.amount
          });

          document.getElementById("edit-popup").style.display = "flex";
        })
        .catch(err => {
          alert("Failed to load payment details.");
          console.error(err);
        });
    }
  });

  // === Handle Delete Button Click ===
  document.addEventListener("click", async function (e) {
    if (e.target.classList.contains("btn-delete")) {
      const paymentID = e.target.getAttribute("data-paymentid");

      if (confirm(`Are you sure you want to delete payment ID: ${paymentID}?`)) {
        try {
          const response = await fetch("delete_payment.php", {
            method: "POST",
            headers: { "Content-Type": "application/x-www-form-urlencoded" },
            body: "paymentID=" + encodeURIComponent(paymentID)
          });

          const result = await response.json();
          if (result.success) {
            alert(result.message);
            e.target.closest("tr").remove();
          } else {
            alert("Failed to delete payment: " + result.message);
          }
        } catch (error) {
          alert("Error deleting payment: " + error.message);
        }
      }
    }
  });

  // === Handle Edit Form Submission ===
  const editForm = document.getElementById("edit-payment-form");

  editForm.addEventListener("submit", async function (e) {
    e.preventDefault();

    const formData = new FormData(editForm);

    const original = JSON.parse(editForm.dataset.original || "{}");
    const current = {
      fullname: formData.get("fullname"),
      method: formData.get("method"),
      status: formData.get("status"),
      amount: formData.get("amount")
    };

    const noChanges =
      current.fullname === original.fullname &&
      current.method === original.method &&
      current.status === original.status &&
      current.amount === original.amount;

    if (noChanges) {
      alert("No changes were made.");
      return; // Stop submission
    }

    try {
      const response = await fetch("edit_payment.php", {
        method: "POST",
        body: formData
      });

      const result = await response.json();
      if (result.success) {
        alert("Payment updated successfully!");
        document.getElementById("edit-popup").style.display = "none";
        loadPayments();
      } else {
        alert("Failed to update payment.");
      }
    } catch (error) {
      alert("Error updating payment: " + error.message);
    }
  });

  // === Close Edit Popup ===
  const closeEditBtn = document.getElementById("closeEditPopup");
  closeEditBtn.addEventListener("click", function () {
    document.getElementById("edit-popup").style.display = "none";
  });

});
