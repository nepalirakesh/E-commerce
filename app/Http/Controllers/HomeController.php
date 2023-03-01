<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Services\CartService;
use App\Models\Category;

class HomeController extends Controller
{



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



    $products = Product::where('name', 'LIKE', '%' . $request->search . "%")->paginate(1);
    $products->appends(['search' => $request->search]);
    return view('home.store', compact('products', 'categories'));
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

  /**
   * Show Products of a Category and its child category
   *
   * @param string $slug
   */
  public function productByCategory($slug)
  {
    $categories = Category::all();
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
