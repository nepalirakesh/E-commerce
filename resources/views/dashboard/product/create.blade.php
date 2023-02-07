@extends('layouts.dashboard.master')
@section('content')
<div class="container w-50 mt-5">
    <h3 class="text-center">Add Products</h3>
    <form class="p-3 border border-dark" action="{{route('product.store')}}" method="POST"
        enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="title">Name</label>
            <input type="text" class="form-control" id="name" aria-describedby="emailHelp" placeholder="Enter title"
                name="name" value="{{ old('title') }}">
            <span style="color:red">
                @error('title')
                {{ $message }}
                @enderror
            </span>
        </div>
        <div class="form-group">
            <label for="description">Description</label>
            <textarea class="form-control" name="description" id="description" cols="" rows="3"
                placeholder="Enter Description">{{ old('description') }}</textarea>
            <span style="color:red">
                @error('description')
                {{ $message }}
                @enderror
            </span>
        </div>

        <div class="form-group">
            <label for="image">Image</label>
            <input type="file" class="form-control" id="image" name="image" onchange="loadFile(event)">
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
                <option disabled selected>Select Category</option>
                <option value="1">1</option>
            </select>
            <span style="color:red">
                @error('category')
                {{ $message }}
                @enderror
            </span>
        </div>
        <div class="form-group">
            <label for="price">Price(In Rs)</label>
            <input type="number" class="form-control" id="price" name="price" min="1" placeholder="Enter price">
        </div>
        <div class="form-group">
            <label for="quantity">Quantity</label>
            <input type="number" class="form-control" id="quantity" name="quantity" min="1"
                placeholder="Enter Quantity">
        </div>
        <div class="text-center">
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
    </form>
</div>
@endsection