<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Http\Requests\ProductRequest;
use Illuminate\Support\Str;
use App\Traits\ImageUpload;
use App\Models\Inventory;
use App\Models\Category;


class ProductController extends Controller
{
    use ImageUpload;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::all();
        return view('dashboard.product.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $rootCategories = Category::whereNull('parent_id')->get();
        return view('dashboard.product.create', compact('rootCategories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductRequest $request)
    {

        $product = new Product();
        $product->name = $request->name;
        $product->unit_price = $request->price;
        $product->quantity = $request->quantity;
        $product->slug = Str::slug($request->name, '-');
        $product->category_id = $request->category_id;
        $product->description = $request->description;
        $product->status = 1;
        if ($request->file('image')) {
            $product->image = $this->uploadImage($request->file('image'));
        }
        $product->save();
        return redirect('product')->with('success', 'Product Added Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        return view('dashboard.product.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {

        $products = Product::all();

        $rootCategories = Category::whereNull('parent_id')->get();
        return view('dashboard.product.edit', compact('products', 'rootCategories', 'product'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(ProductRequest $request, Product $product)
    {

        $product->name = $request->name;
        $product->slug = Str::slug($request->name, '-');
        $product->description = $request->description;
        $product->category_id = $request->category_id;

        if ($request->hasFile('image')) {
            $this->deleteImage($product->image);
            $product->image = $this->uploadImage($request->file('image'));
        }

        $product->unit_price = $request->price;
        $product->quantity = $request->quantity;
        $product->save();


        return redirect('product')->with('update', 'Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $this->deleteImage($product->image);
        $product->delete();
        return redirect('product')->with('delete', 'Deleted Successfully');
    }
}