<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Inventory;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
    //  */
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $price_min = Product::min('price');
        $price_max = Product::max('price');
        $products = Product::all();
        return view('home.store', compact('products', 'price_min', 'price_max'));
    }

    public function price_filter(Request $request)
    {
        $min_price = $request->price_min;
        $max_price = $request->price_max;
        $price_min = Product::min('price');
        $price_max = Product::max('price');

        if ($min_price > 0 && $max_price > 0) {
            $products = Product::select('id', 'name', 'image', 'price', 'description')->whereBetween('price', [$min_price, $max_price])->get();
        }
        return view('home.store', compact('products', 'price_min', 'price_max'));
    }
}
