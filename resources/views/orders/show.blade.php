@extends('layouts.app')

@section('title', 'Order Details')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="text-white">Order #{{ $order->order_number }}</h1>
        <a href="{{ route('orders.index') }}" class="btn btn-outline-light">Back to History</a>
    </div>

    <div class="card bg-dark text-white border-secondary mb-4">
        <div class="card-header border-secondary">
            Order Summary
        </div>
        <div class="card-body">
            <p><strong>Date:</strong> {{ $order->created_at->format('F d, Y h:i A') }}</p>
            <p><strong>Status:</strong> <span class="badge bg-{{ $order->status === 'completed' ? 'success' : ($order->status === 'cancelled' ? 'danger' : 'warning') }}">{{ ucfirst($order->status) }}</span></p>
            <p><strong>Total Price:</strong> ${{ number_format($order->total_price, 2) }}</p>
        </div>
    </div>

    <h3 class="text-white mb-3">Items</h3>
    <div class="table-responsive">
        <table class="table table-dark table-hover border-secondary">
            <thead>
                <tr>
                    <th>Product</th>
                    <th>Image</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Subtotal</th>
                </tr>
            </thead>
            <tbody>
                @foreach($order->items as $item)
                <tr>
                    <td>{{ $item->product->name }}</td>
                    <td>
                        @if($item->product->image)
                            <img src="{{ asset('storage/' . $item->product->image) }}" alt="{{ $item->product->name }}" style="width: 50px; height: 50px; object-fit: cover;">
                        @else
                            <span class="text-muted">No Image</span>
                        @endif
                    </td>
                    <td>${{ number_format($item->price, 2) }}</td>
                    <td>{{ $item->quantity }}</td>
                    <td>${{ number_format($item->price * $item->quantity, 2) }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
