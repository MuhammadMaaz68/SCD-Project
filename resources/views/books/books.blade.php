@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold">Explore Our Collection</h2>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="d-flex gap-2 mb-3">
        <button type="button" class="btn btn-primary" onclick="submitBulkAction('{{ route('borrows.store') }}')">
            <i class="bi bi-book"></i> Borrow Selected
        </button>
        <button type="button" class="btn btn-success" id="addToCart">
            <i class="bi bi-cart-plus"></i> Add to Cart
        </button>
        <button type="button" class="btn btn-outline-danger" onclick="submitBulkAction('{{ route('wishlist.store') }}')">
            <i class="bi bi-heart"></i> Add to Wishlist
        </button>
    </div>

    @csrf <!-- Token for JS -->
    <input type="hidden" name="_token" value="{{ csrf_token() }}">

    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-4 g-4">
        @forelse($books as $book)
        <div class="col">
            <div class="card h-100 shadow-sm border-0 transition-hover">
                <div class="position-relative">
                    @if($book->cover_image)
                        <img src="{{ Storage::url($book->cover_image) }}" class="card-img-top" alt="{{ $book->title }}" style="height: 300px; object-fit: cover;">
                    @else
                        <div class="d-flex align-items-center justify-content-center bg-secondary text-white card-img-top" style="height: 300px;">
                            <span>No Image</span>
                        </div>
                    @endif
                    <div class="position-absolute top-0 end-0 p-2">
                        <input type="checkbox" class="form-check-input book-checkbox" value="{{ $book->id }}" style="width: 1.5em; height: 1.5em;">
                    </div>
                </div>
                <div class="card-body">
                    <h5 class="card-title fw-bold text-truncate">{{ $book->title }}</h5>
                    <p class="card-text text-muted small mb-2">{{ $book->author }}</p>
                    <p class="card-text text-secondary line-clamp-2">{{ Str::limit($book->description, 80) }}</p>
                </div>
                <div class="card-footer bg-white border-0 pt-0">
                    <div class="d-flex justify-content-between align-items-center">
                        <span class="badge bg-light text-dark border">{{ $book->category->name ?? 'Uncategorized' }}</span>
                        <a href="{{ route('books.detail', $book->id) }}" class="btn btn-outline-primary btn-sm rounded-pill px-3">View Details</a>
                    </div>
                </div>
            </div>
        </div>
        @empty
        <div class="col-12 py-5 text-center">
            <p class="text-muted display-6">No books available at the moment.</p>
        </div>
        @endforelse
    </div>

    <div class="mt-5 d-flex justify-content-center">
        {{ $books->links() }}
    </div>
</div>

<script>
    // --- Cart Logic (LocalStorage) ---
    document.getElementById('addToCart').addEventListener('click', function() {
        const selectedBooks = Array.from(document.querySelectorAll('.book-checkbox:checked')).map(cb => parseInt(cb.value));
        if (selectedBooks.length === 0) {
          alert('Please select at least one book to add to cart.');
          return;
        }

        localStorage.setItem('cartBooks', JSON.stringify(selectedBooks));
        window.location.href = "{{ route('cart') }}"; // Or show checkout alert
    });

    // --- Bulk Action Logic (AJAX) ---
    function submitBulkAction(url) {
        const checkboxes = document.querySelectorAll('.book-checkbox:checked');
        if (checkboxes.length === 0) {
            alert('Please select at least one book.');
            return;
        }

        const csrfToken = document.querySelector('input[name="_token"]').value;
        const promises = [];

        checkboxes.forEach(checkbox => {
            const formData = new FormData();
            formData.append('_token', csrfToken);
            formData.append('book_id', checkbox.value);

            promises.push(
                fetch(url, {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                        'Accept': 'application/json'
                    }
                })
            );
        });

        Promise.all(promises)
            .then(responses => {
                // Determine success based on responses if needed, or simply reload
                window.location.reload(); 
            })
            .catch(error => {
                console.error('Error:', error);
                alert('An error occurred while processing bulk action.');
            });
    }
</script>

<style>
.transition-hover {
  transition: transform 0.2s ease, box-shadow 0.2s ease;
}
.transition-hover:hover {
  transform: translateY(-5px);
  box-shadow: 0 .5rem 1rem rgba(0,0,0,.15)!important;
}
</style>
@endsection