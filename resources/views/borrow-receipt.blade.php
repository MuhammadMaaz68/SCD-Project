<!-- {{-- 
    View: Borrow Receipt demonstration
    Description: Displays a receipt for borrowed books.
    Note: Usage seems to be frontend-demo specific or legacy.
--}} -->
@extends('layouts.app')

@section('content')
@php
    // Fetch borrowed book IDs from query (like ?books=1,2,3)
    $bookIds = explode(',', request()->query('books', ''));

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

    $borrowedBooks = array_filter($books, fn($b, $id) => in_array($id, $bookIds), ARRAY_FILTER_USE_BOTH);
    $borrowDate = now()->format('d M Y');
    $dueDate = now()->addDays(14)->format('d M Y');
@endphp

<div class="container py-5 text-light">
    <div class="text-center mb-5">
        <h2 class="fw-bold text-warning">📚 Borrow Receipt</h2>
        <p class="text-muted">Thank you for borrowing with BookVerse!</p>
    </div>

    @if(count($borrowedBooks))
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card bg-dark border-secondary shadow-lg p-4 rounded-4">
                    <div class="d-flex justify-content-between mb-3">
                        <div><strong>Borrow Date:</strong> {{ $borrowDate }}</div>
                        <div><strong>Due Date:</strong> {{ $dueDate }}</div>
                    </div>
                    <hr class="border-secondary">

                    <h5 class="text-info mb-3">Borrowed Books:</h5>
                    @foreach($borrowedBooks as $book)
                        <div class="d-flex align-items-center mb-3 p-2 rounded" style="background-color: rgba(255,255,255,0.05);">
                            <img src="{{ asset('images/books/'.$book['image']) }}" width="60" height="90" class="rounded me-3 shadow-sm" alt="{{ $book['title'] }}">
                            <div>
                                <h6 class="text-light mb-1">{{ $book['title'] }}</h6>
                                <p class="text-muted mb-0">by {{ $book['author'] }}</p>
                            </div>
                        </div>
                    @endforeach

                    <hr class="border-secondary">
                    <div class="text-center mt-3">
                        <a href="{{ route('home') }}" class="btn btn-outline-primary rounded-pill px-4">
                            <i class="bi bi-house"></i> Return to Home
                        </a>
                    </div>
                </div>
            </div>
        </div>
    @else
        <div class="alert alert-warning text-center">
            No borrowed books found!
        </div>
    @endif
</div>
@endsection
