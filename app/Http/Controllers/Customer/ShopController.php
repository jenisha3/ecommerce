<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;

class ShopController extends Controller
{
    /**
     * Display all products.
     */
    public function index()
    {
        $products = Product::where('status', 1)
            ->with('category')
            ->latest()
            ->get();

        $categories = Category::all();

        return view('shop.index', compact('products', 'categories'));
    }

    /**
     * Display a single product.
     */
    public function show(Product $product)
    {
        return view('shop.show', compact('product'));
    }

    /**
     * Display products by category.
     */
    public function category(Category $category)
    {
        $products = Product::where('category_id', $category->id)
            ->where('status', 1)
            ->latest()
            ->get();

        $categories = Category::all();

        return view('shop.category', compact('products', 'category', 'categories'));
    }
}