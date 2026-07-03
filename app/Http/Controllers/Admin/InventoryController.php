<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
class InventoryController extends Controller
{
     public function index()
    {
        $products = Product::with('category')
                    ->orderBy('name')
                    ->get();

        return view('admin.inventory.index', compact('products'));
    }
}

