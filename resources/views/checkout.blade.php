<!-- {{-- 
    View: Checkout Page
    Description: Handles the final steps of borrowing books.
    Note: Contains custom JS logic for frontend-based interaction demo or specific requirements.
--}} -->
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

  .receipt-card {
    background: rgba(255, 255, 255, 0.1);
    border-radius: 1rem;
    padding: 2rem;
    color: #fff;
  }

  .receipt-card h4 {
    font-weight: bold;
  }
</style>

<div class="container py-5">
  <h1 class="text-center mb-5 page-title">Borrow Checkout</h1>

  @php
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

  <div id="bookContainer"></div>

  <div id="noBooksSelected" class="alert alert-warning text-center d-none mt-4">
    No books selected for borrowing.
    <div class="mt-3">
      <a href="{{ route('books.list') }}" class="btn btn-outline-light">Back to Books</a>
    </div>
  </div>

  <!-- Borrower Form -->
  <div class="checkout-card mx-auto mt-5 d-none" id="borrowFormCard" style="max-width: 700px;">
    <h4 class="fw-bold mb-3">Borrower Information</h4>
    <form id="borrowForm">
      <div class="row mb-3">
        <div class="col-md-6">
          <label class="form-label">Full Name</label>
          <input type="text" id="borrowerName" class="form-control" placeholder="Enter your name" required>
        </div>
        <div class="col-md-6">
          <label class="form-label">Email Address</label>
          <input type="email" id="borrowerEmail" class="form-control" placeholder="Enter your email" required>
        </div>
      </div>
      <div class="mb-3">
        <label class="form-label">Borrow Duration</label>
        <select id="borrowDuration" class="form-select" required>
          <option value="">Select duration</option>
          <option value="7">7 days</option>
          <option value="14">14 days</option>
          <option value="30">30 days</option>
        </select>
      </div>
      <div class="text-center mt-4">
        <button type="submit" class="btn btn-success px-4 py-2">
          <i class="bi bi-check-circle"></i> Confirm Borrow Request
        </button>
        <a href="{{ route('books.list') }}" class="btn btn-outline-secondary ms-2">Cancel</a>
      </div>
    </form>
  </div>

  <!-- Borrow Receipt -->
  <div id="borrowReceipt" class="receipt-card mx-auto mt-5 d-none" style="max-width: 800px;">
    <h4 class="mb-4">📘 Borrow Receipt</h4>
    <div id="receiptDetails"></div>
    <div class="text-center mt-4">
      <a href="{{ route('books.list') }}" class="btn btn-success px-4">Back to Books</a>
    </div>
  </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', () => {
  const params = new URLSearchParams(window.location.search);
  let bookIds = params.get('books') ? params.get('books').split(',').map(Number) : [];

  if (bookIds.length === 0) {
    const cart = JSON.parse(localStorage.getItem('cartBooks') || '[]');
    bookIds = cart;
  }

  const allBooks = @json($allBooks);
  const bookContainer = document.getElementById('bookContainer');
  const formCard = document.getElementById('borrowFormCard');
  const noBooksMsg = document.getElementById('noBooksSelected');
  const receiptCard = document.getElementById('borrowReceipt');
  const receiptDetails = document.getElementById('receiptDetails');

  if (bookIds.length === 0) {
    noBooksMsg.classList.remove('d-none');
  } else {
    formCard.classList.remove('d-none');
    const row = document.createElement('div');
    row.classList.add('row', 'g-4', 'mb-5');

    bookIds.forEach(id => {
      if (allBooks[id]) {
        const b = allBooks[id];
        const col = document.createElement('div');
        col.classList.add('col-md-4', 'col-lg-3');
        col.innerHTML = `
          <div class="card book-card shadow-sm">
            <img src="{{ asset('images/books') }}/${b.image}" class="card-img-top" alt="${b.title}">
            <div class="card-body text-center">
              <h6 class="fw-semibold mb-0">${b.title}</h6>
              <small class="text-light-50">by ${b.author}</small>
            </div>
          </div>
        `;
        row.appendChild(col);
      }
    });
    bookContainer.appendChild(row);
  }

  // Handle Borrow Form Submission
  document.getElementById('borrowForm')?.addEventListener('submit', e => {
    e.preventDefault();

    const name = document.getElementById('borrowerName').value;
    const email = document.getElementById('borrowerEmail').value;
    const duration = parseInt(document.getElementById('borrowDuration').value);
    const dueDate = new Date();
    dueDate.setDate(dueDate.getDate() + duration);

    const dueDateStr = dueDate.toLocaleDateString();

    formCard.classList.add('d-none');
    bookContainer.classList.add('d-none');

    let bookListHTML = `<p><strong>Borrower:</strong> ${name}<br>
                        <strong>Email:</strong> ${email}<br>
                        <strong>Due Date:</strong> ${dueDateStr}</p>
                        <h5 class="mt-4">Borrowed Books:</h5><ul class="list-group list-group-flush">`;

    bookIds.forEach(id => {
      if (allBooks[id]) {
        bookListHTML += `<li class="list-group-item bg-transparent text-light border-light">
          ${allBooks[id].title} — <em>${allBooks[id].author}</em>
        </li>`;
      }
    });

    bookListHTML += '</ul>';

    receiptDetails.innerHTML = bookListHTML;
    receiptCard.classList.remove('d-none');
    localStorage.removeItem('cartBooks');
  });
});
</script>
@endsection
