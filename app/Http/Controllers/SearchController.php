<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class SearchController extends Controller
{
    public function search(Request $request)
    {
        $query = $request->input('query');
        $priceRange = $request->input('price_range');

        // Base query
        $products = Product::where('product_name', 'LIKE', "%{$query}%");
                            
        // Apply price filter if selected


        $products = $products->get();

        return view('usertemplate.searchresult', compact('products', 'query'));
    }
}

