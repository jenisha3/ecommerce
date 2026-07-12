<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;

class InventoryController extends Controller
{
    /**
     * Display Inventory List
     */
    public function index(Request $request)
    {
        $products = Product::with('category')

            ->when($request->search, function ($query) use ($request) {

                $query->where('name', 'like', '%' . $request->search . '%');

            })

            ->when($request->category, function ($query) use ($request) {

                $query->where('category_id', $request->category);

            })

            ->when($request->stock, function ($query) use ($request) {

                if ($request->stock == 'in') {

                    $query->where('stock', '>', 5);

                }

                if ($request->stock == 'low') {

                    $query->whereBetween('stock', [1, 5]);

                }

                if ($request->stock == 'out') {

                    $query->where('stock', 0);

                }

            })

            ->orderBy('name')

            ->paginate(10);

        $categories = Category::orderBy('name')->get();

        return view('admin.inventory.index', compact(
            'products',
            'categories'
        ));
    }

    /**
     * Show Update Stock Form
     */
    public function edit(Product $product)
    {
        $product->load('category');

        return view('admin.inventory.edit', compact('product'));
    }

    /**
     * Update Inventory
     */
    public function update(Request $request, Product $product)
    {
        $request->validate([

            'stock' => 'required|integer|min:0',

            'status' => 'required|boolean',

            'featured' => 'required|boolean',

        ]);

        $product->update([

            'stock' => $request->stock,

            'status' => $request->status,

            'featured' => $request->featured,

        ]);

        return redirect()
            ->route('admin.inventory.index')
            ->with('success', 'Inventory updated successfully.');
    }
}