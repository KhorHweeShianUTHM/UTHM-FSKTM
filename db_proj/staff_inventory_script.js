function changeStock(inventoryId, amount) {
    fetch('staff_update_stock.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
        body: `inventory_id=${inventoryId}&action=${amount}`
    })
    .then(response => response.text())
    .then(data => {
        alert(data);
        location.reload(); // Refresh to show updated stock
    });
}
