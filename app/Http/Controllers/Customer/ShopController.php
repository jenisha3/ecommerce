<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    /**
     * Home Page
     */
    public function index()
    {
        $featuredProducts = Product::where('status', 1)
            ->where('featured', 1)
            ->latest()
            ->take(8)
            ->get();

        $latestProducts = Product::where('status', 1)
            ->latest()
            ->take(8)
            ->get();

        $categories = Category::orderBy('name')->get();

        return view('shop.index', compact(
            'featuredProducts',
            'latestProducts',
            'categories'
        ));
    }

    /**
     * All Products
     */
    public function products(Request $request)
    {
        $query = Product::with('category')
            ->where('status', 1);

        // Search
        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        // Category Filter
        if ($request->filled('category')) {
            $query->where('category_id', $request->category);
        }

        // Sorting
        if ($request->sort == 'low_high') {

            $query->orderBy('price');

        } elseif ($request->sort == 'high_low') {

            $query->orderByDesc('price');

        } else {

            $query->latest();

        }

        $products = $query->paginate(12);

        $categories = Category::orderBy('name')->get();

        return view('shop.products', compact(
            'products',
            'categories'
        ));
    }

    /**
     * Categories Page
     */
    public function categories()
    {
        $categories = Category::withCount('products')
            ->orderBy('name')
            ->get();

        return view('shop.categories', compact('categories'));
    }

    /**
     * Product Details
     */
    public function show(Product $product)
    {
        $relatedProducts = Product::where('category_id', $product->category_id)
            ->where('id', '!=', $product->id)
            ->where('status', 1)
            ->take(4)
            ->get();

        return view('shop.show', compact(
            'product',
            'relatedProducts'
        ));
    }

    /**
     * Products by Category
     */
    public function category(Category $category)
    {
        $products = Product::where('category_id', $category->id)
            ->where('status', 1)
            ->paginate(12);

        return view('shop.category', compact(
            'category',
            'products'
        ));
    }

    /**
     * Search Products
     */
    public function search(Request $request)
    {
        $products = Product::where('status', 1)
            ->where(function ($query) use ($request) {

                $query->where('name', 'like', '%' . $request->search . '%')
                      ->orWhere('description', 'like', '%' . $request->search . '%');

            })
            ->paginate(12);

        $categories = Category::orderBy('name')->get();

        return view('shop.products', compact(
            'products',
            'categories'
        ));
    }
}