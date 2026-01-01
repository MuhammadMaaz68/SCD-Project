<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Book;
use Illuminate\Http\Request;

/**
 * Class BookController
 *
 * This controller handles API requests related to books.
 * It provides endpoints to list books and get book details.
 */
class BookController extends Controller
{
    /**
     * Get a list of all books (API).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $books = Book::with('category', 'reviews')->get();
        return response()->json($books);
    }

    /**
     * Get details of a specific book (API).
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        $book = Book::with('category', 'reviews')->find($id);

        if (!$book) {
            return response()->json(['message' => 'Book not found'], 404);
        }

        return response()->json($book);
    }
}
