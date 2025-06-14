
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



 // ===== SETTINGS PANEL TOGGLE =====
    const settingsPanel = document.getElementById("settingsPanel");
    const openSettingsBtn = document.getElementById("openSettings");

    openSettingsBtn?.addEventListener("click", () => {
    settingsPanel.style.display = "block";
    });

    // ===== TABS FUNCTIONALITY =====
    const tabs = document.querySelectorAll(".tabs .tab");
    const tabContents = document.querySelectorAll(".tab-content");

    tabs.forEach((tab) => {
    tab.addEventListener("click", () => {
        tabs.forEach((t) => {
        t.classList.remove("active");
        t.setAttribute("aria-selected", "false");
        t.setAttribute("tabindex", "-1");
        });
        tabContents.forEach((c) => (c.hidden = true));

        tab.classList.add("active");
        tab.setAttribute("aria-selected", "true");
        tab.setAttribute("tabindex", "0");
        const panelId = tab.getAttribute("aria-controls");
        document.getElementById(panelId).hidden = false;
    });
    });

    // ===== GENERAL TAB EDIT BUTTONS =====
    const generalForm = document.querySelector(".general-form");
    generalForm?.querySelectorAll(".edit-btn").forEach((btn, idx) => {
    btn.addEventListener("click", () => {
        const inputs = [
        generalForm.querySelector("#workshopName"),
        generalForm.querySelector("#contactNumber"),
        generalForm.querySelector("#emailAddress"),
        generalForm.querySelector("#address"),
        generalForm.querySelector("#uploadLogo"),
        ];
        const input = inputs[idx];
        input.disabled = false;
        input.focus();
    });
    });

    // ===== ADD USER POPUP =====
    const addUserBtn = document.getElementById("add-user");
    const addUserPopup = document.getElementById("addUserPopup");
    const closeAddUserPopup = document.querySelector(".close-popup");

    addUserBtn?.addEventListener("click", () => {
    addUserPopup.classList.add("active");
    });

    closeAddUserPopup?.addEventListener("click", () => {
    addUserPopup.classList.remove("active");
    });

    window.addEventListener("click", (e) => {
    if (e.target === addUserPopup) {
        addUserPopup.classList.remove("active");
    }
    });

    // ===== ADD NEW USER (FORM SUBMIT) =====
    document.getElementById("newUserForm")?.addEventListener("submit", function (e) {
    e.preventDefault();
    const formData = new FormData(this);

    fetch("Setting.php", {
        method: "POST",
        body: formData,
    })
        .then((res) => res.text())
        .then((data) => {
        if (data.includes("<tr")) {
            alert("User added successfully!");
            this.reset();
            addUserPopup.classList.remove("active");
            document.querySelector("#userTable tbody").innerHTML = data;
            attachEditDeleteHandlers();
        } else {
            alert("Error adding user: " + data);
        }
        })
        .catch((err) => alert("Fetch error: " + err));
    });

    // ===== SAVE CHANGES FOR GENERAL SETTINGS =====
    document.getElementById("saveChangesBtn")?.addEventListener("click", function () {
    const form = document.getElementById("generalForm");
    const formData = new FormData(form);

    fetch("save_changes.php", {
        method: "POST",
        body: formData,
    })
        .then((res) => res.text())
        .then((data) => {
        alert(data);
        })
        .catch((err) => alert("Error saving changes: " + err));
    });

    // ===== LOAD USERS =====
    function loadUsers() {
    fetch("Setting.php")
        .then((res) => res.text())
        .then((data) => {
        document.querySelector("#userTable tbody").innerHTML = data;
        attachEditDeleteHandlers();
        })
        .catch((err) => console.error("Error loading users:", err));
    }

    // ===== LOAD GENERAL SETTINGS =====
    function loadGeneralSettings() {
    fetch("save_changes.php")
        .then((res) => res.json())
        .then((data) => {
        document.getElementById("workshopName").value = data.workshop_name || "";
        document.getElementById("contactNumber").value = data.contact_number || "";
        document.getElementById("emailAddress").value = data.email || "";
        document.getElementById("address").value = data.address || "";
        })
        .catch((err) => console.error("Error loading settings:", err));
    }

    // ===== OPEN EDIT USER POPUP =====
    function openEditPopup(userId, fullName, email, role) {
        const editUserPopup = document.getElementById("editUserPopup");
        const editOverlay = document.getElementById("editOverlay"); // get overlay

        document.getElementById("user_id").value = userId;
        document.getElementById("full_name_edit").value = fullName;
        document.getElementById("email_edit").value = email;
        document.getElementById("role_edit").value = role;
        document.getElementById("password_edit").value = ""; // Clear password field

        editUserPopup.style.display = "block";
        editOverlay.style.display = "block"; //show overlay

    }

    function attachEditDeleteHandlers() {
        // Edit User
        document.querySelectorAll(".edit-user-btn").forEach((btn) => {
            btn.onclick = () => {
                const userId = btn.dataset.id;
                const name = btn.dataset.name;
                const email = btn.dataset.email;
                const role = btn.dataset.role;

                openEditPopup(userId, name, email, role);
            };
        });

        // Delete User (same as before — do not modify unless needed)
        document.querySelectorAll(".delete-btn").forEach((btn) => {
            btn.onclick = () => {
                const userId = btn.getAttribute("data-id");
                if (confirm("Are you sure you want to delete this user?")) {
                    fetch("Setting.php", {
                        method: "POST",
                        body: new URLSearchParams({ action: "delete", user_id: userId }),
                    })
                    .then((res) => res.text())
                    .then((data) => {
                        document.querySelector("#userTable tbody").innerHTML = data;
                        attachEditDeleteHandlers();
                    })
                    .catch((err) => alert("Error deleting user: " + err));
                }
            };
        });
    }


    // ===== ON PAGE LOAD =====
    window.addEventListener("DOMContentLoaded", () => {
    loadUsers();
    loadGeneralSettings();
    attachEditDeleteHandlers(); // Initial
    });

    // ===== Submit Handler for Editing a User =====
        document.getElementById("editUserForm")?.addEventListener("submit", function (e) {
        e.preventDefault();
        const formData = new FormData(this);
        formData.append("action", "edit");

        fetch("update_user.php", {
            method: "POST",
            body: formData,
        })
            .then((res) => res.text())
            .then((data) => {
                const trimmed = data.trim();
                if (trimmed === "success") {
                    alert("User updated successfully!");
                    document.getElementById("editUserPopup").style.display = "none";
                    document.getElementById("editOverlay").style.display = "none";
                    loadUsers(); // Reload table data
                } else if (trimmed === "nochange") {
                    alert("No changes detected.");
                } else {
                    alert("Error updating user: " + trimmed);
                }
            })
            .catch((err) => alert("Fetch error: " + err));
    });


    // ===== CLOSE EDIT USER POPUP =====
    const editUserPopup = document.getElementById("editUserPopup");
    const closeEditPopup = document.getElementById("closeEditPopup");
    const editOverlay = document.getElementById("editOverlay"); // get overlay

    closeEditPopup?.addEventListener("click", () => {
        editUserPopup.style.display = "none";
        editOverlay.style.display = "none"; // hide overlay
    });

    window.addEventListener("click", (e) => {
        if (e.target === editUserPopup) {
            editUserPopup.style.display = "none";
            editOverlay.style.display = "none"; //hide overlay
        }
    });


    // Optional: click outside to close
    window.addEventListener("click", (e) => {
    const editPopup = document.getElementById("editUserPopup");
    if (e.target === editPopup) {
        editPopup.classList.remove("active");
    }
    });




    