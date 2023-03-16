<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\Category;


class HomeController extends Controller
{
  protected $cat;
  /**
   * Show the application dashboard.
   *
   * @return \Illuminate\Http\Response
   */

  public function index()
  {
    $products = Product::latest()->paginate(12);

    return view('home.store', compact('products'));
  }

  /**
   * Show specific product's view
   * 
   * @param \App\Models\Product $product
   * @return \Illuminate\Http\Response
   */
  public function product_page(Product $product)
  {
    return view('home.product', compact('product'));
  }

  /**
   * Search products based on keyword
   * 
   * @param \Illuminate\Http\Request $request
   * @return \Illuminate\Http\Response
   */
  public function search(Request $request)
  {
    $products = Product::where('name', 'LIKE', '%' . $request->search . "%")->paginate(12);
    $search = $request->search;
    if (session()->has('category')) {
      session()->forget('category');
    }
    $request->session()->put('search', $search);
    if ($products->total() != 0) {

      return view('home.store', compact('products'))->with('search', $request->search);
    } else {
      return redirect()->route('home')->with('notAvailable', 'No Products Available for "' . $request->search . '"');
    }
  }

  /**
   * Search product based on price range
   * 
   * @param \Illuminate\Http\Request $request
   * @return \Illuminate\Http\Response
   */
  public function price_filter(Request $request)
  {

    $min_price = $request->price_min;
    $max_price = $request->price_max;



    // Price filtering with search
    if ($request->session()->has('search')) {

      $val = $request->session()->get('search');
      $request->session()->forget('search');
      $products = Product::where('name', 'LIKE', '%' . $val . "%")->whereBetween('unit_price', [$min_price, $max_price])->paginate(12);

      if ($products->isNotEmpty()) {

        return view('home.store', compact('products', 'min_price', 'max_price'))->with('price_filter', $val);
      } else {
        return redirect()->route('home')->with('notAvailable', 'No product Available for "' . $val . '"between price Rs ' . $min_price . '-' . $max_price);
      }
    }

    // Price filtering with category
    elseif ($request->session()->has('category')) {

      $val = $request->session()->get('category');
      $request->session()->forget('category');

      list($products, $selectedCategory) = $this->getProductByCategory($val);

      $products = $products->whereBetween('unit_price', [$min_price, $max_price])->paginate(12);
      if ($products->isNotEmpty()) {
        return view('home.store', compact('products', 'min_price', 'max_price'))->with('price_filter', $val);
      } else {
        return redirect()->route('home')->with('notAvailable', 'No product Available for "' . $selectedCategory->name . '" category between price Rs ' . $min_price . '-' . $max_price);
      }
    }

    // Price Filter
    else {
      $products = Product::whereBetween('unit_price', [$min_price, $max_price])->paginate(9);
      if ($products->isNotEmpty()) {

        return view('home.store', compact('products', 'min_price', 'max_price'));
      } else {

        return redirect()->route('home')->with('notAvailable', 'No Products Available between price Rs ' . $min_price . '-' . $max_price);
      }
    }
  }


  /**
   * @return \Illuminate\Http\Response
   */
  public function order()
  {
    $user = Auth()->user();
    return view('order', compact('user'));
  }

  /**
   * Show Products of a Category and its child category
   *
   * @param string $slug
   * 
   * @return \Illuminate\Http\Response
   */
  public function productByCategory($slug)
  {
    session()->put('category', $slug);

    if (session()->has('search')) {
      session()->forget('search');
    }


    list($products, $selectedCategory) = $this->getProductByCategory($slug);

    if ($products->isNotEmpty()) {
      $products = $products->paginate(6);
      return view('home.store', compact('products', 'selectedCategory'));
    }
    return redirect()->route('home')->with('notAvailable', 'No Products Available for "' . $selectedCategory->name . '" category');
  }

  /**
   * Get Products by Category name
   * 
   * @param string $slug
   * @return array
   */
  function getProductByCategory($slug)
  {
    $selectedCategory = Category::where('slug', $slug)->first();
    $products = collect([]);

    if ($selectedCategory->children->isNotEmpty()) {
      $descendants = $selectedCategory->getDescendants($selectedCategory);
      foreach ($descendants as $descendant) {
        $product = Product::where('category_id', $descendant)->get();
        $products = $products->concat($product);
      }
    } else {
      $products = $selectedCategory->products()->get();
    }
    return [$products, $selectedCategory];
  }
}
