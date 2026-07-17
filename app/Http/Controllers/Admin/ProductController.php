<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    
   public function index(Request $request)
{
    $query = Product::with('category');

    if ($request->filled('search')) {
        $query->where('name', 'like', '%' . $request->search . '%');
    }

    if ($request->filled('category')) {
        $query->where('category_id', $request->category);
    }

    if ($request->filled('status')) {
        $query->where('status', $request->status);
    }

    $products = $query->latest()->paginate(10);

    $categories = Category::all();

    return view('admin.products.index', compact('products', 'categories'));
}
    /**
     * Show create product form.
     */
    public function create()
    {
        $categories = Category::all();

        return view('admin.products.create', compact('categories'));
    }

    /**
     * Store a new product.
     */
    public function store(Request $request)
    {
        $request->validate([
            'category_id'    => 'required|exists:categories,id',
            'name'           => 'required|string|max:255|unique:products,name',
            'description'    => 'nullable|string',
            'price'          => 'required|numeric|min:0',
            'discount_price' => 'nullable|numeric|min:0|lt:price',
            'stock'          => 'required|integer|min:0',
            'image'          => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'featured'       => 'nullable',
            'status'         => 'nullable',
        ], [
            'discount_price.lt' => 'The discount price must be less than the actual price.',
        ]);

        $imageName = null;

        if ($request->hasFile('image')) {

            $imageName = time() . '.' . $request->image->extension();

            $request->image->move(public_path('products'), $imageName);
        }

        Product::create([
            'category_id'    => $request->category_id,
            'name'           => $request->name,
            'slug'           => Str::slug($request->name),
            'description'    => $request->description,
            'price'          => $request->price,
            'discount_price' => $request->discount_price,
            'stock'          => $request->stock,
            'image'          => $imageName,
            'featured'       => $request->has('featured'),
            'status'         => $request->has('status'),
        ]);

        return redirect()
            ->route('products.index')
            ->with('success', 'Product added successfully.');
    }

    /**
     * Display a single product.
     */
    public function show(Product $product)
    {
        return view('admin.products.show', compact('product'));
    }

    /**
     * Show edit form.
     */
    public function edit(Product $product)
    {
        $categories = Category::all();

        return view('admin.products.edit', compact('product', 'categories'));
    }

    /**
     * Update product.
     */
    public function update(Request $request, Product $product)
    {
        $request->validate([
            'category_id'    => 'required|exists:categories,id',
            'name'           => 'required|string|max:255|unique:products,name,' . $product->id,
            'description'    => 'nullable|string',
            'price'          => 'required|numeric|min:0',
            'discount_price' => 'nullable|numeric|min:0|lt:price',
            'stock'          => 'required|integer|min:0',
            'image'          => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ], [
            'discount_price.lt' => 'The discount price must be less than the actual price.',
        ]);

        $imageName = $product->image;

        if ($request->hasFile('image')) {

            if ($product->image && file_exists(public_path('products/' . $product->image))) {
                unlink(public_path('products/' . $product->image));
            }

            $imageName = time() . '.' . $request->image->extension();

            $request->image->move(public_path('products'), $imageName);
        }

        $product->update([
            'category_id'    => $request->category_id,
            'name'           => $request->name,
            'slug'           => Str::slug($request->name),
            'description'    => $request->description,
            'price'          => $request->price,
            'discount_price' => $request->discount_price,
            'stock'          => $request->stock,
            'image'          => $imageName,
            'featured'       => $request->has('featured'),
            'status'         => $request->has('status'),
        ]);

        return redirect()
            ->route('products.index')
            ->with('success', 'Product updated successfully.');
    }

    /**
     * Delete product.
     */
    public function destroy(Product $product)
    {
        if ($product->image && file_exists(public_path('products/' . $product->image))) {
            unlink(public_path('products/' . $product->image));
        }

        $product->delete();

        return redirect()
            ->route('products.index')
            ->with('success', 'Product deleted successfully.');
    }
}
