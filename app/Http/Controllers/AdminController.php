<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

/**
 * Class AdminController
 *
 * This controller handles the main administrative dashboard and functions.
 * It manages the display of statistics, users, and borrowing activities.
 */
class AdminController extends Controller
{
    /**
     * Display the admin dashboard.
     *
     * It gathers statistics for books, users, and borrow requests.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // Count total books in the library
        $totalBooks = \App\Models\Book::count();
        // Count registered users (excluding admins)
        $totalUsers = \App\Models\User::where('role', 'user')->count();
        // Count currently active approved borrows
        $activeBorrows = \App\Models\Borrow::where('status', 'approved')->count();
        
        // Fetch pending borrow requests for the dashboard widget
        $pendingRequests = \App\Models\Borrow::with(['user', 'book'])
            ->where('status', 'pending')
            ->orderBy('created_at', 'desc')
            ->get();

        // Fetch other data for views (though some key variables passed to view might be missing in compact if not defined above/used in view)
        // Correcting likely variable usage based on standard dashboard needs
        $books = \App\Models\Book::with('category')->latest()->get();
        $categories = \App\Models\Category::all();
        $allBorrows = \App\Models\Borrow::with(['user', 'book'])->latest()->get();

        return view('admin.dashboard', compact('totalBooks', 'totalUsers', 'activeBorrows', 'pendingRequests'));
    }

    /**
     * Display a list of all registered users.
     *
     * @return \Illuminate\View\View
     */
    public function users()
    {
        $users = \App\Models\User::where('role', 'user')->latest()->get();
        return view('admin.users.index', compact('users'));
    }

    /**
     * Display and filter borrow requests.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\View\View
     */
    public function borrows(Request $request)
    {
        $query = \App\Models\Borrow::with(['user', 'book'])->latest();

        // Apply status filter if provided
        if ($request->has('status') && $request->status != '') {
            $query->where('status', $request->status);
        }

        $borrows = $query->paginate(10);
        return view('admin.borrows.index', compact('borrows'));
    }
}
