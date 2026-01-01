<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

/**
 * Class PageController
 *
 * This controller handles the static and public-facing pages of the bookstore.
 * It manages views for the home page, book listings, details, checkout, and contact form.
 */
class PageController extends Controller
{
    /**
     * Display the home page.
     *
     * Fetches the latest 3 books for display.
     *
     * @return \Illuminate\View\View
     */
    public function home()
    {
        $books = \App\Models\Book::latest()->take(3)->get();
        return view('home', compact('books'));
    }

    /**
     * Display the books listing page (Catalog).
     *
     * Fetches paginated books with their categories.
     *
     * @return \Illuminate\View\View
     */
    public function books()
    {
        $books = \App\Models\Book::with('category')->latest()->paginate(12);
        return view('books.books', compact('books'));
    }

    /**
     * Display the details of a specific book.
     *
     * Fetches the book's reviews and category.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\View\View
     */
    public function bookDetail(\App\Models\Book $book)
    {
        $book->load(['reviews.user', 'category']);
        return view('books.detail', compact('book'));
    }

    /**
     * Display the checkout page.
     *
     * @return \Illuminate\View\View
     */
    public function checkout()
    {
        return view('checkout');
    }

    /**
     * Display the contact page.
     *
     * @return \Illuminate\View\View
     */
    public function contact()
    {
        return view('contact');
    }

    /**
     * Handle the contact form submission.
     *
     * Validates input and returns a success message.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function submitContact(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'message' => 'required',
        ]);

        return back()->with('success', 'Thank you for your message! We will get back to you soon.');
    }
}

