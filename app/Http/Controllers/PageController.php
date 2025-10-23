<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    // Home page
    public function home()
    {
        return view('home');
    }

    // Books page
    public function books()
    {
        return view('books.books');
    }

    // Book detail page
    public function bookDetail($id)
    {
        return view('books.detail');
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
}