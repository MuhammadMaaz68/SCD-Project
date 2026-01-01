<!-- {{-- 
    View: Admin Books List
    Description: Manges books and categories.
    Features:
    - List of books with edit/delete actions
    - List of categories with edit/delete actions
--}} -->
@extends('layouts.app')

@section('content')
<div class="row mb-4 align-items-center">
    <div class="col-md-6">
        <h2 class="fw-bold text-dark">Library Management</h2>
    </div>
    <div class="col-md-6 text-end">
        <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary me-2">
            <i class="bi bi-arrow-left"></i> Back to Dashboard
        </a>
    </div>
</div>



<!-- Books Section -->
<div class="card shadow-sm border-0 mb-5">
    <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
        <h5 class="mb-0 fw-bold"><i class="bi bi-book me-2"></i>Books</h5>
        <a href="{{ route('books.create') }}" class="btn btn-primary btn-sm btn-glow">
            <i class="bi bi-plus-lg"></i> Add Book
        </a>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table align-middle table-hover">
                <thead class="table-light">
                    <tr>
                        <th>#</th>
                        <th>Cover</th>
                        <th>Title</th>
                        <th>Category</th>
                        <th>Stock</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($books as $book)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>
                                @if($book->cover_image)
                                    <img src="{{ Storage::url($book->cover_image) }}" alt="Cover" style="height: 50px; width: auto;" class="rounded">
                                @else
                                    <span class="text-muted small">No Img</span>
                                @endif
                            </td>
                            <td class="fw-semibold">{{ $book->title }}<br><small class="text-muted">{{ $book->author }}</small></td>
                            <td><span class="badge bg-info text-dark">{{ $book->category ? $book->category->name : 'N/A' }}</span></td>
                            <td>
                                <span class="badge bg-{{ $book->quantity > 0 ? 'success' : 'danger' }}">
                                    {{ $book->quantity }}
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
                    @empty
                        <tr><td colspan="6" class="text-center py-4">No books found.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="mt-3">{{ $books->links('pagination::bootstrap-5') }}</div>
    </div>
</div>

<!-- Categories Section -->
<div class="card shadow-sm border-0">
    <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
        <h5 class="mb-0 fw-bold"><i class="bi bi-tags me-2"></i>Categories</h5>
        <a href="{{ route('categories.create') }}" class="btn btn-info btn-sm btn-glow text-white">
            <i class="bi bi-plus-lg"></i> Add Category
        </a>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table align-middle table-hover">
                <thead class="table-light">
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Description</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($categories as $category)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td class="fw-bold">{{ $category->name }}</td>
                            <td class="text-muted small">{{ Str::limit($category->description, 50) }}</td>
                            <td>
                                <div class="d-flex gap-2">
                                    <a href="{{ route('categories.edit', $category) }}" class="btn btn-sm btn-outline-warning"><i class="bi bi-pencil"></i></a>
                                    <form action="{{ route('categories.destroy', $category) }}" method="POST" onsubmit="return confirm('Delete this category?');">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-sm btn-outline-danger"><i class="bi bi-trash"></i></button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="4" class="text-center py-4">No categories found.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="mt-3">{{ $categories->links('pagination::bootstrap-5') }}</div>
    </div>
</div>
@endsection
