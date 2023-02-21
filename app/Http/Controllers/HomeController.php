<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Services\CartService;

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
        $products = Product::all();
        // $cartService = new CartService(session());
        // dd($cartService);

        // dd($products);
        return view('welcome', compact(['products']));
    }

    public function cartComponent()
    {
        return view('cart');
    }
}