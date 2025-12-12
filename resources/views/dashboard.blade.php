@extends('layouts.app')

@section('content')
<div class="container py-4">
    <h2 class="fw-bold mb-4">{{ auth()->user()->name }}'s Dashboard</h2>

    <div class="row">
        <!-- Sidebar / Menu -->
        <div class="col-md-3 mb-4">
            <div class="list-group shadow-sm">
                <a href="{{ route('user.dashboard') }}" class="list-group-item list-group-item-action {{ request()->routeIs('user.dashboard') ? 'active' : '' }}">My Books</a>
                <a href="{{ route('wishlist.index') }}" class="list-group-item list-group-item-action {{ request()->routeIs('wishlist.index') ? 'active' : '' }}">Wishlist</a>
                <a href="{{ route('profile.edit') }}" class="list-group-item list-group-item-action">Profile Settings</a>
            </div>
        </div>

        <!-- Content -->
        <div class="col-md-9">
            <!-- Active Borrows -->
            <div class="card shadow-sm border-0 mb-4">
                <div class="card-header bg-white py-3">
                    <h5 class="mb-0 fw-bold">Active Borrows & Requests</h5>
                </div>
                <div class="card-body">
                    @if($borrowedBooks->isEmpty())
                        <p class="text-muted">You haven't borrowed any books yet. <a href="{{ route('books.list') }}">Explore Books</a></p>
                    @else
                        <div class="table-responsive">
                            <table class="table align-middle">
                                <thead>
                                    <tr>
                                        <th>Book</th>
                                        <th>Status</th>
                                        <th>Due Date</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($borrowedBooks as $borrow)
                                    <tr>
                                        <td>{{ $borrow->book->title }}</td>
                                        <td>
                                            @if($borrow->status == 'approved')
                                                <span class="badge bg-success">Approved</span>
                                            @else
                                                <span class="badge bg-warning text-dark">Pending</span>
                                            @endif
                                        </td>
                                        <td>{{ \Carbon\Carbon::parse($borrow->due_date)->format('M d, Y') }}</td>
                                        <td>
                                            @if($borrow->status == 'approved')
                                                <form action="{{ route('borrows.return', $borrow->id) }}" method="POST">
                                                    @csrf
                                                    <button type="submit" class="btn btn-sm btn-outline-primary">Return</button>
                                                </form>
                                            @else
                                                <span class="text-muted small">-</span>
                                            @endif
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif
                </div>
            </div>

            <!-- History -->
            <div class="card shadow-sm border-0">
                <div class="card-header bg-white py-3">
                    <h5 class="mb-0 fw-bold">Borrow History</h5>
                </div>
                <div class="card-body">
                    @if($history->isEmpty())
                        <p class="text-muted">No history available.</p>
                    @else
                         <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Book</th>
                                        <th>Status</th>
                                        <th>Returned Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($history as $record)
                                    <tr>
                                        <td>{{ $record->book->title }}</td>
                                        <td>
                                            @if($record->status == 'returned')
                                                <span class="badge bg-secondary">Returned</span>
                                            @else
                                                <span class="badge bg-danger">Rejected</span>
                                            @endif
                                        </td>
                                        <td>{{ $record->returned_at ? \Carbon\Carbon::parse($record->returned_at)->format('M d, Y') : '-' }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
