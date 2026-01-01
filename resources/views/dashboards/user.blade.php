<!-- {{-- 
    View: User Dashboard Mockup
    Description: Static mockup of user dashboard. Not currently used in main flow.
--}} -->
@extends('layouts.app')

@section('title', 'User Dashboard | BookVerse')

@section('content')
<div class="container my-5">
    <h1 class="text-center fw-bold mb-4">Welcome, <span class="text-warning">Reader</span> 👋</h1>
    <p class="text-center text-secondary mb-5">Manage your borrowed books, saved lists, and requests.</p>

    {{-- Borrowed Books --}}
    <section class="mb-5">
        <h3 class="fw-semibold mb-3"><i class="bi bi-bookmark-check-fill text-warning"></i> Borrowed Books</h3>
        <div class="row g-4">
            @foreach ([
                ['title' => 'The Great Adventure', 'author' => 'John Doe', 'due' => '2025-11-05'],
                ['title' => 'Mystery of the Night', 'author' => 'Jane Smith', 'due' => '2025-11-10'],
            ] as $book)
            <div class="col-md-6 col-lg-4">
                <div class="card bg-dark text-light border-0 shadow h-100">
                    <div class="card-body">
                        <h5 class="card-title">{{ $book['title'] }}</h5>
                        <p class="card-text text-muted mb-2">by {{ $book['author'] }}</p>
                        <p class="text-info mb-1">Due: <strong>{{ $book['due'] }}</strong></p>
                        <button class="btn btn-sm btn-outline-light mt-2">Return Book</button>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </section>

    {{-- My List --}}
    <section class="mb-5">
        <h3 class="fw-semibold mb-3"><i class="bi bi-heart-fill text-danger"></i> My Reading List</h3>
        <div class="row g-4">
            @foreach ([
                ['title' => 'Dream Beyond Stars', 'author' => 'Luna Grey'],
                ['title' => 'Lost in Time', 'author' => 'Albert Ross'],
            ] as $book)
            <div class="col-md-6 col-lg-4">
                <div class="card bg-dark text-light border-0 shadow h-100">
                    <div class="card-body">
                        <h5 class="card-title">{{ $book['title'] }}</h5>
                        <p class="card-text text-muted">by {{ $book['author'] }}</p>
                        <button class="btn btn-sm btn-outline-warning">Remove</button>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </section>

    {{-- Pending Borrow Requests --}}
    <section>
        <h3 class="fw-semibold mb-3"><i class="bi bi-hourglass-split text-primary"></i> Pending Requests</h3>
        <div class="row g-4">
            @foreach ([
                ['title' => 'Echoes of Eternity', 'author' => 'M. J. Hart', 'status' => 'Awaiting Admin Approval'],
            ] as $book)
            <div class="col-md-6 col-lg-4">
                <div class="card bg-dark text-light border-0 shadow h-100 border-primary">
                    <div class="card-body">
                        <h5 class="card-title">{{ $book['title'] }}</h5>
                        <p class="card-text text-muted mb-2">by {{ $book['author'] }}</p>
                        <p class="text-primary small"><i class="bi bi-clock-history"></i> {{ $book['status'] }}</p>
                        <button class="btn btn-sm btn-outline-secondary" disabled>Borrow Pending</button>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </section>
</div>
@endsection