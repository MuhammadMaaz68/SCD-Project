@extends('layouts.app')

@section('content')
@php
  $books = [
    1 => ['title'=>'The Silent Library','author'=>'John Cross','image'=>'book1.jpg','desc'=>'A mysterious tale of forbidden knowledge and ancient secrets hidden beneath the city’s oldest library.'],
    2 => ['title'=>'Echoes of Eternity','author'=>'Sophie Lane','image'=>'book2.jpg','desc'=>'An emotional journey that blurs the boundaries between time and love.'],
    3 => ['title'=>'Digital Shadows','author'=>'Mark Doyle','image'=>'book3.jpg','desc'=>'A thrilling dive into a future where AI governs every decision.'],
    4 => ['title'=>'The Midnight Archive','author'=>'Liam Parker','image'=>'book4.jpg','desc'=>'A chilling story about voices in the dark woods.'],
    5 => ['title'=>'Forgotten Pages','author'=>'David Herrera','image'=>'book5.jpg','desc'=>'Two souls connected across different realities.'],
    6 => ['title'=>'Chronicles of Dawn','author'=>'Noah Smith','image'=>'book6.jpg','desc'=>'A philosophical tale that questions destiny.'],
    7 => ['title'=>'Finder Seeker','author'=>'Ella West','image'=>'book7.jpg','desc'=>'An adventure through cryptic ruins and lost civilizations.'],
    8 => ['title'=>'The Last Rainforest','author'=>'Eliot Schrefer','image'=>'book8.jpg','desc'=>'A story of peace, resilience, and new beginnings.'],
    9 => ['title'=>'Dreamscape','author'=>'Isabella Moore','image'=>'book9.jpg','desc'=>'A fantasy saga of rebellion in a world powered by light.'],
    10 => ['title'=>'Code of Silence','author'=>'Mason Hunt','image'=>'book10.jpg','desc'=>'A cosmic journey to find humanity’s second home.']
  ];

  $id = request()->route('id');
  $book = $books[$id] ?? null;
@endphp

@if($book)
<div class="container py-5">
  <div class="row">
    <div class="col-md-5">
      <img src="{{ asset('images/books/'.$book['image']) }}" class="img-fluid rounded shadow-sm" alt="{{ $book['title'] }}">
    </div>
    <div class="col-md-7">
      <h2 class="fw-bold text-primary">{{ $book['title'] }}</h2>
      <p class="text-muted mb-3">by {{ $book['author'] }}</p>
      <p class="lead">{{ $book['desc'] }}</p>

      <!-- Action Buttons -->
      <div class="d-flex gap-2 mt-4">
        <button class="btn btn-outline-success"><i class="bi bi-bookmark-plus"></i> Add to List</button>

        <!-- Borrow Button links to checkout -->
        <a href="{{ route('checkout') }}?books={{ $id }}" class="btn btn-outline-warning">
          <i class="bi bi-bag-plus"></i> Borrow
        </a>

        <button class="btn btn-outline-info" data-bs-toggle="modal" data-bs-target="#reviewModal">
          <i class="bi bi-chat-dots"></i> Add Review
        </button>
      </div>
    </div>
  </div>
</div>

<!-- Review Modal -->
<div class="modal fade" id="reviewModal" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header bg-dark text-white">
        <h5 class="modal-title">Add Your Review</h5>
        <button class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <textarea class="form-control" rows="4" placeholder="Write your review here..."></textarea>
      </div>
      <div class="modal-footer">
        <button class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
        <button class="btn btn-primary">Submit Review</button>
      </div>
    </div>
  </div>
</div>

<!-- Gradient Button Styling -->
<style>
.btn-gradient {
  background: linear-gradient(90deg, #1e3a8a 0%, #2563eb 50%, #4f46e5 100%);
  border: none;
  transition: 0.3s;
}
.btn-gradient:hover {
  opacity: 0.9;
  transform: translateY(-2px);
}
</style>
@else
<div class="text-center py-5">
  <h3 class="text-danger">Book not found.</h3>
</div>
@endif
@endsection