<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;

class HomeController extends Controller
{
    public function index()
    {
        $featuredProducts = Product::where('is_featured', true)
                                 ->where('status', 'active')
                                 ->take(8)
                                 ->get();
                                 
        $newProducts = Product::where('status', 'active')
                            ->latest()
                            ->take(8)
                            ->get();
                            
        $categories = Category::withCount('products')
                            ->take(6)
                            ->get();

        return view('home', compact('featuredProducts', 'newProducts', 'categories'));
    }
}