const modal = document.getElementById("addInventoryModal");

// Open Add Modal
function openModal() {
   modal.style.display = "flex";
    modal.classList.add("show");
    modal.classList.remove("hide");
}

// Close Add/Edit/View/Delete Modal
function closeModal() {
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
    }



// View Inventory
function viewInventory(data) {
  document.getElementById("viewInventoryName").textContent = data.inventory_name;
  document.getElementById("viewCategory").textContent = data.category;
  document.getElementById("viewSKU").textContent = data.sku;
  document.getElementById("viewPrice").textContent = "RM " + parseFloat(data.price).toFixed(2);
  document.getElementById("viewStock").textContent = data.stock;
  document.getElementById("viewStatus").textContent = data.status;

  
    const modal = document.getElementById("viewInventoryModal");
    modal.style.display = "flex";
    modal.classList.add("show");
    modal.classList.remove("hide");
  }

function closeViewModal() {
  const modal = document.getElementById("viewInventoryModal");
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
    if (event.target == document.getElementById("viewInventoryModal")) {
      closeViewModal();
    }
  }

  let currentInventoryData = null;

function viewInventory(data) {
  currentInventoryData = data; // store current inventory data globally

  document.getElementById("viewInventoryName").textContent = data.inventory_name;
  document.getElementById("viewCategory").textContent = data.category;
  document.getElementById("viewSKU").textContent = data.sku;
  document.getElementById("viewPrice").textContent = "RM " + parseFloat(data.price).toFixed(2);
  document.getElementById("viewStock").textContent = data.stock;
  document.getElementById("viewStatus").textContent = data.status;


  // Show the modal
  const modal = document.getElementById("viewInventoryModal");
  modal.style.display = "flex";
  modal.classList.add("show");
  modal.classList.remove("hide");

  // Update Edit button to pass current customer data
  document.getElementById("viewEditBtn").onclick = function () {
    editInventory(currentInventoryData);
  };
}

const editModal = document.getElementById("editInventoryModal");

// Edit Inventory
function editInventory(data) {
  document.getElementById("editInventoryId").value = data.inventory_id;
  document.getElementById("editInventoryName").value = data.inventory_name;
  document.getElementById("editCategory").value = data.category;
  document.getElementById("editSku").value = data.sku;
  document.getElementById("editPrice").value = data.price;
  document.getElementById("editStock").value = data.stock;
  document.getElementById("editStatus").value = data.status;

 editModal.style.display = "flex";
      editModal.classList.add("show");
      editModal.classList.remove("hide");
}

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



    // Delete inventory details
    function confirmDelete(inventoryId) {
    document.getElementById('deleteInventoryId').value = inventoryId;
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

