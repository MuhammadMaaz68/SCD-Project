document.addEventListener('DOMContentLoaded', function () {
    const searchInput = document.getElementById('search-input');
    const resultsBox = document.getElementById('search-results');

    if (searchInput && resultsBox) {
        searchInput.addEventListener('keyup', function () {
            const query = this.value;

            if (query.length > 2) {
                fetch(`/api/search?query=${encodeURIComponent(query)}`)
                    .then(response => response.json())
                    .then(data => {
                        resultsBox.innerHTML = '';
                        if (data.results.length > 0) {
                            resultsBox.style.display = 'block';
                            data.results.forEach(item => {
                                const link = document.createElement('a');
                                link.href = `/products/${item.id}`; // Assuming we have product detail page or use modal
                                // Since we don't have a dedicated public product detail page mapped in web routes yet apart from Shop,
                                // let's stick to showing it or just linking to shop.
                                // Actually, I haven't made a specific route for /products/{id} WEB view.
                                // I'll link to # for now or implement a quick view in Shop.
                                // Let's link to the 'books.detail' if it was a book, but here it is a Product.
                                link.href = '#';
                                link.classList.add('dropdown-item', 'p-2', 'border-bottom');
                                link.innerHTML = `
                                    <div class="d-flex align-items-center">
                                        <img src="${item.image ? '/storage/' + item.image : 'https://placehold.co/40'}" style="width: 40px; height: 40px; object-fit: cover;" class="me-2 rounded">
                                        <div>
                                            <div class="fw-bold">${item.name}</div>
                                            <small class="text-muted">$${item.price}</small>
                                        </div>
                                    </div>
                                `;
                                resultsBox.appendChild(link);
                            });
                        } else {
                            resultsBox.style.display = 'block';
                            resultsBox.innerHTML = '<span class="dropdown-item text-muted">No results found</span>';
                        }
                    })
                    .catch(error => {
                        console.error('Error fetching search results:', error);
                    });
            } else {
                resultsBox.style.display = 'none';
            }
        });

        // Close dropdown when clicking outside
        document.addEventListener('click', function (e) {
            if (!searchInput.contains(e.target) && !resultsBox.contains(e.target)) {
                resultsBox.style.display = 'none';
            }
        });
    }
});
