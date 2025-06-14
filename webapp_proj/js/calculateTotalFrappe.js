function calculateTotal() {
    const beverageName = document.querySelector('input[name="beverageName"]:checked').value;

    let addonsPrice = 0;
    const addonsCheckboxes = document.querySelectorAll('input[name="addons[]"]:checked');
    addonsCheckboxes.forEach(checkbox => {
        addonsPrice += 2; 
    });

    let basePrice = 12.50;
    let totalPrice = basePrice + addonsPrice;

    document.getElementById('totalPriceDisplay').innerText = `RM${totalPrice.toFixed(2)}`;

    document.getElementById('hiddenTotalPrice').value = totalPrice.toFixed(2);
}

function googleSearch() {
	var query = document.getElementById('searchInput').value;
    window.location.href = 'https://www.google.com/search?q=' + encodeURIComponent(query);
}