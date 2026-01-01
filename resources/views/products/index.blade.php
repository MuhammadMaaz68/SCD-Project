@extends('layouts.app')

@section('title', 'Shop Products')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="text-white">Our Products</h1>
    <div class="position-relative w-25">
        <input type="text" id="search-input" class="form-control" placeholder="Search products...">
        <div id="search-results" class="position-absolute w-100 bg-white text-dark rounded shadow mt-1 p-2 d-none" style="z-index: 1000;"></div>
    </div>
</div>

<div class="row" id="product-grid">
    {{-- Products will be loaded here via Blade initially, but we are using API for this usually. 
         For hybrid approach, we use Blade for initial load. --}}
</div>

<script>
    // Simple fetch to load products initially to test API
    document.addEventListener('DOMContentLoaded', function() {
        fetch('/api/products')
            .then(response => response.json())
            .then(data => {
                const grid = document.getElementById('product-grid');
                data.products.forEach(product => {
                    grid.innerHTML += `
                        <div class="col-md-3 mb-4">
                            <div class="card h-100 bg-dark text-white border-secondary">
                                <img src="${product.image ? '/storage/'+product.image : 'https://placehold.co/300x400'}" class="card-img-top" alt="${product.name}" style="height: 250px; object-fit: cover;">
                                <div class="card-body d-flex flex-column">
                                    <h5 class="card-title">${product.name}</h5>
                                    <p class="card-text text-muted">${product.category ? product.category.name : 'Uncategorized'}</p>
                                    <h6 class="text-warning">$${product.price}</h6>
                                    <button class="btn btn-glow mt-auto" onclick="addToCart(${product.id})">Add to Cart</button>
                                </div>
                            </div>
                        </div>
                    `;
                });
            });

        // Search Logic
        const searchInput = document.getElementById('search-input');
        const resultsBox = document.getElementById('search-results');

        searchInput.addEventListener('input', function() {
            const query = this.value;
            if(query.length > 2) {
                fetch(\`/api/search?query=\${query}\`)
                .then(res => res.json())
                .then(data => {
                    resultsBox.innerHTML = '';
                    if(data.results.length > 0) {
                        resultsBox.classList.remove('d-none');
                        data.results.forEach(item => {
                            resultsBox.innerHTML += \`<a href="#" class="d-block text-decoration-none text-dark p-1 border-bottom">\${item.name} ($ \${item.price})</a>\`;
                        });
                    } else {
                        resultsBox.innerHTML = '<span class="p-1">No results found</span>';
                        resultsBox.classList.remove('d-none');
                    }
                });
            } else {
                resultsBox.classList.add('d-none');
            }
        });
    });

    function addToCart(productId) {
        // Simple mock add to cart since backend cart for products isn't fully separated from books yet
        alert('Product ' + productId + ' added to cart! (Implement full Cart logic)');
    }
</script>
@endsection
