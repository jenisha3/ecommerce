<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use Illuminate\Support\Facades\Mail;
use App\Mail\OrderStatusUpdatedMail;

class OrderController extends Controller
{
    /**
     * Display Orders
     */
    public function index(Request $request)
    {
        $orders = Order::with('user')

            ->when($request->search, function ($query) use ($request) {

                $query->whereHas('user', function ($q) use ($request) {

                    $q->where('name', 'like', '%' . $request->search . '%')
                      ->orWhere('email', 'like', '%' . $request->search . '%');

                });

            })

            ->when($request->status, function ($query) use ($request) {

                $query->where('status', $request->status);

            })

            ->latest()

            ->paginate(10);

        return view('admin.orders.index', compact('orders'));
    }

    /**
     * Show Create Form
     */
    public function create()
    {
        return view('admin.orders.create');
    }

    /**
     * Store Order
     */
    public function store(Request $request)
    {
        //
        // Normally customers create orders from checkout.
        // Admin usually doesn't create orders manually.
        //
    }

    /**
     * View Order
     */
    public function show(Order $order)
    {
        $order->load([
            'user',
            'items.product',
        ]);

        return view('admin.orders.show', compact('order'));
    }

    /**
     * Edit Order
     */
    public function edit(Order $order)
    {
        $order->load([
            'user',
            'items.product',
        ]);

        return view('admin.orders.edit', compact('order'));
    }

    /**
     * Update Order
     */
    public function update(Request $request, Order $order)
{
    $request->validate([

        'status' => 'required|in:Pending,Processing,Shipped,Delivered,Cancelled',

    ]);

    $order->update([

        'status' => $request->status,

    ]);

    // Send Email

    Mail::to($order->email)

        ->send(new OrderStatusUpdatedMail($order));

    return redirect()

        ->route('admin.orders.show', $order->id)

        ->with('success', 'Order status updated successfully. Email sent to customer.');

}
    

    /**
     * Delete Order
     */
    public function destroy(Order $order)
    {
        $order->delete();

        return redirect()
            ->route('admin.orders.index')
            ->with('success', 'Order deleted successfully.');
    }
}