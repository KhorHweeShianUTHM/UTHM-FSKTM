    document.addEventListener('DOMContentLoaded', () => {
        const cartItems = document.querySelectorAll('.cart-item');
        const cartTotal = document.getElementById('cart-total');
        const purchaseBtn = document.getElementById('purchase-btn');
    
        function updateSubtotal(itemRow) {
            const price = parseFloat(itemRow.querySelector('.item-price').textContent);
            const quantity = parseInt(itemRow.querySelector('.item-quantity').value);
            const subtotal = price * quantity;
            itemRow.querySelector('.item-subtotal').textContent = subtotal.toFixed(2);
            updateTotal();
        }
    
        function updateTotal() {
            let total = 0;
            cartItems.forEach(item => {
                const subtotal = parseFloat(item.querySelector('.item-subtotal').textContent);
                total += subtotal;
            });
            cartTotal.textContent = total.toFixed(2);
        }
    
        cartItems.forEach(item => {
            const quantityInput = item.querySelector('.item-quantity');
            const removeButton = item.querySelector('.remove-item');
    
            quantityInput.addEventListener('change', () => updateSubtotal(item));
            removeButton.addEventListener('click', (event) => {
                event.preventDefault();
                item.remove();
                updateTotal();
            });
        });
    
        purchaseBtn.addEventListener('click', () => {
            alert('Purchase complete! Thank you for your order.');
            document.querySelectorAll('.cart-item').forEach(item => item.remove());
            updateTotal();
        });
    
        updateTotal();
    });