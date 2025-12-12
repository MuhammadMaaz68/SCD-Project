@extends('layouts.app')

@section('content')
<div class="container py-5">
    <h2 class="mb-4 fw-bold">Your Cart</h2>
    
    @if(session('cart') && count(session('cart')) > 0)
        <div class="card shadow-sm border-0">
            <div class="card-body">
                <table class="table align-middle">
                    <thead>
                        <tr>
                            <th>Book</th>
                            <th>Quantity</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach(session('cart') as $id => $details)
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center">
                                        @if(isset($details['image']) && $details['image'])
                                            <img src="{{ Storage::url($details['image']) }}" width="50" height="75" class="rounded me-3" style="object-fit:cover">
                                        @else
                                            <div class="bg-secondary rounded me-3 d-flex align-items-center justify-content-center text-white small" style="width: 50px; height: 75px;">No Img</div>
                                        @endif
                                        <div>
                                            <h5 class="mb-0">{{ $details['name'] }}</h5>
                                        </div>
                                    </div>
                                </td>
                                <td>{{ $details['quantity'] }}</td>
                                <td>
                                    <form action="{{ route('cart.remove') }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="id" value="{{ $id }}">
                                        <button class="btn btn-danger btn-sm"><i class="bi bi-trash"></i> Remove</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="text-end mt-3">
                <div class="text-end mt-3">
                    <form action="{{ route('cart.checkout') }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-success btn-lg">
                            <i class="bi bi-journal-arrow-up"></i> Request Borrow
                        </button>
                    </form>
                </div>
            </div>
        </div>
    @else
        <div class="text-center py-5">
            <h4 class="text-muted">Your cart is empty</h4>
            <a href="{{ route('books.list') }}" class="btn btn-primary mt-3">Browse Books</a>
        </div>
    @endif
</div>
@endsection
