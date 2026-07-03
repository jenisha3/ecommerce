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
    
    public function index()
    {
        $carts = Cart::with('product')
            ->where('user_id', Auth::id())
            ->get();

        if ($carts->isEmpty()) {
            return redirect()
                ->route('cart.index')
                ->with('error', 'Your cart is empty.');
        }

        $total = 0;

        foreach ($carts as $cart) {
            $total += $cart->product->price * $cart->quantity;
        }

        return view('customer.checkout.index', compact('carts', 'total'));
    }

   
    public function store(Request $request)
    {
        $request->validate([
            'customer_name' => 'required|max:255',
            'email' => 'required|email',
            'phone' => 'required|max:20',
            'shipping_address' => 'required',
            'payment_method' => 'required',
        ]);

        $carts = Cart::with('product')
            ->where('user_id', Auth::id())
            ->get();

        if ($carts->isEmpty()) {
            return redirect()
                ->route('cart.index')
                ->with('error', 'Your cart is empty.');
        }

        DB::beginTransaction();

        try {

            $total = 0;

            foreach ($carts as $cart) {

                if ($cart->quantity > $cart->product->stock) {

                    DB::rollBack();

                    return redirect()
                        ->route('cart.index')
                        ->with(
                            'error',
                            'Only ' . $cart->product->stock .
                            ' item(s) available for ' .
                            $cart->product->name
                        );
                }

                $total += $cart->product->price * $cart->quantity;
            }

            $order = Order::create([
                'user_id' => Auth::id(),
                'customer_name' => $request->customer_name,
                'email' => $request->email,
                'phone' => $request->phone,
                'shipping_address' => $request->shipping_address,
                'payment_method' => $request->payment_method,
                'total_amount' => $total,
                'status' => 'Pending',
            ]);

            foreach ($carts as $cart) {

                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $cart->product_id,
                    'quantity' => $cart->quantity,
                    'price' => $cart->product->price,
                ]);

                $cart->product->decrement('stock', $cart->quantity);
            }

            Cart::where('user_id', Auth::id())->delete();

            DB::commit();

            return redirect()
                ->route('orders.index')
                ->with('success', 'Order placed successfully.');
        } catch (\Exception $e) {

            DB::rollBack();

            return redirect()
                ->route('cart.index')
                ->with('error', 'Something went wrong. Please try again.');
        }
    }
}