<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function search(Request $request)
    {
        $query = $request->input('query');
        $categoryId = $request->input('category_id');

        $products = Product::query();

        if ($query) {
            $products->where('name', 'LIKE', "%{$query}%")
                     ->orWhere('description', 'LIKE', "%{$query}%");
        }

        if ($categoryId) {
            $products->where('category_id', $categoryId);
        }

        $results = $products->with('category')->get();

        return response()->json(['results' => $results], 200);
    }
}
