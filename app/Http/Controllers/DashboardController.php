<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\User;
use App\Models\Product;
use App\Models\Category;
use Carbon\Carbon;

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
        $totalSalesPerDay = Order::where('status', 'delivered')
            ->selectRaw('DATE(created_at) as delivery_date, SUM(total_amount) as total_sales')
            ->groupBy('delivery_date')
            ->get();

        // Get the total sales per month
        $totalSalesPerMonth = Order::where('status', 'delivered')
            ->selectRaw('MONTH(created_at) as delivery_month, SUM(total_amount) as total_sales')
            ->groupBy('delivery_month')
            ->limit(3)->get();

        // Extract the delivery month and total sales into separate arrays
        $months = [];
        $sales = [];
        foreach ($totalSalesPerMonth as $salesPerMonth) {
            $monthNumber = $salesPerMonth->delivery_month;
            $monthName = Carbon::createFromDate(null, $monthNumber, null)->format('M');
            $months[] = $monthName;
            $sales[] = $salesPerMonth->total_sales;
        }

        return view('dashboard.dashboard', compact(['orders', 'totalSales', 'totalRevenue', 'totalnewOrders', 'totalRegisteredUsers', 'totalProducts', 'totalCategories', 'totalSalesPerMonth', 'months', 'sales']));
    }

    public function salesDetails()
    {
        // Get the total sales per month
        $totalSalesPerMonth = Order::where('status', 'delivered')
            ->selectRaw('MONTH(created_at) as delivery_month, SUM(total_amount) as total_sales')
            ->groupBy('delivery_month')
            ->get();

        // Extract the delivery month and total sales into separate arrays
        $months = [];
        $sales = [];
        foreach ($totalSalesPerMonth as $salesPerMonth) {
            $monthNumber = $salesPerMonth->delivery_month;
            $monthName = Carbon::createFromDate(null, $monthNumber, null)->format('M');
            $months[] = $monthName;
            $sales[] = $salesPerMonth->total_sales;
        }
        return view('admin.sales-detail', compact('totalSalesPerMonth'));
    }

}