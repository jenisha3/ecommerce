<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use App\Models\Order;

class DashboardController extends Controller
{
    public function index()
    {
        $totalCategories = Category::count();

        $totalProducts = Product::count();

        $totalCustomers = User::role('Customer')->count();

        $totalOrders = Order::count();

        $pendingOrders = Order::where('status', 'Pending')->count();

        $processingOrders = Order::where('status', 'Processing')->count();

        $shippedOrders = Order::where('status', 'Shipped')->count();

        $deliveredOrders = Order::where('status', 'Delivered')->count();

        $cancelledOrders = Order::where('status', 'Cancelled')->count();

        $totalRevenue = Order::where('status', 'Delivered')
                            ->sum('total_amount');

        $lowStockProducts = Product::where('stock', '<=', 5)->count();

        return view('admin.dashboard', compact(
            'totalCategories',
            'totalProducts',
            'totalCustomers',
            'totalOrders',
            'pendingOrders',
            'processingOrders',
            'shippedOrders',
            'deliveredOrders',
            'cancelledOrders',
            'totalRevenue',
            'lowStockProducts'
        ));
    }
}