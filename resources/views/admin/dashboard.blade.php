@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold">Admin Dashboard</h2>
    </div>

    <!-- Stats Cards -->
    <div class="row g-4 mb-5">
        <div class="col-md-3">
            <div class="card bg-primary text-white border-0 shadow-sm">
                <div class="card-body">
                    <h5 class="card-title">Total Books</h5>
                    <p class="display-4 fw-bold">{{ $totalBooks }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card bg-success text-white border-0 shadow-sm">
                <div class="card-body">
                    <h5 class="card-title">Active Borrows</h5>
                    <p class="display-4 fw-bold">{{ $activeBorrows }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card bg-info text-white border-0 shadow-sm">
                <div class="card-body">
                    <h5 class="card-title">Registered Users</h5>
                    <p class="display-4 fw-bold">{{ $totalUsers }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card bg-warning text-dark border-0 shadow-sm">
                <div class="card-body">
                    <h5 class="card-title">Pending Requests</h5>
                    <p class="display-4 fw-bold">{{ $pendingRequests->count() }}</p>
                </div>
            </div>
        </div>
    </div>

    {{-- Add New Book Section --}}
    <div class="row mb-5">
        <div class="col-12">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-dark text-white py-3">
                    <h5 class="mb-0 fw-bold"><i class="bi bi-plus-circle me-2"></i>Add New Book</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('books.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label fw-bold">Title</label>
                                <input type="text" name="title" class="form-control" placeholder="Book Title" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-bold">Author</label>
                                <input type="text" name="author" class="form-control" placeholder="Author Name" required>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label fw-bold">Category</label>
                                <select name="category_id" class="form-select" required>
                                    <option value="">Select Category</option>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label fw-bold">Quantity</label>
                                <input type="number" name="quantity" class="form-control" placeholder="Stock" min="1" required>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label fw-bold">Published Year</label>
                                <input type="number" name="published_year" class="form-control" placeholder="YYYY" min="1900" max="2099">
                            </div>
                            <div class="col-12">
                                <label class="form-label fw-bold">Description</label>
                                <textarea name="description" class="form-control" rows="3" placeholder="Book synopsis..."></textarea>
                            </div>
                            <div class="col-12">
                                <label class="form-label fw-bold">Cover Image</label>
                                <input type="file" name="cover_image" class="form-control" accept="image/*">
                            </div>
                            <div class="col-12 text-end">
                                <button type="submit" class="btn btn-primary px-4"><i class="bi bi-check-lg me-1"></i> Add Book</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    {{-- Manage Books Section --}}
    <div class="card shadow-sm border-0 mb-5">
        <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
            <h5 class="mb-0 fw-bold"><i class="bi bi-book me-2"></i>Manage Books</h5>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table align-middle table-hover">
                    <thead class="table-light">
                        <tr>
                            <th>Cover</th>
                            <th>Title</th>
                            <th>Author</th>
                            <th>Category</th>
                            <th>Stock</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($books as $book)
                        <tr>
                            <td>
                                @if($book->cover_image)
                                    <img src="{{ asset('storage/' . $book->cover_image) }}" alt="Cover" style="height: 50px; width: 35px; object-fit: cover;" class="rounded">
                                @else
                                    <div class="bg-secondary rounded d-flex align-items-center justify-content-center text-white small" style="height: 50px; width: 35px;">No Img</div>
                                @endif
                            </td>
                            <td class="fw-semibold">{{ $book->title }}</td>
                            <td>{{ $book->author }}</td>
                            <td><span class="badge bg-info text-dark">{{ $book->category->name ?? 'Uncategorized' }}</span></td>
                            <td>
                                <span class="badge bg-{{ $book->quantity > 0 ? 'success' : 'danger' }}">
                                    {{ $book->quantity }} In Stock
                                </span>
                            </td>
                            <td>
                                <div class="d-flex gap-2">
                                    <a href="{{ route('books.edit', $book) }}" class="btn btn-sm btn-outline-warning"><i class="bi bi-pencil"></i></a>
                                    <form action="{{ route('books.destroy', $book) }}" method="POST" onsubmit="return confirm('Delete this book?');">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-sm btn-outline-danger"><i class="bi bi-trash"></i></button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="card shadow-sm border-0">
        <div class="card-header bg-white py-3">
            <h5 class="mb-0 fw-bold">Pending Borrow Requests</h5>
        </div>
        <div class="card-body">
            @if($pendingRequests->isEmpty())
                <p class="text-muted text-center py-4">No pending requests.</p>
            @else
                <div class="table-responsive">
                    <table class="table align-middle">
                        <thead>
                            <tr>
                                <th>User</th>
                                <th>Book</th>
                                <th>Requested Date</th>
                                <th>Due Date</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($pendingRequests as $request)
                            <tr>
                                <td>{{ $request->user->name }}<br><small class="text-muted">{{ $request->user->email }}</small></td>
                                <td>{{ $request->book->title }}</td>
                                <td>{{ $request->created_at->format('M d, Y') }}</td>
                                <td>{{ \Carbon\Carbon::parse($request->due_date)->format('M d, Y') }}</td>
                                <td>
                                    <div class="d-flex gap-2">
                                        <form action="{{ route('borrows.updateStatus', $request->id) }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="status" value="approved">
                                            <button class="btn btn-success btn-sm">Approve</button>
                                        </form>
                                        <form action="{{ route('borrows.updateStatus', $request->id) }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="status" value="rejected">
                                            <button class="btn btn-danger btn-sm">Reject</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
    </div>

    {{-- All Borrow History Section --}}
    <div class="card shadow-sm border-0 mt-5">
        <div class="card-header bg-white py-3">
            <h5 class="mb-0 fw-bold"><i class="bi bi-clock-history me-2"></i>Borrow History (All)</h5>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table align-middle table-striped">
                    <thead class="table-light">
                        <tr>
                            <th>User</th>
                            <th>Book</th>
                            <th>Requested</th>
                            <th>Due Date</th>
                            <th>Returned</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($allBorrows as $borrow)
                        <tr>
                            <td>{{ $borrow->user->name }}</td>
                            <td>{{ $borrow->book->title }}</td>
                            <td>{{ $borrow->created_at->format('M d, Y') }}</td>
                            <td>{{ \Carbon\Carbon::parse($borrow->due_date)->format('M d, Y') }}</td>
                            <td>
                                @if($borrow->returned_at)
                                    {{ \Carbon\Carbon::parse($borrow->returned_at)->format('M d, Y') }}
                                @else
                                    -
                                @endif
                            </td>
                            <td>
                                @if($borrow->status == 'pending')
                                    <span class="badge bg-warning text-dark">Pending</span>
                                @elseif($borrow->status == 'approved')
                                    <span class="badge bg-primary">Active</span>
                                @elseif($borrow->status == 'rejected')
                                    <span class="badge bg-danger">Rejected</span>
                                @elseif($borrow->status == 'returned')
                                    <span class="badge bg-success">Returned</span>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
