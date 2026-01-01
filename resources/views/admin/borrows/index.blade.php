<!-- {{-- 
    View: Borrow Management
    Description: Manages borrow requests and records.
    Features:
    - Filter by status (Pending, Active, Returned, Rejected)
    - Actions to Approve, Reject, or Mark Returned
--}} -->
@extends('layouts.app')

@section('content')
<div class="row mb-4">
    <div class="col-md-6">
        <h2>Borrow Management</h2>
    </div>
    <div class="col-md-6 text-end">
        <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary">
            <i class="bi bi-arrow-left"></i> Back to Dashboard
        </a>
    </div>
</div>

<div class="card shadow-sm border-0 mb-4">
    <div class="card-body">
        <form action="{{ route('admin.borrows.index') }}" method="GET" class="row g-3 align-items-center">
            <div class="col-auto">
                <label class="col-form-label fw-bold">Filter By Status:</label>
            </div>
            <div class="col-auto">
                <select name="status" class="form-select" onchange="this.form.submit()">
                    <option value="">All Statuses</option>
                    <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending Requests</option>
                    <option value="approved" {{ request('status') == 'approved' ? 'selected' : '' }}>Active Borrows</option>
                    <option value="returned" {{ request('status') == 'returned' ? 'selected' : '' }}>Returned</option>
                    <option value="rejected" {{ request('status') == 'rejected' ? 'selected' : '' }}>Rejected</option>
                </select>
            </div>
        </form>
    </div>
</div>

<div class="card shadow-sm border-0">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table align-middle table-hover">
                <thead class="table-light">
                    <tr>
                        <th>User</th>
                        <th>Book</th>
                        <th>Requested Date</th>
                        <th>Due Date</th>
                        <th>Returned Date</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($borrows as $borrow)
                    <tr>
                        <td>
                            <div class="fw-bold">{{ $borrow->user->name }}</div>
                            <small class="text-muted">{{ $borrow->user->email }}</small>
                        </td>
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
                        <td>
                            @if($borrow->status == 'pending')
                                <div class="d-flex gap-2">
                                    <form action="{{ route('borrows.updateStatus', $borrow->id) }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="status" value="approved">
                                        <button class="btn btn-success btn-sm">Approve</button>
                                    </form>
                                    <form action="{{ route('borrows.updateStatus', $borrow->id) }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="status" value="rejected">
                                        <button class="btn btn-danger btn-sm">Reject</button>
                                    </form>
                                </div>
                            @elseif($borrow->status == 'approved')
                                <form action="{{ route('borrows.updateStatus', $borrow->id) }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="status" value="returned">
                                    <button class="btn btn-info btn-sm text-white">Mark Returned</button>
                                </form>
                            @else
                                <span class="text-muted">-</span>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="text-center py-4">No records found.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="mt-3">
             {{ $borrows->withQueryString()->links('pagination::bootstrap-5') }}
        </div>
    </div>
</div>
@endsection
