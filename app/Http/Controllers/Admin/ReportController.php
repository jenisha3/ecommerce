<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\User;

class ReportController extends Controller
{
    public function index()
    {
        
        $totalRevenue = Order::sum('total_amount');

        $totalOrders = Order::count();

        $totalProducts = Product::count();

        $totalCustomers = User::role('Customer')->count();

        $pendingOrders = Order::where('status', 'Pending')->count();

        $completedOrders = Order::where('status', 'Completed')->count();

        $cancelledOrders = Order::where('status', 'Cancelled')->count();

        $monthlyRevenue = Order::whereMonth('created_at', now()->month)
            ->whereYear('created_at', now()->year)
            ->sum('total_amount');

        $bestSellingProducts = OrderItem::selectRaw(
                'product_id, SUM(quantity) as total_sold'
            )
            ->with('product')
            ->groupBy('product_id')
            ->orderByDesc('total_sold')
            ->take(5)
            ->get();

        $recentOrders = Order::latest()
            ->take(10)
            ->get();

        return view('admin.reports.index', compact(
            'totalRevenue',
            'monthlyRevenue',
            'totalOrders',
            'totalProducts',
            'totalCustomers',
            'pendingOrders',
            'completedOrders',
            'cancelledOrders',
            'bestSellingProducts',
            'recentOrders'
        ));
    }
}