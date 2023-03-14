<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Http\Requests\ProductRequest;
use Illuminate\Support\Str;
use App\Traits\ImageUpload;
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
        $products = Product::all()->paginate(10);
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
            $front_image = $this->uploadImage($request->file('front_image'));
            $side_image = $this->uploadImage($request->file('side_image'));
            $back_image = $this->uploadImage($request->file('back_image'));
        }
        $product->save();
        $product->photo()->create([
            'front_image' => $front_image,
            'side_image' => $side_image,
            'back_image' => $back_image,
        ]);

        // Create product specification
        if ($request->specifications) {

            foreach ($request->specifications as $key => $value) {
                if ($value['specification']) {
                    $product->specification()->create($value);
                }
            }
        }

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

        if ($request->hasFile('front_image')) {
            $this->deleteImage($product->photo->front_image);
            $front_image = $this->uploadImage($request->file('front_image'));
            $product->photo()->update([
                'front_image' => $front_image,
            ]);
        }
        if ($request->hasFile('side_image')) {
            $this->deleteImage($product->photo->side_image);
            $side_image = $this->uploadImage($request->file('side_image'));
            $product->photo()->update([
                'side_image' => $side_image,
            ]);
        }
        if ($request->hasFile('back_image')) {
            $this->deleteImage($product->photo->back_image);
            $back_image = $this->uploadImage($request->file('back_image'));
            $product->photo()->update([
                'back_image' => $back_image,
            ]);
        }

        $product->unit_price = $request->price;
        $product->quantity = $request->quantity;

        $product->save();

        $product->photo()->update([
            'front_image' => $front_image,
            'side_image' => $side_image,
            'back_image' => $back_image,
        ]);
        //Delete specification other than requested
        if (!$request->specifications) {
            $different_spec = $product->specification()->pluck('specification')->toArray();
        } else {
            $specification = $product->specification()->pluck('specification')->toArray();
            foreach ($request->specifications as $key => $value) {
                $req_spec[] = $value['specification'];
            }
            $different_spec = array_diff($specification, $req_spec);
        }

        foreach ($different_spec as $diff) {
            $spec = $product->specification()->where('specification', $diff)->first();
            $spec->delete();
        }

        //Check specification table and create specification if not available in table else update specification table
        if ($request->specifications) {
            foreach ($request->specifications as $key => $value) {
                if ($value['specification'] && $value['value']) {

                    $spec = $product->specification()->where('specification', $value['specification'])->first();
                    if (is_null($spec)) {
                        $product->specification()->create($value);
                    } else {
                        $spec->update([
                            'specification' => $value['specification'],
                            'value' => $value['value'],
                        ]);
                    }
                }
            }
        }

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