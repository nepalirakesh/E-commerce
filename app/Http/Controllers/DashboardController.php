<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\User;
use App\Models\Product;
use App\Models\Category;

class DashboardController extends Controller
{
    public function dashboard()
    {
        $orders = Order::orderBy('created_at')->get()->take(10);
        $totalSales = Order::where('status', 'delivered')->count();
        $totalnewOrders = Order::where('status', 'pending')->count();
        $totalRegisteredUsers = User::all()->count();
        $totalRevenue = Order::where('status', 'delivered')->sum('total_amount');
        $totalProducts = Product::all()->count();
        $totalCategories = Category::all()->count();
        return view('dashboard.dashboard', compact(['orders', 'totalSales', 'totalRevenue', 'totalnewOrders', 'totalRegisteredUsers', 'totalProducts', 'totalCategories']));
    }

}