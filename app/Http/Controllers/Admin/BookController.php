<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Book;

class BookController extends Controller
{
    public function index()
    {
        $books = Book::all();
        return view('admin.books.index', compact('books'));
    }

    public function create()
    {
        return view('admin.books.create');
    }

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

    public function edit(Book $book)
    {
        return view('admin.books.edit', compact('book'));
    }

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

    public function destroy(Book $book)
    {
        $book->delete();
        return redirect()->route('books.index')->with('success','Book removed.');
    }
}
