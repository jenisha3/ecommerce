<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    // Display Cart
   public function index()
{
    $cartItems = Cart::with('product')
        ->where('user_id', Auth::id())
        ->get();

    $total = 0;

    foreach ($cartItems as $item) {
        $total += $item->product->price * $item->quantity;
    }

    return view('customer.cart.index', compact('cartItems', 'total'));
}

    // Add Product to Cart
    public function store(Product $product)
    {
    $cart = Cart::where('user_id', Auth::id())
        ->where('product_id', $product->id)
        ->first();

    if ($cart) {

        // checks stock before increasing quantity
        if ($cart->quantity >= $product->stock) {

            return redirect()->back()->with(
                'error',
                'Only '.$product->stock.' item(s) available in stock.'
            );
        }

        $cart->increment('quantity');

        } else {

        if ($product->stock < 1) {

            return redirect()->back()->with(
                'error',
                'This product is out of stock.'
            );
        }

        Cart::create([
            'user_id' => Auth::id(),
            'product_id' => $product->id,
            'quantity' => 1,
        ]);
    }

    return redirect()->route('cart.index')
        ->with('success', 'Product added to cart successfully.');
}
    // Update Quantity
    public function update(Request $request, Cart $cart)
    {
    $request->validate([
        'quantity' => 'required|integer|min:1',
    ]);

    if ($request->quantity > $cart->product->stock) {

        return back()->with(
            'error',
            'Only '.$cart->product->stock.' items are available in stock.'
        );
    }

    $cart->update([
        'quantity' => $request->quantity,
    ]);

    return back()->with('success', 'Cart updated successfully.');
    }

    // Remove Item
    public function destroy(Cart $cart)
    {
        $cart->delete();

        return back()->with('success', 'Product removed from cart.');
    }
}