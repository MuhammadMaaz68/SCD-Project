<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        if (auth()->user()->role === 'admin') {
            return redirect()->route('admin.dashboard');
        }
        return redirect()->route('user.dashboard');
    }

    public function userDashboard()
    {
        $user = auth()->user();
        $borrowedBooks = \App\Models\Borrow::with('book')
            ->where('user_id', $user->id)
            ->whereIn('status', ['approved', 'pending'])
            ->get();

        $history = \App\Models\Borrow::with('book')
            ->where('user_id', $user->id)
            ->whereIn('status', ['returned', 'rejected'])
            ->get();
            
        return view('dashboard', compact('borrowedBooks', 'history'));
    }
}
