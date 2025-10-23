@extends('layouts.app')

@section('content')
<div class="container py-5">
  <h1 class="text-center mb-5 fw-bold text-primary">Explore Our Book Collection</h1>

  <!-- Bulk Action Buttons -->
  <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-2">
    <div class="d-flex gap-2">
      <button id="bulkBorrow" class="btn btn-success">
        <i class="bi bi-book"></i> Borrow Selected
      </button>
      <button id="bulkAddList" class="btn btn-warning">
        <i class="bi bi-bookmark-heart"></i> Add Selected to List
      </button>
    </div>
    <div>
      <a href="{{ route('home') }}" class="btn btn-outline-secondary">← Back to Home</a>
    </div>
  </div>

  <!-- Book Grid -->
  <div class="row g-4">
    @php
      $books = [
        ['id'=>1,'title'=>'The Silent Library','author'=>'John Cross','image'=>'book1.jpg'],
        ['id'=>2,'title'=>'Echoes of Eternity','author'=>'Sophie Lane','image'=>'book2.jpg'],
        ['id'=>3,'title'=>'Digital Shadows','author'=>'Mark Doyle','image'=>'book3.jpg'],
        ['id'=>4,'title'=>'The Midnight Archive','author'=>'Liam Parker','image'=>'book4.jpg'],
        ['id'=>5,'title'=>'Forgotten Pages','author'=>'David Herrera','image'=>'book5.jpg'],
        ['id'=>6,'title'=>'Chronicles of Dawn','author'=>'Noah Smith','image'=>'book6.jpg'],
        ['id'=>7,'title'=>'Finder Seeker','author'=>'Ella West','image'=>'book7.jpg'],
        ['id'=>8,'title'=>'The Last Rainforest','author'=>'Eliot Schrefer','image'=>'book8.jpg'],
        ['id'=>9,'title'=>'Dreamscape','author'=>'Isabella Moore','image'=>'book9.jpg'],
        ['id'=>10,'title'=>'Code of Silence','author'=>'Mason Hunt','image'=>'book10.jpg'],
      ];
    @endphp

    @foreach($books as $book)
    <div class="col-md-4 col-lg-3">
      <div class="card h-100 shadow-sm border-0 hover-shadow position-relative">
        <input type="checkbox" class="form-check-input position-absolute top-0 start-0 m-2 book-checkbox"
          data-id="{{ $book['id'] }}">

        <img src="{{ asset('images/books/'.$book['image']) }}" class="card-img-top" alt="{{ $book['title'] }}">
        <div class="card-body text-center">
          <h5 class="card-title fw-semibold">{{ $book['title'] }}</h5>
          <p class="text-muted small mb-1">by {{ $book['author'] }}</p>
          <a href="{{ route('books.detail', $book['id']) }}" class="btn btn-outline-primary btn-sm mt-2">
            View Details
          </a>
        </div>
      </div>
    </div>
    @endforeach
  </div>
</div>

<!-- ======= Scripts ======= -->
<script>
  // Track selected books
  const selectedBooks = new Set();

  document.querySelectorAll('.book-checkbox').forEach(cb => {
    cb.addEventListener('change', () => {
      const id = cb.dataset.id;
      if (cb.checked) selectedBooks.add(id);
      else selectedBooks.delete(id);
    });
  });

  // Bulk Borrow
  document.getElementById('bulkBorrow').addEventListener('click', () => {
    if (selectedBooks.size === 0) return alert("Please select at least one book to borrow.");
    alert("Borrow request sent for books: " + Array.from(selectedBooks).join(', '));
  });

  // Bulk Add to List
  document.getElementById('bulkAddList').addEventListener('click', () => {
    if (selectedBooks.size === 0) return alert("Please select at least one book to add to list.");
    alert("Books added to your list: " + Array.from(selectedBooks).join(', '));
  });
</script>

<style>
  .hover-shadow:hover {
    transform: translateY(-4px);
    transition: all 0.3s ease;
  }
  .book-checkbox {
    width: 1.2rem;
    height: 1.2rem;
  }
</style>
@endsection