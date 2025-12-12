document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.getElementById('search-input');
    const searchResults = document.getElementById('search-results');

    if (searchInput) {
        searchInput.addEventListener('keyup', function() {
            const query = this.value;

            if (query.length < 1) {
                searchResults.innerHTML = '';
                searchResults.style.display = 'none';
                return;
            }

            fetch(`/search?query=${encodeURIComponent(query)}`)
                .then(response => response.json())
                .then(data => {
                    searchResults.innerHTML = '';
                    
                    if (data.status === 'success' && data.results.length > 0) {
                        searchResults.style.display = 'block';
                        
                        data.results.forEach(item => {
                            const resultItem = document.createElement('a');
                            resultItem.href = item.url;
                            resultItem.classList.add('dropdown-item', 'd-flex', 'align-items-center', 'p-2', 'border-bottom');
                            
                            // Image
                            if (item.image) {
                                const img = document.createElement('img');
                                img.src = item.image;
                                img.alt = item.name;
                                img.style.width = '40px';
                                img.style.height = '50px';
                                img.style.objectFit = 'cover';
                                img.classList.add('me-3', 'rounded');
                                resultItem.appendChild(img);
                            } else {
                                const placeholder = document.createElement('div');
                                placeholder.classList.add('bg-secondary', 'me-3', 'rounded', 'd-flex', 'align-items-center', 'justify-content-center');
                                placeholder.style.width = '40px';
                                placeholder.style.height = '50px';
                                placeholder.innerHTML = '<span class="text-white small">N/A</span>';
                                resultItem.appendChild(placeholder);
                            }

                            // Text Content
                            const textDiv = document.createElement('div');
                            const title = document.createElement('div');
                            title.classList.add('fw-bold', 'text-dark');
                            title.textContent = item.name;
                            
                            const category = document.createElement('div');
                            category.classList.add('small', 'text-muted');
                            category.textContent = item.category;

                            textDiv.appendChild(title);
                            textDiv.appendChild(category);
                            resultItem.appendChild(textDiv);

                            searchResults.appendChild(resultItem);
                        });
                    } else {
                        searchResults.innerHTML = '<div class="p-3 text-muted text-center">No results found</div>';
                        searchResults.style.display = 'block';
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    searchResults.style.display = 'none';
                });
        });

        // Hide results when clicking outside
        document.addEventListener('click', function(e) {
            if (!searchInput.contains(e.target) && !searchResults.contains(e.target)) {
                searchResults.style.display = 'none';
            }
        });
    }
});
