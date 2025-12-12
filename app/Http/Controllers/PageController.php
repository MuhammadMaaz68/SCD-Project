<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    // Home page
    public function home()
    {
        $books = \App\Models\Book::latest()->take(3)->get();
        return view('home', compact('books'));
    }

    // Books page
    public function books()
    {
        $books = \App\Models\Book::with('category')->latest()->paginate(12);
        return view('books.books', compact('books'));
    }

    // Book detail page
    public function bookDetail(\App\Models\Book $book)
    {
        return view('books.detail', compact('book'));
    }

    // Checkout page
    public function checkout()
    {
        return view('checkout');
    }

    // Contact page
    public function contact()
    {
        return view('contact');
    }

    public function cart() {
    return view('cart');
}

public function addToCart($id) {
    // for now, redirect to cart with success message
    return redirect()->route('cart')->with('success', 'Book added to cart!');
}

}