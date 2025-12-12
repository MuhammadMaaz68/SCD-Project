<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WishlistController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $wishlistItems = \App\Models\Wishlist::with('book')->where('user_id', auth()->id())->get();
        return view('wishlist.index', compact('wishlistItems'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'book_id' => 'required|exists:books,id',
        ]);

        \App\Models\Wishlist::firstOrCreate([
            'user_id' => auth()->id(),
            'book_id' => $request->book_id,
        ]);

        return redirect()->back()->with('success', 'Book added to wishlist!');
    }

    public function destroy(string $id)
    {
        $item = \App\Models\Wishlist::where('user_id', auth()->id())->where('id', $id)->firstOrFail();
        $item->delete();

        return redirect()->back()->with('success', 'Book removed from wishlist.');
    }
}
