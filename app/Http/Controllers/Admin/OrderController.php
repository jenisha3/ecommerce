<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display all orders.
     */
    public function index()
    {
        $orders = Order::with('user')
            ->latest()
            ->get();

        return view('admin.orders.index', compact('orders'));
    }

    /**
     * Show the specified order.
     */
    public function show(Order $order)
    {
        $order->load('items.product', 'user');

        return view('admin.orders.show', compact('order'));
    }

    /**
     * Show the form for creating a new resource.
     * Not used.
     */
    public function create()
    {
        abort(404);
    }

    /**
     * Store a newly created resource.
     * Not used.
     */
    public function store(Request $request)
    {
        abort(404);
    }

    /**
     * Show the form for editing the specified resource.
     * Not used.
     */
    public function edit(Order $order)
    {
        abort(404);
    }

    /**
     * Update the specified order.
     */
    public function update(Request $request, Order $order)
    {
        $request->validate([
            'status' => 'required|in:Pending,Processing,Shipped,Delivered,Cancelled',
        ]);

        $order->update([
            'status' => $request->status,
        ]);

        return redirect()
            ->route('admin.orders.show', $order->id)
            ->with('success', 'Order status updated successfully.');
    }

    /**
     * Delete an order.
     * Not recommended in an e-commerce system.
     */
    public function destroy(Order $order)
    {
        return redirect()
            ->route('admin.orders.index')
            ->with('error', 'Orders cannot be deleted.');
    }
}