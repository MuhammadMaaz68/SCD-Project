@extends('layouts.app')

@section('content')


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

        <form action="{{ route('cart.add', $book->id) }}" method="POST" class="d-inline">
            @csrf
            <button type="submit" class="btn btn-outline-primary">
                <i class="bi bi-cart-plus"></i> Add to Cart
            </button>
        </form>

        <a href="{{ route('checkout') }}?books={{ $book->id }}" class="btn btn-outline-warning">
          <i class="bi bi-bag-plus"></i> Borrow
        </a>
      </div>

      <!-- Review Section -->
      <div class="p-3 rounded" style="border: 2px solid #222; background-color: rgba(255,255,255,0.02);">
        <h5 class="fw-bold text-light mb-3">Reviews</h5>
        
        @auth
        <form action="{{ route('reviews.store', $book) }}" method="POST" class="mb-4">
            @csrf
            <div class="mb-2">
                <label>Rating</label>
                <div class="rating">
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="rating" id="rating5" value="5" required>
                        <label class="form-check-label text-warning" for="rating5">★★★★★</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="rating" id="rating4" value="4">
                        <label class="form-check-label text-warning" for="rating4">★★★★</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="rating" id="rating3" value="3">
                        <label class="form-check-label text-warning" for="rating3">★★★</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="rating" id="rating2" value="2">
                        <label class="form-check-label text-warning" for="rating2">★★</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="rating" id="rating1" value="1">
                        <label class="form-check-label text-warning" for="rating1">★</label>
                    </div>
                </div>
            </div>
            <div class="mb-2">
                <label>Your Review</label>
                <textarea name="comment" class="form-control bg-dark text-light border-0" rows="3" placeholder="Write your review..." required></textarea>
            </div>
            <button type="submit" class="btn btn-primary btn-sm"><i class="bi bi-send"></i> Submit Review</button>
        </form>
        @else
            <div class="alert alert-info mb-4">
                Please <a href="#" data-bs-toggle="modal" data-bs-target="#loginModal" class="alert-link">login</a> to write a review.
            </div>
        @endauth

        <div id="reviewsList">
          @forelse($book->reviews->sortByDesc('created_at') as $review)
          <div class="mb-3 p-3 rounded" style="background-color: rgba(255,255,255,0.05); border-left: 3px solid #2563eb;">
            <div class="d-flex justify-content-between">
              <strong>{{ $review->user->name }}</strong>
              <span class="text-warning">
                @for($i=0; $i < $review->rating; $i++)
                  ★
                @endfor
              </span>
            </div>
            <small class="text-muted d-block mb-1">{{ $review->created_at->format('M d, Y') }}</small>
            <p class="mb-0 text-light">{{ $review->comment }}</p>
          </div>
          @empty
            <p class="text-muted text-center">No reviews yet. Be the first to review!</p>
          @endforelse
        </div>
      </div>
    </div>
  </div>
</div>

<script>
function addToCart(id) {
  let cart = JSON.parse(localStorage.getItem('cartBooks') || '[]');
  if (!cart.includes(id)) cart.push(id);
  localStorage.setItem('cartBooks', JSON.stringify(cart));
  alert('✅ Book added to cart!');
}
</script>
@endif
@endsection
