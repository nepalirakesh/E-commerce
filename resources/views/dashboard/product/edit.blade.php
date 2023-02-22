@extends('layouts.dashboard.master')
@section('title', 'Edit Product')
@section('content')
    <div class="container w-50  mt-5">
        <h3 class="text-center">Edit Products</h3>
        <div class="card">
            <form class="p-3 border" action="{{ route('product.update', $product) }}" method="POST"
                enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="title">Product Name</label>

                    <input type="text" class="form-control" id="name" placeholder="Enter product name" name="name"
                        value="{{ $product->name }}">
                    <span style="color:red">
                        @error('name')
                            {{ $message }}
                        @enderror
                    </span>
                </div>
                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea class="form-control" name="description" id="description" cols="" rows="3"
                        placeholder="Enter Description">{{ $product->description }}</textarea>
                    <span style="color:red">
                        @error('description')
                            {{ $message }}
                        @enderror
                    </span>
                </div>
                <div class="form-group">
                    <label for="image">Image</label>
                    <br>
                    <img src={{ asset("storage/images/$product->image") }} width="100px" height="100px" alt="">
                    <input type="file" class="form-control" id="image" name="image" onchange="loadFile(event)"
                        value={{ $product->image }}>
                    <span style="color:red">
                        @error('image')
                            {{ $message }}
                        @enderror
                    </span>
                </div>
                <div id="show" style="display:none;">
                    <label for="preview">Image Preview</label><br>
                    <img id="preview" width="100px" height="100px"><br><br>
                </div>
                <div class="form-group">
                    <label for="category">Category</label>
                    <select class="form-control" id="category" name="category_id">
                        <option value="{{ $product->category->id }}" selected>{{ $product->category->name }}</option>
                        @foreach ($rootCategories as $cat)
                            @include('dashboard.product.editsubcategories', ['subcategory' => $cat])
                        @endforeach
                    </select>
                    <span style="color:red">
                        @error('category_id')
                            {{ $message }}
                        @enderror
                    </span>
                </div>
                <div class="form-group">
                    <label for="price">Price(In Rs)</label>
                    <input type="number" class="form-control" id="price" name="price" min="1"
                        placeholder="Enter price" value={{ $product->unit_price }}>
                    <span style="color:red">
                        @error('price')
                            {{ $message }}
                        @enderror
                    </span>
                </div>
                <div class="form-group">
                    <label for="quantity">Quantity</label>
                    <input type="number" class="form-control" id="quantity" name="quantity" min="1"
                        placeholder="Enter Quantity" value={{ $product->quantity }}>
                    <span style="color:red">
                        @error('quantity')
                            {{ $message }}
                        @enderror
                    </span>
                </div>
                <div class="text-center">
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </form>
        </div>

    </div>
@endsection
