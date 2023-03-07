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
                <!--Dynamic Field-->
                <div class="field_wrapper">
                    <label for="">Specification</label>
                    @forelse(old('specifications',[]) as $key => $value)
                        <div class="spec">
                            <div class="row">
                                <div class="form-group col-5">
                                    <input type="text" class="form-control"
                                        name="specifications[{{ $key }}][specification]"
                                        placeholder="Enter specification" value="{{ $value['specification'] }}">

                                </div>
                                <div class="form-group col-6">
                                    <input type="text" class="form-control"
                                        name="specifications[{{ $key }}][value]" placeholder="Enter value"
                                        value="{{ $value['value'] }}">
                                </div>
                                <div class="col-1">
                                    <a class="btn btn-danger delete_button"><i class="fa fa-trash"
                                            aria-hidden="true"></i></a>
                                </div>

                            </div>
                            <div class="row">
                                <div class="col-5">
                                    <span style=" color:red">
                                        @error("specifications.$key.specification")
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>

                                <div class="col-6">
                                    <span class="col-6"style=" color:red">
                                        @error("specifications.$key.value")
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>

                            </div>
                        </div>
                    @empty
                        @foreach ($product->specification as $spec)
                            <div class="spec">
                                <div class="row">
                                    <div class="form-group col-sm-5">
                                        <input type="text" class="form-control"
                                            name="specifications[{{ $spec->id }}][specification]"
                                            value="{{ $spec->specification }}">
                                    </div>
                                    <div class="form-group col-sm-6">
                                        <input type="text" class="form-control"
                                            name="specifications[{{ $spec->id }}][value]"
                                            value="{{ $spec->value }}">
                                    </div>
                                    <div class="col-sm-1">
                                        <a class="btn btn-danger delete_button"><i class="fa fa-trash"
                                                aria-hidden="true"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @endforelse
                </div>
                <!--/.Dynamic Field-->
                
                <div class="form-group">
                    <a class="btn btn-primary btn-sm add_button">Add Specification</a>
                </div>

                <div class="text-center">
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </form>
        </div>

    </div>
    <script>
        var i = 0;
        $(document).ready(function() {
            $('.add_button').click(function() {
                ++i;
                var html = `<div class="spec">
                             <div class="row">
                            <div class="form-group col-5">
                            <input type="text" class="form-control" name="specifications[${i}][specification] "placeholder="Enter specification">
                            </div>
                            <div class="form-group col-6">
                                <input type="text" class="form-control" name="specifications[${i}][value]" placeholder="Enter value">
                            </div>
                            <div class="col-1">
                             <a class="btn btn-danger delete_button"><i class="fa fa-trash" aria-hidden="true"></i></a>
                             </div>
                            </div>
                            </div>`
                $('.field_wrapper').append(html);
            })

            $('body').on('click', '.delete_button', function() {
                $(this).parents('.spec').remove();
            })
        })
    </script>
@endsection
