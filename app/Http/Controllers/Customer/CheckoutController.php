<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Mail\OrderPlacedMail;
use App\Models\Cart;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class CheckoutController extends Controller
{
    /**
     * Show Checkout Page
     */
    public function index()
    {
        $cartItems = Cart::with('product')
            ->where('user_id', Auth::id())
            ->get();

        if ($cartItems->count() == 0) {
            return redirect()
                ->route('cart.index')
                ->with('error', 'Your cart is empty.');
        }

        $total = 0;

        foreach ($cartItems as $item) {
            $price = $item->product->discount_price ?: $item->product->price;
            $total += $price * $item->quantity;
        }

        return view('customer.checkout.index', compact(
            'cartItems',
            'total'
        ));
    }

    /**
     * Place Order
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'    => 'required|string|max:255',
            'phone'   => 'required|string|max:20',
            'address' => 'required|string',
        ]);

        // Get Cart Items
        $cartItems = Cart::with('product')
            ->where('user_id', Auth::id())
            ->get();

        if ($cartItems->count() == 0) {
            return redirect()
                ->route('cart.index')
                ->with('error', 'Your cart is empty.');
        }

        // Calculate Total
        $total = 0;

        foreach ($cartItems as $item) {

            $price = $item->product->discount_price ?: $item->product->price;

            $total += $price * $item->quantity;
        }

        // Create Order
        $order = Order::create([

            'user_id' => Auth::id(),

            'name' => $request->name,

            'customer_name' => $request->name,

            'email' => Auth::user()->email,

            'phone' => $request->phone,

            'address' => $request->address,

            'shipping_address' => $request->address,

            'total_amount' => $total,

            'payment_method' => 'Cash on Delivery',

            'status' => 'Pending',
        ]);

        // Save Order Items
        foreach ($cartItems as $item) {

            $price = $item->product->discount_price ?: $item->product->price;

            $order->items()->create([

                'product_id' => $item->product_id,

                'quantity' => $item->quantity,

                'price' => $price,

            ]);
        }

        // Clear Cart
        Cart::where('user_id', Auth::id())->delete();

        // Send Order Confirmation Email
        Mail::to($order->email)->send(new OrderPlacedMail($order));

        // Redirect
        return redirect()
            ->route('orders.show', $order->id)
            ->with('success', 'Order placed successfully. A confirmation email has been sent to your email address.');
    }
}