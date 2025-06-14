	let productPrice = 0;

        function goBack() {
            window.history.back();
        }

        function loadProductDetails(name, imageSrc, description, price) {
            document.getElementById('product-name').textContent = name;
            document.getElementById('product-image').src = imageSrc;
            document.getElementById('product-description').textContent = description;
            document.getElementById('product-price').textContent = `Price: RM ${price}`;
            document.getElementById('total-price').textContent = `Total Price: RM ${price}`;
            productPrice = parseFloat(price);
        }

        function updateTotalPrice() {
            const quantity = document.getElementById('quantity').value;
            const totalPrice = (productPrice * quantity).toFixed(2);
            document.getElementById('total-price').textContent = `Total Price: RM ${totalPrice}`;
        }

        const urlParams = new URLSearchParams(window.location.hash.slice(1));
        const encodedDetails = urlParams.get('product');

        if (encodedDetails) {
            const productDetails = JSON.parse(decodeURIComponent(encodedDetails));
            loadProductDetails(productDetails.name, productDetails.imageSrc, productDetails.description, productDetails.price);
        }
		function addToCart() {
            alert('Added to cart!');
        }