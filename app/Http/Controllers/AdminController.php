<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        $totalBooks = \App\Models\Book::count();
        $totalUsers = \App\Models\User::where('role', 'user')->count();
        $activeBorrows = \App\Models\Borrow::where('status', 'approved')->count();
        
        $pendingRequests = \App\Models\Borrow::with(['user', 'book'])
            ->where('status', 'pending')
            ->orderBy('created_at', 'desc')
            ->get();

        $books = \App\Models\Book::with('category')->latest()->get();
        $categories = \App\Models\Category::all();
        $allBorrows = \App\Models\Borrow::with(['user', 'book'])->latest()->get();

        return view('admin.dashboard', compact('totalBooks', 'totalUsers', 'activeBorrows', 'pendingRequests', 'books', 'categories', 'allBorrows'));
    }
}
