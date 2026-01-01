{{-- 
    View: Wishlist
    Description: Displays user's saved books.
    Features:
    - Grid view of wishlisted items
    - Remove from wishlist functionality
--}}
@extends('layouts.app')

@section('content')
<div class="container py-4">
    <h2 class="fw-bold mb-4">My Wishlist</h2>

    @if($wishlistItems->isEmpty())
        <div class="alert alert-info">
            Your wishlist is empty. <a href="{{ route('books.list') }}">Browse Books</a>
        </div>
    @else
        <div class="row row-cols-1 row-cols-md-3 g-4">
            @foreach($wishlistItems as $item)
            <div class="col">
                <div class="card h-100 shadow-sm border-0">
                    <img src="{{ Storage::url($item->book->cover_image) }}" class="card-img-top" alt="{{ $item->book->title }}" style="height: 300px; object-fit: cover;">
                    <div class="card-body">
                        <h5 class="card-title fw-bold">{{ $item->book->title }}</h5>
                        <p class="card-text text-muted">{{ Str::limit($item->book->description, 100) }}</p>
                    </div>
                    <div class="card-footer bg-white border-0 d-flex justify-content-between align-items-center">
                        <a href="{{ route('books.detail', $item->book->id) }}" class="btn btn-primary btn-sm rounded-pill px-3">View</a>
                        
                        <form action="{{ route('wishlist.destroy', $item->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-outline-danger btn-sm rounded-circle" title="Remove">
                                <i class="bi bi-trash"></i> X
                            </button>
                        </form>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    @endif
</div>
@endsection
