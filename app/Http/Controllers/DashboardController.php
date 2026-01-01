<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

/**
 * Class DashboardController
 *
 * This controller directs users to the appropriate dashboard based on their role
 * and handles the user-specific dashboard view.
 */
class DashboardController extends Controller
{
    /**
     * Redirect to the appropriate dashboard based on user role.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function index()
    {
        if (auth()->user()->role === 'admin') {
            return redirect()->route('admin.dashboard');
        }
        return redirect()->route('user.dashboard');
    }

    /**
     * Display the user's dashboard (Borrowing History).
     *
     * Fetches current valid borrows and history (returned/rejected) for the view.
     *
     * @return \Illuminate\View\View
     */
    public function userDashboard()
    {
        $user = auth()->user();
        // Fetch active books (approved or pending)
        $borrowedBooks = \App\Models\Borrow::with('book')
            ->where('user_id', $user->id)
            ->whereIn('status', ['approved', 'pending'])
            ->get();

        // Fetch past interactions (returned or rejected)
        $history = \App\Models\Borrow::with('book')
            ->where('user_id', $user->id)
            ->whereIn('status', ['returned', 'rejected'])
            ->get();
            
        return view('dashboard', compact('borrowedBooks', 'history'));
    }
}
