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

<div class="container py-5">
  <h2 class="fw-bold text-primary mb-4">Your Cart</h2>
  <div class="row" id="cartContainer"></div>

  <div class="text-center mt-4">
    <a href="{{ route('checkout') }}" class="btn btn-warning">
      <i class="bi bi-bag-check"></i> Proceed to Borrow Checkout
    </a>
  </div>
</div>

<script>
  const allBooks = @json($books);
  const cartIds = JSON.parse(localStorage.getItem('cartBooks') || '[]');
  const container = document.getElementById('cartContainer');

  if (cartIds.length === 0) {
    container.innerHTML = '<div class="text-center py-5"><h5>No books in cart.</h5></div>';
  } else {
    cartIds.forEach(id => {
      const book = allBooks[id];
      if (book) {
        container.innerHTML += `
          <div class="col-md-3 mb-4">
            <div class="card h-100 shadow-sm">
              <img src="/images/books/${book.image}" class="card-img-top" alt="${book.title}">
              <div class="card-body text-center">
                <h5 class="fw-bold">${book.title}</h5>
                <p class="text-muted small">by ${book.author}</p>
              </div>
            </div>
          </div>
        `;
      }
    });
  }
</script>
@endsection