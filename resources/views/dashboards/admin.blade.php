<!-- {{-- 
    View: Admin Dashboard Mockup
    Description: Static mockup of admin dashboard. Not currently used in main flow.
--}} -->
@extends('layouts.app')

@section('title', 'Admin Dashboard | BookVerse')

@section('content')
<div class="container my-5">
    <h1 class="text-center fw-bold mb-4 text-gradient">Admin Dashboard</h1>
    <p class="text-center text-secondary mb-5">Manage books, reviews, and user borrow requests.</p>

    {{-- Add New Book --}}
    <section class="mb-5">
        <div class="card bg-dark text-light shadow-lg border-0">
            <div class="card-header bg-gradient text-light">
                <h4 class="mb-0"><i class="bi bi-plus-circle"></i> Add New Book</h4>
            </div>
            <div class="card-body">
                <form>
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label">Book Title</label>
                            <input type="text" class="form-control bg-secondary text-light border-0" placeholder="Enter book title">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Author</label>
                            <input type="text" class="form-control bg-secondary text-light border-0" placeholder="Enter author name">
                        </div>
                        <div class="col-md-12">
                            <label class="form-label">Cover Image URL</label>
                            <input type="text" class="form-control bg-secondary text-light border-0" placeholder="e.g., images/sample-book.jpg">
                        </div>
                        <div class="col-md-12">
                            <label class="form-label">Description</label>
                            <textarea rows="3" class="form-control bg-secondary text-light border-0" placeholder="Book description..."></textarea>
                        </div>
                    </div>
                    <div class="mt-4 text-end">
                        <button type="submit" class="btn btn-glow"><i class="bi bi-cloud-upload"></i> Add Book</button>
                    </div>
                </form>
            </div>
        </div>
    </section>

    {{-- Manage Books --}}
    <section class="mb-5">
        <h4 class="fw-semibold mb-3"><i class="bi bi-journal-text text-info"></i> Manage Books</h4>
        <div class="table-responsive">
            <table class="table table-dark table-striped align-middle text-center">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Book Title</th>
                        <th>Author</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ([
                        ['id' => 1, 'title' => 'The Great Adventure', 'author' => 'John Doe', 'status' => 'Available'],
                        ['id' => 2, 'title' => 'Mystery of the Night', 'author' => 'Jane Smith', 'status' => 'Borrowed'],
                    ] as $book)
                    <tr>
                        <td>{{ $book['id'] }}</td>
                        <td>{{ $book['title'] }}</td>
                        <td>{{ $book['author'] }}</td>
                        <td><span class="badge bg-{{ $book['status'] === 'Available' ? 'success' : 'danger' }}">{{ $book['status'] }}</span></td>
                        <td>
                            <button class="btn btn-sm btn-outline-warning"><i class="bi bi-pencil-square"></i></button>
                            <button class="btn btn-sm btn-outline-danger"><i class="bi bi-trash"></i></button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </section>

    {{-- Borrow Requests --}}
    <section>
        <h4 class="fw-semibold mb-3"><i class="bi bi-hourglass-split text-primary"></i> Borrow Requests</h4>
        <div class="table-responsive">
            <table class="table table-dark table-hover align-middle text-center">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>User</th>
                        <th>Book</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ([
                        ['id' => 1, 'user' => 'Ali Khan', 'book' => 'Echoes of Eternity', 'status' => 'Pending'],
                        ['id' => 2, 'user' => 'Sara Malik', 'book' => 'Dream Beyond Stars', 'status' => 'Approved'],
                    ] as $request)
                    <tr>
                        <td>{{ $request['id'] }}</td>
                        <td>{{ $request['user'] }}</td>
                        <td>{{ $request['book'] }}</td>
                        <td><span class="badge bg-{{ $request['status'] === 'Approved' ? 'success' : 'warning' }}">{{ $request['status'] }}</span></td>
                        <td>
                            @if($request['status'] === 'Pending')
                                <button class="btn btn-sm btn-success"><i class="bi bi-check-lg"></i> Approve</button>
                                <button class="btn btn-sm btn-danger"><i class="bi bi-x-lg"></i> Reject</button>
                            @else
                                <button class="btn btn-sm btn-outline-secondary" disabled><i class="bi bi-check2-circle"></i> Processed</button>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </section>
</div>

<style>
    .bg-gradient {
        background: linear-gradient(90deg, #3a0ca3, #7209b7);
    }
    .text-gradient {
        background: linear-gradient(90deg, #f5d020, #f53844);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
    }
</style>
@endsection