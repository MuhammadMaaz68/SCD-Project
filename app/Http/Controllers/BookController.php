<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Category;
use App\Http\Requests\StoreBookRequest;
use App\Http\Requests\UpdateBookRequest;
use Illuminate\Support\Facades\Storage;

/**
 * Class BookController
 *
 * This controller manages the CRUD operations for books in the admin panel.
 * It handles listing, creating, distinct, updating, and deleting books.
 */
class BookController extends Controller
{
    /**
     * Display a listing of the books.
     * 
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $books = Book::with('category')->latest()->paginate(10);
        $categories = \App\Models\Category::latest()->paginate(10);
        return view('admin.books.index', compact('books', 'categories'));
    }

    /**
     * Show the form for creating a new book.
     * 
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $categories = Category::all();
        return view('admin.books.create', compact('categories'));
    }

    /**
     * Store a newly created book in storage.
     *
     * @param  \App\Http\Requests\StoreBookRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreBookRequest $request)
    {
        $data = $request->validated();

        // Handle cover image upload
        if ($request->hasFile('cover_image')) {
            $path = $request->file('cover_image')->store('books', 'public');
            $data['cover_image'] = $path;
        }

        Book::create($data);

        return redirect()->route('books.index')->with('success', 'Book created successfully.');
    }

    /**
     * Display the specified book.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\View\View
     */
    public function show(Book $book)
    {
        return view('admin.books.show', compact('book'));
    }

    /**
     * Show the form for editing the specified book.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\View\View
     */
    public function edit(Book $book)
    {
        $categories = Category::all();
        return view('admin.books.edit', compact('book', 'categories'));
    }

    /**
     * Update the specified book in storage.
     *
     * @param  \App\Http\Requests\UpdateBookRequest  $request
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdateBookRequest $request, Book $book)
    {
        $data = $request->validated();

        // Handle cover image update
        if ($request->hasFile('cover_image')) {
            // Delete old image if exists
            if ($book->cover_image) {
                Storage::disk('public')->delete($book->cover_image);
            }
            $path = $request->file('cover_image')->store('books', 'public');
            $data['cover_image'] = $path;
        } else {
            // Keep old image
            unset($data['cover_image']);
        }

        $book->update($data);

        return redirect()->route('books.index')->with('success', 'Book updated successfully.');
    }

    /**
     * Remove the specified book from storage.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Book $book)
    {
        // Delete the cover image file
        if ($book->cover_image) {
            Storage::disk('public')->delete($book->cover_image);
        }
        $book->delete();

        return redirect()->route('books.index')->with('success', 'Book deleted successfully.');
    }
}
