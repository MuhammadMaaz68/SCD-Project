air-for-share
How it works Download Upgrade Feedback Login / Register
Text
@extends('layouts.app')

@section('content')
<style>
  body {
    background: linear-gradient(135deg, #1e3a8a 0%, #0f172a 100%);
    color: #fff;
  }

  .checkout-card {
    backdrop-filter: blur(15px);
    background: rgba(255, 255, 255, 0.08);
    border: 1px solid rgba(255, 255, 255, 0.15);
    border-radius: 1.5rem;
    padding: 2rem;
    color: #fff;
    box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
    transition: all 0.3s ease;
  }

  .checkout-card:hover {
    transform: translateY(-3px);
  }

  .book-card {
    background: rgba(255, 255, 255, 0.1);
    border: none;
    border-radius: 1rem;
    overflow: hidden;
    color: #fff;
  }

  .book-card img {
    height: 220px;
    object-fit: cover;
  }

  .form-control, .form-select {
    background: rgba(255, 255, 255, 0.1);
    border: none;
    color: #fff;
  }

  .form-control::placeholder {
    color: rgba(255,255,255,0.6);
  }

  .form-select option {
    color: #000;
  }

  .btn-success {
    background: #22c55e;
    border: none;
  }

  .btn-outline-secondary {
    border-color: rgba(255, 255, 255, 0.5);
    color: #fff;
  }

  .btn-outline-secondary:hover {
    background: rgba(255, 255, 255, 0.2);
  }

  .page-title {
    font-size: 2.5rem;
    font-weight: 700;
    text-shadow: 0 3px 6px rgba(0,0,0,0.4);
  }
</style>

<div class="container py-5">
  <h1 class="text-center mb-5 page-title">Borrow Checkout</h1>

  @php
    $bookIds = explode(',', request()->get('books', ''));
    $allBooks = [
      1 => ['title'=>'The Silent Library','author'=>'John Cross','image'=>'book1.jpg'],
      2 => ['title'=>'Echoes of Eternity','author'=>'Sophie Lane','image'=>'book2.jpg'],
      3 => ['title'=>'Digital Shadows','author'=>'Mark Doyle','image'=>'book3.jpg'],
      4 => ['title'=>'The Midnight Archive','author'=>'Liam Parker','image'=>'book4.jpg'],
      5 => ['title'=>'Forgotten Pages','author'=>'David Herrera','image'=>'book5.jpg'],
      6 => ['title'=>'Chronicles of Dawn','author'=>'Noah Smith','image'=>'book6.jpg'],
      7 => ['title'=>'Finder Seeker','author'=>'Ella West','image'=>'book7.jpg'],
      8 => ['title'=>'The Last Rainforest','author'=>'Eliot Schrefer','image'=>'book8.jpg'],
      9 => ['title'=>'Dreamscape','author'=>'Isabella Moore','image'=>'book9.jpg'],
      10 => ['title'=>'Code of Silence','author'=>'Mason Hunt','image'=>'book10.jpg'],
    ];
  @endphp

  @if(empty($bookIds[0]))
    <div class="alert alert-warning text-center">
      No books selected for borrowing.
    </div>
    <div class="text-center mt-3">
      <a href="{{ route('books') }}" class="btn btn-outline-light">Back to Books</a>
    </div>
  @else
  <div class="row g-4 mb-5">
    @foreach($bookIds as $id)
      @if(isset($allBooks[$id]))
      <div class="col-md-4 col-lg-3">
        <div class="card book-card shadow-sm">
          <img src="{{ asset('images/books/'.$allBooks[$id]['image']) }}" class="card-img-top" alt="{{ $allBooks[$id]['title'] }}">
          <div class="card-body text-center">
            <h6 class="fw-semibold mb-0">{{ $allBooks[$id]['title'] }}</h6>
            <small class="text-light-50">by {{ $allBooks[$id]['author'] }}</small>
          </div>
        </div>
      </div>
      @endif
    @endforeach
  </div>

  <!-- Borrower Form -->
  <div class="checkout-card mx-auto" style="max-width: 700px;">
    <h4 class="fw-bold mb-3">Borrower Information</h4>
    <form id="borrowForm">
      <div class="row mb-3">
        <div class="col-md-6">
          <label class="form-label">Full Name</label>
          <input type="text" class="form-control" placeholder="Enter your name" required>
        </div>
        <div class="col-md-6">
          <label class="form-label">Email Address</label>
          <input type="email" class="form-control" placeholder="Enter your email" required>
        </div>
      </div>
      <div class="mb-3">
        <label class="form-label">Borrow Duration</label>
        <select class="form-select" required>
          <option value="">Select duration</option>
          <option>7 days</option>
          <option>14 days</option>
          <option>30 days</option>
        </select>
      </div>
      <div class="text-center mt-4">
        <button type="submit" class="btn btn-success px-4 py-2">
          <i class="bi bi-check-circle"></i> Confirm Borrow Request
        </button>
        <a href="{{ route('books') }}" class="btn btn-outline-secondary ms-2">Cancel</a>
      </div>
    </form>
  </div>
  @endif
</div>

<script>
document.getElementById('borrowForm')?.addEventListener('submit', e => {
  e.preventDefault();
  alert('✅ Your borrow request has been submitted for admin approval!');
  window.location.href = "{{ route('books') }}";
});
</script>
@endsection