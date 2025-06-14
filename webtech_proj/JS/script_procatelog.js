	function showProduct(name, imageSrc, description, price) {
		const productDetails = {
			name: name,
			imageSrc: imageSrc,
			description: description,
			price: price
		};

		const encodedDetails = encodeURIComponent(JSON.stringify(productDetails));
            
		window.location.href = `mendesc.html#product=${encodedDetails}`;
	}