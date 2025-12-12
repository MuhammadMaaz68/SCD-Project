<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;

class CartController extends Controller
{
    // Display Cart
    public function index()
    {
        $cart = session()->get('cart', []);
        return view('cart.index', compact('cart'));
    }

    // Add item to cart
    public function addToCart(Request $request, $id)
    {
        $book = Book::findOrFail($id);
        $cart = session()->get('cart', []);

        if(isset($cart[$id])) {
            $cart[$id]['quantity']++;
        } else {
            $cart[$id] = [
                "name" => $book->title,
                "quantity" => 1,
                "price" => 0, // Assuming 0 for now as no price column exists, or add Logic if price exists
                "image" => $book->cover_image
            ];
        }

        session()->put('cart', $cart);
        
        // Return back to verify flash message works
        return redirect()->back()->with('success', 'Book added to cart successfully!');
    }

    // Remove item from cart
    public function remove(Request $request)
    {
        if($request->id) {
            $cart = session()->get('cart');
            if(isset($cart[$request->id])) {
                unset($cart[$request->id]);
                session()->put('cart', $cart);
            }
            return redirect()->back()->with('success', 'Book removed from cart successfully!');
        }
    }
    // Handle Bulk Borrow Request
    public function checkout()
    {
        $cart = session()->get('cart');

        if(!$cart) {
            return redirect()->back()->with('error', 'Your cart is empty!');
        }

        foreach($cart as $id => $details) {
            \App\Models\Borrow::create([
                'user_id' => auth()->id(),
                'book_id' => $id,
                'borrowed_at' => now(),
                'due_date' => now()->addDays(14), // Default 2 weeks
                'status' => 'pending'
            ]);
        }

        session()->forget('cart');

        return redirect()->route('user.dashboard')->with('success', 'Borrow request sent to admin successfully!');
    }
}
