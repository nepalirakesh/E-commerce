@extends('layouts.dashboard.master')
@section('title', 'Create Product')
@section('content')
    <div class="container w-50 mt-5">
        <h3 class="text-center">Add Products</h3>
        <div class="card">
            <form class="p-3 border" action="{{ route('product.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="title">Product Name</label>
                    <input type="text" class="form-control" id="name" aria-describedby="emailHelp"
                        placeholder="Enter product name" name="name" value="{{ old('name') }}">
                    <span style="color:red">
                        @error('name')
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
                    <br>
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
                        @foreach ($rootCategories as $cat)
                            @include('dashboard.category.subcategories', ['category' => $cat])
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
                    <input type="text" class="form-control" id="price" name="price" min="1"
                        placeholder="Enter price" value="{{ old('price') }}">
                    <span style=" color:red">
                        @error('price')
                            {{ $message }}
                        @enderror
                    </span>
                </div>
                <div class="form-group">
                    <label for="value">Quantity</label>
                    <input type="number" class="form-control" id="quantity" name="quantity" min="1"
                        placeholder="Enter Quantity" value="{{ old('quantity') }}">
                    <span style=" color:red ">
                        @error('quantity')
                            {{ $message }}
                        @enderror
                    </span>
                </div>

                <!--Dynamic Fields-->
                <div class="field_wrapper">
                    <label for="">Specification(Optional)</label>
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
                    <div class="spec">
                        <div class="row">
                            <div class="form-group col-5">
                                <input type="text" class="form-control" name="specifications[0][specification]"
                                    placeholder="Enter specification">
                            </div>
                            <div class="form-group col-6">
                                <input type="text" class="form-control" name="specifications[0][value]"
                                    placeholder="Enter value">
                            </div>
                            <div class="col-1">
                                <a class="btn btn-danger delete_button"><i class="fa fa-trash"
                                        aria-hidden="true"></i></a>
                            </div>
                        </div>
                    </div>
                       
                    @endforelse
                </div>
                <div class="form-group">
                    <a class="btn btn-primary add_button btn-sm">Add More Specification</a>
                </div>
                <!--/.Dynamic Fields-->
                <div class="text-center">
                    <button type="submit" class="btn btn-primary">Submit</button>
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
