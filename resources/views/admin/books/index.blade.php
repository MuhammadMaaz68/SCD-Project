@extends('layouts.app')

@section('content')
<div class="row mb-4">
    <div class="col-md-6">
        <h2>Books</h2>
    </div>
    <div class="col-md-6 text-end">
        <a href="{{ route('books.create') }}" class="btn btn-primary btn-glow">
            <i class="bi bi-plus-lg"></i> Add Book
        </a>
    </div>
</div>

@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

<div class="card bg-dark text-white border-secondary">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-dark table-striped table-hover align-middle">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Cover</th>
                        <th>Title</th>
                        <th>Author</th>
                        <th>Category</th>
                        <th>Qty</th>
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
                                    <span class="text-muted">No Image</span>
                                @endif
                            </td>
                            <td>{{ $book->title }}</td>
                            <td>{{ $book->author }}</td>
                            <td>{{ $book->category ? $book->category->name : 'N/A' }}</td>
                            <td>{{ $book->quantity }}</td>
                            <td>
                                <a href="{{ route('books.edit', $book) }}" class="btn btn-sm btn-info text-white me-1">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                
                                <form action="{{ route('books.destroy', $book) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center py-4">No books found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        <div class="mt-3">
            {{ $books->links('pagination::bootstrap-5') }}
        </div>
    </div>
</div>
@endsection
