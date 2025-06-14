// inventory_script.js

document.addEventListener('DOMContentLoaded', () => {
  // Modal elements
  const addModal = document.getElementById('addModal');
  const editModal = document.getElementById('editModal');
  const deleteModal = document.getElementById('deleteModal');

  // Buttons
  const addBtn = document.getElementById('addBtn');
  const addCloseBtn = addModal.querySelector('.close');
  const editCloseBtn = editModal.querySelector('.close');
  const deleteCloseBtn = deleteModal.querySelector('.close');

  // Forms
  const addForm = document.getElementById('addInventoryForm');
  const editForm = document.getElementById('editInventoryForm');
  const deleteForm = document.getElementById('deleteInventoryForm');

  // Inventory table body
  const inventoryTableBody = document.getElementById('inventoryTableBody');

  // Show Add Modal
  addBtn.addEventListener('click', () => {
    addForm.reset();
    clearFormErrors(addForm);
    addModal.style.display = 'block';
  });

  // Close modals
  [addCloseBtn, editCloseBtn, deleteCloseBtn].forEach(btn => {
    btn.addEventListener('click', () => {
      btn.closest('.modal').style.display = 'none';
    });
  });

  // Close modal when clicking outside modal content
  window.addEventListener('click', (event) => {
    if (event.target === addModal) addModal.style.display = 'none';
    if (event.target === editModal) editModal.style.display = 'none';
    if (event.target === deleteModal) deleteModal.style.display = 'none';
  });

  // Form validation helpers
  function clearFormErrors(form) {
    form.querySelectorAll('.error').forEach(el => el.textContent = '');
  }

  function showError(input, message) {
    const errorSpan = input.parentElement.querySelector('.error');
    if (errorSpan) errorSpan.textContent = message;
  }

  function validateForm(form) {
    clearFormErrors(form);
    let valid = true;

    // Example validation rules:
    // inventory_name: required, min 2 chars
    // category: required
    // sku: required
    // price: required, number > 0
    // stock: required, integer >= 0
    // status: required

    const nameInput = form.querySelector('input[name="inventory_name"]');
    const categoryInput = form.querySelector('input[name="category"]');
    const skuInput = form.querySelector('input[name="sku"]');
    const priceInput = form.querySelector('input[name="price"]');
    const stockInput = form.querySelector('input[name="stock"]');
    const statusInput = form.querySelector('select[name="status"]');

    if (!nameInput.value.trim() || nameInput.value.trim().length < 2) {
      showError(nameInput, 'Inventory name must be at least 2 characters.');
      valid = false;
    }
    if (!categoryInput.value.trim()) {
      showError(categoryInput, 'Category is required.');
      valid = false;
    }
    if (!skuInput.value.trim()) {
      showError(skuInput, 'SKU is required.');
      valid = false;
    }
    if (!priceInput.value.trim() || isNaN(priceInput.value) || Number(priceInput.value) <= 0) {
      showError(priceInput, 'Price must be a positive number.');
      valid = false;
    }
    if (!stockInput.value.trim() || isNaN(stockInput.value) || !Number.isInteger(Number(stockInput.value)) || Number(stockInput.value) < 0) {
      showError(stockInput, 'Stock must be an integer zero or greater.');
      valid = false;
    }
    if (!statusInput.value) {
      showError(statusInput, 'Status is required.');
      valid = false;
    }

    return valid;
  }

  // Helper: Update a row in the table or add a new one
  function updateTableRow(item) {
    let row = document.querySelector(`#inventoryRow_${item.inventory_id}`);

    if (row) {
      // Update existing row
      row.querySelector('.name').textContent = item.inventory_name;
      row.querySelector('.category').textContent = item.category;
      row.querySelector('.sku').textContent = item.sku;
      row.querySelector('.price').textContent = Number(item.price).toFixed(2);
      row.querySelector('.stock').textContent = item.stock;
      row.querySelector('.status').textContent = item.status;
    } else {
      // Add new row
      const tr = document.createElement('tr');
      tr.id = `inventoryRow_${item.inventory_id}`;
      tr.innerHTML = `
        <td class="name">${item.inventory_name}</td>
        <td class="category">${item.category}</td>
        <td class="sku">${item.sku}</td>
        <td class="price">${Number(item.price).toFixed(2)}</td>
        <td class="stock">${item.stock}</td>
        <td class="status">${item.status}</td>
        <td>
          <button class="editBtn" data-id="${item.inventory_id}">Edit</button>
          <button class="deleteBtn" data-id="${item.inventory_id}">Delete</button>
        </td>
      `;
      inventoryTableBody.appendChild(tr);

      // Attach event listeners to new buttons
      tr.querySelector('.editBtn').addEventListener('click', onEditClick);
      tr.querySelector('.deleteBtn').addEventListener('click', onDeleteClick);
    }
  }

  // Remove row from table by id
  function removeTableRow(id) {
    const row = document.querySelector(`#inventoryRow_${id}`);
    if (row) row.remove();
  }

  // Handle Add form submit
  addForm.addEventListener('submit', e => {
    e.preventDefault();
    if (!validateForm(addForm)) return;

    const formData = new FormData(addForm);

    fetch('add_inventory.php', {
      method: 'POST',
      body: formData,
    })
      .then(res => res.json())
      .then(data => {
        if (data.success) {
          updateTableRow(data.item);
          addModal.style.display = 'none';
          alert('Inventory added successfully!');
        } else {
          alert('Error: ' + data.error);
        }
      })
      .catch(() => alert('An error occurred while adding inventory.'));
  });

  // Edit button click handler
  function onEditClick(event) {
    const id = event.target.dataset.id;

    // Find the row data
    const row = document.querySelector(`#inventoryRow_${id}`);
    if (!row) return;

    // Fill form fields with existing data
    editForm.elements['inventory_id'].value = id;
    editForm.elements['inventory_name'].value = row.querySelector('.name').textContent;
    editForm.elements['category'].value = row.querySelector('.category').textContent;
    editForm.elements['sku'].value = row.querySelector('.sku').textContent;
    editForm.elements['price'].value = row.querySelector('.price').textContent;
    editForm.elements['stock'].value = row.querySelector('.stock').textContent;
    editForm.elements['status'].value = row.querySelector('.status').textContent;

    clearFormErrors(editForm);
    editModal.style.display = 'block';
  }

  // Handle Edit form submit
  editForm.addEventListener('submit', e => {
    e.preventDefault();
    if (!validateForm(editForm)) return;

    const formData = new FormData(editForm);

    fetch('update_inventory.php', {
      method: 'POST',
      body: formData,
    })
      .then(res => res.json())
      .then(data => {
        if (data.success) {
          updateTableRow(data.item);
          editModal.style.display = 'none';
          alert('Inventory updated successfully!');
        } else {
          alert('Error: ' + data.error);
        }
      })
      .catch(() => alert('An error occurred while updating inventory.'));
  });

  // Delete button click handler
  function onDeleteClick(event) {
    const id = event.target.dataset.id;
    deleteForm.elements['inventory_id'].value = id;
    deleteModal.style.display = 'block';
  }

  // Handle Delete form submit
  deleteForm.addEventListener('submit', e => {
    e.preventDefault();
    const formData = new FormData(deleteForm);

    fetch('delete_inventory.php', {
      method: 'POST',
      body: formData,
    })
      .then(res => res.json())
      .then(data => {
        if (data.success) {
          removeTableRow(data.inventory_id);
          deleteModal.style.display = 'none';
          alert('Inventory deleted successfully!');
        } else {
          alert('Error: ' + data.error);
        }
      })
      .catch(() => alert('An error occurred while deleting inventory.'));
  });

  // Attach edit and delete buttons on page load
  document.querySelectorAll('.editBtn').forEach(btn => btn.addEventListener('click', onEditClick));
  document.querySelectorAll('.deleteBtn').forEach(btn => btn.addEventListener('click', onDeleteClick));
});
