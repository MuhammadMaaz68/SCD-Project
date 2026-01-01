@extends('layouts.app')

@section('title', 'My Orders')

@section('content')
<h1 class="mb-4 text-white">Order History</h1>

<div class="table-responsive">
    <table class="table table-dark table-hover">
        <thead>
            <tr>
                <th>Order #</th>
                <th>Date</th>
                <th>Total</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody id="orders-table-body">
            @forelse($orders as $order)
            <tr>
                <td>{{ $order->order_number }}</td>
                <td>{{ $order->created_at->format('M d, Y') }}</td>
                <td>${{ number_format($order->total_price, 2) }}</td>
                <td>
                    <span class="badge bg-{{ $order->status === 'completed' ? 'success' : ($order->status === 'cancelled' ? 'danger' : 'warning') }}">
                        {{ ucfirst($order->status) }}
                    </span>
                </td>
                <td>
                    <a href="{{ route('orders.show', $order->id) }}" class="btn btn-sm btn-outline-light">View</a>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="5" class="text-center">No orders found.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const token = localStorage.getItem('api_token'); // Assuming we stored token on login, OR we rely on session for web
        
        // If using web session auth for API (Passport createToken for User), we might need to handle this.
        // For now, let's assume standard Web Auth works if we use standard Controllers, 
        // OR we need to fetch via API with bearer token.
        // Simplified: Use a Blade Foreach loop if we passed variables from Controller.
        // BUT strict requirement was "Use Eloquent relationships for clean queries... User dashboard page... Order details page".
        
        // I will implement a Controller method to return this view with data to keep it robust like typical Laravel apps.
    });
</script>
@endsection
