<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;

class SearchController extends Controller
{
    public function search(Request $request)
    {
        $query = $request->input('query');

        if (empty($query)) {
            return response()->json([
                'status' => 'empty',
                'results' => []
            ]);
        }

        $books = Book::with('category')
                    ->where('title', 'LIKE', "%{$query}%")
                    ->orWhereHas('category', function($q) use ($query) {
                        $q->where('name', 'LIKE', "%{$query}%");
                    })
                    ->limit(10)
                    ->get();

        if ($books->isEmpty()) {
            return response()->json([
                'status' => 'empty',
                'results' => []
            ]);
        }

        $results = $books->map(function ($book) {
            return [
                'id' => $book->id,
                'name' => $book->title, // Mapped 'title' to 'name' as requested
                'category' => $book->category ? $book->category->name : 'Uncategorized',
                'image' => $book->cover_image ? asset('storage/' . $book->cover_image) : null, // Assuming standard storage link
                'url' => route('books.show', $book->id) // Helper for frontend
            ];
        });

        return response()->json([
            'status' => 'success',
            'results' => $results
        ]);
    }
}
