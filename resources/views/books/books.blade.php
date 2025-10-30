@extends('layouts.app')

@section('content')
@php
  $books = [
    1 => ['title'=>'The Silent Library','author'=>'John Cross','image'=>'book1.jpg'],
    2 => ['title'=>'Echoes of Eternity','author'=>'Sophie Lane','image'=>'book2.jpg'],
    3 => ['title'=>'Digital Shadows','author'=>'Mark Doyle','image'=>'book3.jpg'],
    4 => ['title'=>'The Midnight Archive','author'=>'Liam Parker','image'=>'book4.jpg'],
    5 => ['title'=>'Forgotten Pages','author'=>'David Herrera','image'=>'book5.jpg'],
    6 => ['title'=>'Chronicles of Dawn','author'=>'Noah Smith','image'=>'book6.jpg'],
    7 => ['title'=>'Finder Seeker','author'=>'Ella West','image'=>'book7.jpg'],
    8 => ['title'=>'The Last Rainforest','author'=>'Eliot Schrefer','image'=>'book8.jpg'],
    9 => ['title'=>'Dreamscape','author'=>'Isabella Moore','image'=>'book9.jpg'],
    10 => ['title'=>'Code of Silence','author'=>'Mason Hunt','image'=>'book10.jpg']
  ];
@endphp

<div class="container py-4">
  <div class="d-flex justify-content-between align-items-center mb-3">
    <h2 class="fw-bold text-primary">Available Books</h2>
    <div class="d-flex gap-2">
      <button id="borrowSelected" class="btn btn-warning">
        <i class="bi bi-bag-plus"></i> Borrow Selected
      </button>
      <button id="addToCart" class="btn btn-outline-primary">
        <i class="bi bi-cart-plus"></i> Add to Cart
      </button>
      <button class="btn btn-outline-success">
        <i class="bi bi-bookmark-plus"></i> Add to List
      </button>
    </div>
  </div>

  <div class="row">
    @foreach ($books as $id => $book)
      <div class="col-md-3 mb-4">
        <div class="card h-100 shadow-sm border-0 position-relative book-card">
          <!-- Checkbox for selection -->
          <input type="checkbox" class="book-checkbox form-check-input position-absolute top-0 end-0 m-2" value="{{ $id }}" style="transform: scale(1.3); z-index: 10;">

          <!-- Clickable image -->
          <a href="{{ route('books.detail', $id) }}">
            <img src="{{ asset('images/books/'.$book['image']) }}" class="card-img-top" alt="{{ $book['title'] }}">
          </a>

          <div class="card-body text-center">
            <h5 class="fw-bold">{{ $book['title'] }}</h5>
            <p class="text-muted small">by {{ $book['author'] }}</p>
            <div class="d-flex justify-content-center gap-2 mt-3">
              <a href="{{ route('books.detail', $id) }}" class="btn btn-sm btn-outline-info">
                <i class="bi bi-eye"></i> View Details
              </a>
            </div>
          </div>
        </div>
      </div>
    @endforeach
  </div>
</div>

<script>
  // --- Load saved cart from localStorage ---
  const savedCart = JSON.parse(localStorage.getItem('cartBooks') || '[]');

  // Pre-check any saved books
  document.querySelectorAll('.book-checkbox').forEach(cb => {
    if (savedCart.includes(parseInt(cb.value))) cb.checked = true;
  });

  // --- Add to Cart button ---
  document.getElementById('addToCart').addEventListener('click', function() {
    const selectedBooks = Array.from(document.querySelectorAll('.book-checkbox:checked')).map(cb => parseInt(cb.value));
    if (selectedBooks.length === 0) {
      alert('Please select at least one book to add to cart.');
      return;
    }

    localStorage.setItem('cartBooks', JSON.stringify(selectedBooks));
    window.location.href = "{{ route('cart') }}";
  });

  // --- Borrow Selected button ---
  document.getElementById('borrowSelected').addEventListener('click', function() {
    const selectedBooks = Array.from(document.querySelectorAll('.book-checkbox:checked')).map(cb => parseInt(cb.value));
    if (selectedBooks.length === 0) {
      alert('Please select at least one book to borrow.');
      return;
    }
    localStorage.setItem('cartBooks', JSON.stringify(selectedBooks));
    window.location.href = "{{ route('checkout') }}";
  });
</script>

<style>
.book-card {
  transition: transform 0.2s ease, box-shadow 0.2s ease;
}
.book-card:hover {
  transform: translateY(-4px);
  box-shadow: 0 6px 16px rgba(0, 0, 0, 0.1);
}
.card-img-top {
  cursor: pointer;
  height: 280px;
  object-fit: cover;
}
</style>
@endsection