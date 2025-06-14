


  function viewStaff(data) {
    document.getElementById("viewStaffName").textContent = data.staff_name;
    document.getElementById("viewRole").textContent = data.role;
    document.getElementById("viewEmail").textContent = data.email;
    document.getElementById("viewContactNumber").textContent = data.contact_number;
    document.getElementById("viewContactNumber").href = "tel:" + data.contact_number;
    document.getElementById("viewDateEnroll").textContent = new Date(data.date_enroll).toLocaleDateString();

    const modal = document.getElementById("viewStaffModal");
    modal.style.display = "flex";
    modal.classList.add("show");
    modal.classList.remove("hide");
  }

  function closeViewModal() {
    const modal = document.getElementById("viewStaffModal");
    modal.classList.add("hide");
    modal.classList.remove("show");
    setTimeout(() => {
      modal.style.display = "none";
    }, 300);
  }

  window.onclick = function(event) {
    if (event.target == modal) {
      closeModal();
    }
    if (event.target == document.getElementById("viewStaffModal")) {
      closeViewModal();
    }
  }

  let currentStaffData = null;

function viewStaff(data) {
  currentStaffData = data; // store current Staff data globally
document.getElementById("viewStaffName").textContent = data.staff_name;
    document.getElementById("viewRole").textContent = data.role;
    document.getElementById("viewEmail").textContent = data.email;
    document.getElementById("viewContactNumber").textContent = data.contact_number;
    document.getElementById("viewContactNumber").href = "tel:" + data.contact_number;
    document.getElementById("viewDateEnroll").textContent = new Date(data.date_enroll).toLocaleDateString();
  // Show the modal
  const modal = document.getElementById("viewStaffModal");
  modal.style.display = "flex";
  modal.classList.add("show");
  modal.classList.remove("hide");

  // Update Edit button to pass current Staff data
  document.getElementById("viewEditBtn").onclick = function () {
    editStaff(currentStaffData);
  };
}

    const editModal = document.getElementById("editStaffModal");

    // Open edit modal and fill with staff data
    function editStaff(data) { 
      document.getElementById("editStaffId").value = data.staff_id;
      document.getElementById("editStaffName").value = data.staff_name;
    document.getElementById("editRole").value = data.role;
    document.getElementById("editEmail").value= data.email;
    document.getElementById("editContactNumber").value = data.contact_number;
    document.getElementById("editContactNumber").href = "tel:" + data.contact_number;
    document.getElementById("editDateEnroll").value = new Date(data.date_enroll).toLocaleDateString();
      // Format date to yyyy-mm-dd for date input
      const date_enroll = new Date(data.date_enroll);
      const yyyy = date_enroll.getFullYear();
      const mm = String(date_enroll.getMonth() + 1).padStart(2, '0');
      const dd = String(date_enroll.getDate()).padStart(2, '0');
      document.getElementById("editDateEnroll").value = `${yyyy}-${mm}-${dd}`;

      editModal.style.display = "flex";
      editModal.classList.add("show");
      editModal.classList.remove("hide");
    }

    // Close edit modal
    function closeEditModal() {
      editModal.classList.add("hide");
      editModal.classList.remove("show");
      setTimeout(() => {
        editModal.style.display = "none";
      }, 300);
    }

    // Close modal when clicking outside of content area
    window.addEventListener('click', function(event) {
      if (event.target === editModal) {
        closeEditModal();
      }
    });

    // Optional: validate phone input on edit form submission
    document.getElementById("editStaffForm").addEventListener("submit", function(event) {
      const contact_number = this.contact_number.value;
      const phoneRegex = /^\d{10,15}$/;
      if (!phoneRegex.test(contact_number)) {
        alert("Please enter a valid phone number (10-15 digits only).");
        event.preventDefault();
      }
    });

    // Delete customer details
    function confirmDelete(staffId) {
    document.getElementById('deleteStaffId').value = staffId;
    const modal = document.getElementById('deleteConfirmModal');
    modal.classList.add('show');
    }

    function closeDeleteModal() {
    const modal = document.getElementById('deleteConfirmModal');
    modal.classList.remove('show');
    }

    // Close modal when clicking outside of content area
    document.getElementById('deleteConfirmModal').addEventListener('click', function(event) {
    // Kalau klik area overlay , bukan dalam content
    if (event.target === this) {
        closeDeleteModal();
    }
    });

    


