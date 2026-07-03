<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;

class ShopController extends Controller
{
    public function index()
    {
        $products = Product::where('status', 1)
            ->with('category')
            ->latest()
            ->get();

        $categories = Category::all();

        return view('customer.shop.index', compact('products', 'categories'));
    }

    public function show(Product $product)
    {
        return view('customer.shop.show', compact('product'));
    }

    public function category(Category $category)
    {
        $products = Product::where('category_id', $category->id)
            ->where('status', 1)
            ->latest()
            ->get();

        $categories = Category::all();

        return view('customer.shop.category', compact(
            'products',
            'category',
            'categories'
        ));
    }
}