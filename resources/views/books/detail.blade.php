@extends('layouts.app')

@section('content')
@php
  // Dummy reviews for display (kept static for now as requested)
  $reviews = [
    ['name' => 'Sarah M.', 'rating' => 5, 'comment' => 'Absolutely loved this story. Couldn’t put it down!'],
    ['name' => 'James R.', 'rating' => 4, 'comment' => 'Very well written, though the ending was a bit rushed.'],
    ['name' => 'Hina P.', 'rating' => 5, 'comment' => 'Atmospheric and thrilling — a must-read.']
  ];
@endphp

@if($book)
<div class="container py-5">
  <div class="row">
    <div class="col-md-5">
      @if($book->cover_image)
        <img src="{{ Storage::url($book->cover_image) }}" class="img-fluid rounded shadow-sm" alt="{{ $book->title }}">
      @else
        <div class="d-flex align-items-center justify-content-center bg-secondary text-white rounded shadow-sm" style="height: 400px;">
           <span>No Image</span>
        </div>
      @endif
    </div>
    <div class="col-md-7">
      <h2 class="fw-bold text-primary">{{ $book->title }}</h2>
      <p class="text-muted mb-3">by {{ $book->author }}</p>
      <p class="lead">{{ $book->description }}</p>

      <!-- Action Buttons -->
      <div class="d-flex gap-2 mt-4 mb-4">
        <button class="btn btn-outline-success"><i class="bi bi-bookmark-plus"></i> Add to List</button>

        <a href="#" class="btn btn-outline-primary" onclick="addToCart({{ $book->id }})">
          <i class="bi bi-cart-plus"></i> Add to Cart
        </a>

        <a href="{{ route('checkout') }}?books={{ $book->id }}" class="btn btn-outline-warning">
          <i class="bi bi-bag-plus"></i> Borrow
        </a>
      </div>

      <!-- Review Section -->
      <div class="p-3 rounded" style="border: 2px solid #222; background-color: rgba(255,255,255,0.02);">
        <h5 class="fw-bold text-light mb-3">Reviews</h5>

        <div id="reviewsList">
          @foreach($reviews as $r)
          <div class="mb-3 p-3 rounded" style="background-color: rgba(255,255,255,0.05); border-left: 3px solid #2563eb;">
            <div class="d-flex justify-content-between">
              <strong>{{ $r['name'] }}</strong>
              <span class="text-warning">
                @for($i=0; $i < $r['rating']; $i++)
                  ★
                @endfor
              </span>
            </div>
            <p class="mb-0 text-light">{{ $r['comment'] }}</p>
          </div>
          @endforeach
        </div>

        <!-- Add Review -->
        <form id="reviewForm" class="mt-4">
          <div class="mb-2">
            <label>Your Name</label><br>
            <input type="text" id="reviewerName" class="form-control bg-dark text-light border-0" placeholder="Your name" required>
          </div>
          <div class="mb-2">
            <label>Your Rating</label><br>
            <select id="reviewRating" class="form-select bg-dark text-light border-0" required>
              <option value="">Rating</option>
              <option value="5">★★★★★</option>
              <option value="4">★★★★☆</option>
              <option value="3">★★★☆☆</option>
              <option value="2">★★☆☆☆</option>
              <option value="1">★☆☆☆☆</option>
            </select>
          </div>
          <div class="mb-3">
            <label>Your Review</label><br>
            <textarea id="reviewText" class="form-control bg-dark text-light border-0" rows="3" placeholder="Write your review..." required></textarea>
          </div>
          <button class="btn btn-primary btn-sm"><i class="bi bi-send"></i> Submit Review</button>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- Scripts -->
<script>
function addToCart(id) {
  let cart = JSON.parse(localStorage.getItem('cartBooks') || '[]');
  if (!cart.includes(id)) cart.push(id);
  localStorage.setItem('cartBooks', JSON.stringify(cart));
  alert('✅ Book added to cart!');
}

// Review Submission (frontend only)
document.getElementById('reviewForm').addEventListener('submit', function(e) {
  e.preventDefault();
  const name = document.getElementById('reviewerName').value.trim();
  const rating = document.getElementById('reviewRating').value;
  const text = document.getElementById('reviewText').value.trim();

  if (!name || !rating || !text) return alert('Please fill all fields.');

  const reviewDiv = document.createElement('div');
  reviewDiv.className = "mb-3 p-3 rounded animate__animated animate__fadeInUp";
  reviewDiv.style.backgroundColor = "rgba(255,255,255,0.05)";
  reviewDiv.style.borderLeft = "3px solid #2563eb";
  reviewDiv.innerHTML = `
    <div class="d-flex justify-content-between">
      <strong>${name}</strong>
      <span class="text-warning">${'★'.repeat(rating)}</span>
    </div>
    <p class="mb-0 text-light">${text}</p>
  `;
  document.getElementById('reviewsList').prepend(reviewDiv);

  this.reset();
  alert('⭐ Thank you! Your review has been added.');
});
</script>
@endif
@endsection
