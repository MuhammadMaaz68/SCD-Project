@extends('layouts.app')

@section('content')
<!-- ======= Hero Section ======= -->
<section class="hero-section text-center text-white d-flex align-items-center justify-content-center"
  style="background: linear-gradient(135deg, #1b1f3b, #293a80); height: 70vh;">
  <div class="container">
    <h1 class="display-4 fw-bold mb-3">Welcome to <span class="text-warning">BookVerse</span></h1>
    <p class="lead mb-4">Discover, Borrow, and Review your favorite books — all in one place.</p>
    <a href="{{ route('books') }}" class="btn btn-warning btn-lg px-4">Explore Books</a>
  </div>
</section>

<!-- ======= Featured Books Section (3 only) ======= -->
<section class="py-5 bg-light">
  <div class="container">
    <h2 class="text-center mb-5 fw-bold text-primary">Featured Books</h2>

    <div class="row g-4 justify-content-center">
      @php
        $books = [
          ['id'=>1,'title'=>'The Silent Library','author'=>'John Cross','image'=>'book1.jpg'],
          ['id'=>2,'title'=>'Echoes of Eternity','author'=>'Sophie Lane','image'=>'book2.jpg'],
          ['id'=>3,'title'=>'Digital Shadows','author'=>'Mark Doyle','image'=>'book3.jpg'],
        ];
      @endphp

      @foreach($books as $book)
      <div class="col-md-4">
        <div class="card h-100 shadow-sm border-0 hover-shadow">
          <img src="{{ asset('images/books/'.$book['image']) }}" class="card-img-top" alt="{{ $book['title'] }}">
          <div class="card-body text-center">
            <h5 class="card-title fw-semibold">{{ $book['title'] }}</h5>
            <p class="text-muted small mb-2">by {{ $book['author'] }}</p>
            <a href="{{ route('books.detail', $book['id']) }}" class="btn btn-outline-primary btn-sm w-100">
              View Details
            </a>
          </div>
        </div>
      </div>
      @endforeach
    </div>

    <div class="text-center mt-5">
      <a href="{{ route('books') }}" class="btn btn-primary px-4">View All Books</a>
    </div>
  </div>
</section>

<!-- ======= About Section ======= -->
<section class="py-5 text-center bg-dark text-white">
  <div class="container">
    <h2 class="fw-bold text-warning mb-3">Why BookVerse?</h2>
    <p class="lead mb-4">
      BookVerse brings together readers, collectors, and enthusiasts. Explore our digital library, borrow your
      favorites, and share your thoughts through reviews.
    </p>
    <a href="{{ route('contact') }}" class="btn btn-outline-light">Contact Us</a>
  </div>
</section>
@endsection