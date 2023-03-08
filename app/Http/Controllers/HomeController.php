<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Services\CartService;
use App\Models\Category;
use App\Models\Order;

class HomeController extends Controller
{
  protected $cat;
  /**
   * Show the application dashboard.
   *
   * @return \Illuminate\Contracts\Support\Renderable
   */
  public function index()
  {
    $categories = Category::all();
    $products = Product::latest()->paginate(12);
    return view('home.store', compact('categories', 'products'));
  }

  public function product_page(Product $product)
  {

    return view('home.product', compact('product'));
  }


  public function search(Request $request)
  {

    $categories = Category::all();
    $products = Product::where('name', 'LIKE', '%' . $request->search . "%")->paginate(12);
    if ($products->total() != 0) {
      $search = $request->search;
      $request->session()->put('search', $search);
      return view('home.store', compact('products', 'categories'))->with('search', $request->search);
    } else {
      return redirect()->route('home')->with('notAvailable', 'No Products Available for ');
    }
  }


  public function price_filter(Request $request)
  {
    $min_price = $request->price_min;
    $max_price = $request->price_max;

    $price_min = Product::min('unit_price');
    $price_max = Product::max('unit_price');

    $categories = Category::all();
    if ($max_price > $min_price && $max_price != 0) {

      // Price filtering with search
      if ($request->session()->has('search')) {
        $val = $request->session()->get('search');
        $request->session()->forget('search');
        $products = Product::where('name', 'LIKE', '%' . $val . "%")->whereBetween('unit_price', [$min_price, $max_price])->paginate(12);
        return view('home.store', compact('products', 'categories', 'price_min', 'price_max'))->with('price_filter', $val);
      }

      // Price filtering with category
      elseif (session()->has('category')) {
        $val = $request->session()->get('category');
        $request->session()->forget('category');
        $selectedCategory = Category::where('slug', $val)->first();
        $products = collect([]);

        //Get all Descandants(child category) if category has a child and retrieve all products of descendants and self
        if ($selectedCategory->children->isNotEmpty()) {
          $descendants = $selectedCategory->getDescendants($selectedCategory);
          foreach ($descendants as $descendant) {
            $product = Product::where('category_id', $descendant)->paginate(12);
            $products = $products->concat($product);
          }
        } else {
          $products = $selectedCategory->products()->whereBetween('unit_price', [$min_price, $max_price])->paginate(12);
        }
        if ($products->isNotEmpty()) {
          $products = $products->whereBetween('unit_price', [$min_price, $max_price])->paginate(12);
        }
        return view('home.store', compact('products', 'categories', 'price_min', 'price_max'))->with('price_filter', $val);
      }

      // Price Filter
      else {
        $products = Product::whereBetween('unit_price', [$min_price, $max_price])->paginate(9);
        return view('home.store', compact('products', 'categories', 'price_min', 'price_max'));
      }
    } else {
      return redirect()->route('home')->with('notAvailable', 'No Products Available for ');
    }
  }




  /**
   * Show the application dashboard.
   *
   * @return \Illuminate\Contracts\Support\Renderable
   */
  public function welcome()
  {
    $categories = Category::all();
    $products = Product::latest()->paginate(12);
    return view('welcome', compact(['products', 'categories']));
  }

  public function cartComponent()
  {
    return view('cart');
  }

  public function order()
  {

    $user = Auth()->user();
    return view('order', compact('user'));
  }

  /**
   * Show Products of a Category and its child category
   *
   * @param string $slug
   */
  public function productByCategory($slug)
  {
    $categories = Category::all();
    session()->put('category', $slug);




    $selectedCategory = Category::where('slug', $slug)->first();
    $products = collect([]);

    //Get all Descandants(child category) if category has a child and retrieve all products of descendants and self
    if ($selectedCategory->children->isNotEmpty()) {
      $descendants = $selectedCategory->getDescendants($selectedCategory);
      foreach ($descendants as $descendant) {
        $product = Product::where('category_id', $descendant)->get();
        $products = $products->concat($product);
      }
    } else {
      $products = $selectedCategory->products()->get();
    }
    if ($products->isNotEmpty()) {
      $products = $products->paginate(6);
      return view('home.store', compact('products', 'categories', 'selectedCategory'));
    }
    return redirect()->route('home')->with('notAvailable', 'No Products Available for ' . $selectedCategory->name . ' category');
  }
}
