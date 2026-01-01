<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

/**
 * Class WishlistController
 *
 * This controller handles the user's wishlist functionality.
 * It allows adding and removing books from the wishlist.
 */
class WishlistController extends Controller
{
    /**
     * Display the user's wishlist.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $wishlistItems = \App\Models\Wishlist::with('book')->where('user_id', auth()->id())->get();
        return view('wishlist.index', compact('wishlistItems'));
    }

    /**
     * Add a book to the wishlist.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
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

    /**
     * Remove a book from the wishlist.
     *
     * @param  string  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(string $id)
    {
        $item = \App\Models\Wishlist::where('user_id', auth()->id())->where('id', $id)->firstOrFail();
        $item->delete();

        return redirect()->back()->with('success', 'Book removed from wishlist.');
    }
}
