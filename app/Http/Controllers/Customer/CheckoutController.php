<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CheckoutController extends Controller
{
    // Show Checkout Page
    public function index()
    {
        $carts = Cart::with('product')
            ->where('user_id', Auth::id())
            ->get();

        if ($carts->isEmpty()) {
            return redirect()->route('cart.index')
                ->with('success', 'Your cart is empty.');
        }

        $total = 0;

        foreach ($carts as $cart) {
            $total += $cart->product->price * $cart->quantity;
        }

        return view('customer.checkout.index', compact('carts', 'total'));
    }

    // Place Order
    public function store(Request $request)
    {
        $carts = Cart::with('product')
            ->where('user_id', Auth::id())
            ->get();

        if ($carts->isEmpty()) {
            return redirect()->route('cart.index');
        }

        DB::beginTransaction();

        try {

            $total = 0;

            foreach ($carts as $cart) {
                $total += $cart->product->price * $cart->quantity;
            }

            $order = Order::create([
                'user_id' => Auth::id(),
                'total_amount' => $total,
                'status' => 'Pending',
                'payment_method' => 'Cash on Delivery',
            ]);

            foreach ($carts as $cart) {

                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $cart->product_id,
                    'quantity' => $cart->quantity,
                    'price' => $cart->product->price,
                ]);

            }

            Cart::where('user_id', Auth::id())->delete();

            DB::commit();

            return redirect()->route('orders.index')
                ->with('success', 'Order placed successfully!');

        } catch (\Exception $e) {

            DB::rollBack();

            return back()->with('error', 'Something went wrong.');

        }
    }
}