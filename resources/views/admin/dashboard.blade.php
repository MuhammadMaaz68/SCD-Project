@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold">Admin Dashboard</h2>
    </div>

    <!-- Stats Cards -->
    <div class="row g-4 mb-5">
        <div class="col-md-4 col-lg-2">
            <a href="{{ route('books.index') }}" class="text-decoration-none">
                <div class="card bg-primary text-white border-0 shadow-sm h-100 hover-scale"> <!-- Add hover css later or allow default behavior -->
                    <div class="card-body text-center">
                        <h5 class="card-title">Total Books</h5>
                        <p class="display-4 fw-bold mb-0">{{ $totalBooks }}</p>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-md-4 col-lg-2">
            <a href="{{ route('admin.borrows.index', ['status' => 'approved']) }}" class="text-decoration-none">
                <div class="card bg-success text-white border-0 shadow-sm h-100">
                    <div class="card-body text-center">
                        <h5 class="card-title">Active Borrows</h5>
                        <p class="display-4 fw-bold mb-0">{{ $activeBorrows }}</p>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-md-4 col-lg-2">
            <a href="{{ route('admin.users.index') }}" class="text-decoration-none">
                <div class="card bg-info text-white border-0 shadow-sm h-100">
                    <div class="card-body text-center">
                        <h5 class="card-title">Registered Users</h5>
                        <p class="display-4 fw-bold mb-0">{{ $totalUsers }}</p>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-md-4 col-lg-3">
            <a href="{{ route('admin.borrows.index', ['status' => 'pending']) }}" class="text-decoration-none">
                <div class="card bg-warning text-dark border-0 shadow-sm h-100">
                    <div class="card-body text-center">
                        <h5 class="card-title">Pending Requests</h5>
                         <p class="display-4 fw-bold mb-0">{{ $pendingRequests->count() }}</p>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-md-4 col-lg-3">
             <a href="{{ route('profile.edit') }}" class="text-decoration-none">
                <div class="card bg-secondary text-white border-0 shadow-sm h-100">
                    <div class="card-body text-center d-flex flex-column justify-content-center align-items-center">
                        <i class="bi bi-gear-fill fs-1 mb-2"></i>
                        <h5 class="card-title mb-0">Profile Settings</h5>
                    </div>
                </div>
            </a>
        </div>
    </div>


@endsection
