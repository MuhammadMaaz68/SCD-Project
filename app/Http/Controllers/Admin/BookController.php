<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Book;

/**
 * Class BookController
 *
 * This controller manages the administrative CRUD operations for books.
 * Note: This seems to duplicate some logic from the main BookController.
 */
class BookController extends Controller
{
    /**
     * Display a listing of books.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $books = Book::all();
        return view('admin.books.index', compact('books'));
    }

    /**
     * Show the form for creating a new book.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('admin.books.create');
    }

    /**
     * Store a newly created book in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'author' => 'required',
            'image' => 'nullable|image',
        ]);

        $imageName = null;

        if($request->hasFile('image')){
            $imageName = time().'_'.$request->image->getClientOriginalName();
            $request->image->move(public_path('images/books'), $imageName);
        }

        Book::create([
            'title' => $request->title,
            'author' => $request->author,
            'description' => $request->description,
            'image' => $imageName
        ]);

        return redirect()->route('books.index')->with('success','Book added successfully!');
    }

    /**
     * Show the form for editing the specified book.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\View\View
     */
    public function edit(Book $book)
    {
        return view('admin.books.edit', compact('book'));
    }

    /**
     * Update the specified book in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Book $book)
    {
        $request->validate([
            'title' => 'required',
            'author' => 'required'
        ]);

        if($request->hasFile('image')){
            $imageName = time().'_'.$request->image->getClientOriginalName();
            $request->image->move(public_path('images/books'), $imageName);
            $book->image = $imageName;
        }

        $book->update($request->only('title','author','description'));

        return redirect()->route('books.index')->with('success','Book updated.');
    }

    /**
     * Remove the specified book from storage.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Book $book)
    {
        $book->delete();
        return redirect()->route('books.index')->with('success','Book removed.');
    }
}
