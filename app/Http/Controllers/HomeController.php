<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Services\CartService;
use App\Models\Category;
use App\Models\Order;
use App\Models\OrderProduct;
use Illuminate\Support\Facades\DB;

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
    $products = Product::latest()->paginate(12);
    $rootCategories = Category::whereNull('parent_id')->get();
    $top = OrderProduct::select('product_id', DB::raw('COUNT(product_id) as `count`'))->groupBy('product_id')->orderBy('count', 'desc')->limit(3)->get();
    $topProd = collect([]);

    foreach ($top as $t) {
      $prod = Product::all()->where('id', '=', $t->product_id);
      $topProd = $topProd->concat($prod);
    }
    return view('home.store', compact('rootCategories', 'products', 'topProd'));
  }

  public function product_page(Product $product)
  {

    return view('home.product', compact('product'));
  }


  public function search(Request $request)
  {
    $products = Product::where('name', 'LIKE', '%' . $request->search . "%")->paginate(12);
    if ($products->total() != 0) {
      $search = $request->search;
      $request->session()->put('search', $search);
      $rootCategories = Category::whereNull('parent_id')->get();

      return view('home.store', compact('products', 'rootCategories'))->with('search', $request->search);
    } else {
      return redirect()->route('home')->with('notAvailable', 'No Products Available for "' . $request->search . '"');
    }
  }


  public function price_filter(Request $request)
  {
    $min_price = $request->price_min;
    $max_price = $request->price_max;

    $rootCategories = Category::whereNull('parent_id')->get();


    if ($max_price > $min_price && $max_price != 0) {

      // Price filtering with search
      if ($request->session()->has('search')) {
        $val = $request->session()->get('search');
        $request->session()->forget('search');
        $products = Product::where('name', 'LIKE', '%' . $val . "%")->whereBetween('unit_price', [$min_price, $max_price])->paginate(12);
        if ($products->isNotEmpty()) {

          return view('home.store', compact('products', 'rootCategories', 'min_price', 'max_price'))->with('price_filter', $val);
        } else {
          return redirect()->route('home')->with('notAvailable', 'No product Available for "' . $val . '"between price Rs ' . $min_price . '-' . $max_price);
        }
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
          return view('home.store', compact('products', 'rootCategories', 'min_price', 'max_price'))->with('price_filter', $val);
        } else {
          return redirect()->route('home')->with('notAvailable', 'No product Available for "' . $selectedCategory->name . '" category between price Rs ' . $min_price . '-' . $max_price);
        }
      }

      // Price Filter
      else {
        $products = Product::whereBetween('unit_price', [$min_price, $max_price])->paginate(9);
        if ($products->isNotEmpty()) {

          return view('home.store', compact('products', 'rootCategories', 'min_price', 'max_price'));
        } else {

          return redirect()->route('home')->with('notAvailable', 'No Products Available between price Rs ' . $min_price . '-' . $max_price);
        }
      }
    }
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
    session()->put('category', $slug);
    $selectedCategory = Category::where('slug', $slug)->first();
    $products = collect([]);
    $rootCategories = Category::whereNull('parent_id')->get();
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
      return view('home.store', compact('products', 'selectedCategory', 'rootCategories'));
    }
    return redirect()->route('home')->with('notAvailable', 'No Products Available for "' . $selectedCategory->name . '" category', 'rootCategories');
  }
}
