function googleSearch() {
	var query = document.getElementById('searchInput').value;
    window.location.href = 'https://www.google.com/search?q=' + encodeURIComponent(query);
}