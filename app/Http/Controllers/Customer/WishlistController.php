<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Wishlist;

class WishlistController extends Controller
{
    public function index()
    {
        $wishlists = Wishlist::with('product')
            ->where('user_id', auth()->id())
            ->latest()
            ->get();

        return view('customer.wishlist.index', compact('wishlists'));
    }

    public function store(Product $product)
    {
        Wishlist::firstOrCreate([
            'user_id' => auth()->id(),
            'product_id' => $product->id,
        ]);

        return back()->with('success', 'Added to wishlist.');
    }

    public function destroy(Wishlist $wishlist)
    {
        if ($wishlist->user_id != auth()->id()) {
            abort(403);
        }

        $wishlist->delete();

        return back()->with('success', 'Removed from wishlist.');
    }
}