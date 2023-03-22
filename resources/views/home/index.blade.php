@extends('layouts.frontend.master')
@section('title', 'E-commerce Home')
@section('content')
    @include('layouts.dashboard.crudmessage')
    <!-- SECTION -->
    <div class="section">
        <!-- container -->
        <div class="container">
            <!-- row -->
            <div class="row">

                @foreach ($rootCategories->slice(0, 3) as $root)
                    <!-- shop -->
                    <div class="col-md-4 col-xs-6">
                        <a href="{{ route('productByCategory', $root->slug) }}">
                            <div class="shop">
                                <div class="shop-img">
                                    <img src="{{ asset('storage/images/' . $root_image[$root->name]) }}" alt=""
                                        style="height:300px">
                                </div>
                                <div class="shop-body">
                                    <h3>{{ $root->name }}<br>Collection</h3>
                                    <a href="{{ route('productByCategory', $root->slug) }}" class="cta-btn">Shop now <i
                                            class="fa fa-arrow-circle-right"></i></a>
                                </div>
                            </div>
                        </a>
                    </div>
                    <!-- /shop -->
                @endforeach


            </div>
            <!-- /row -->
        </div>
        <!-- /container -->
    </div>
    <!-- /SECTION -->

    <!-- SECTION -->
    <div class="section">
        <!-- container -->
        <div class="container">
            <!-- row -->
            <div class="row">

                <!-- section title -->
                <div class="col-md-12">
                    <div class="section-title">
                        <h3 class="title">New Products</h3>
                    </div>
                </div>
                <!-- /section title -->

                <!-- Products tab & slick -->
                <div class="col-md-12">
                    <div class="row">
                        <div class="products-tabs">
                            <!-- tab -->
                            <div id="tab1" class="tab-pane active">
                                <div class="products-slick" data-nav="#slick-nav-1">
                                    @foreach ($newProducts as $product)
                                        <!-- product -->
                                        <div class="product">
                                            <a href="{{ route('product.page', $product) }}">

                                                <div class="product-img">
                                                    <img src="{{ asset('/storage/images/' . $product->image) }}"
                                                        alt="">
                                                    @if ($product->status == 0)
                                                        <div class="product-label">
                                                            <span class="new">OUT OF STOCK</span>
                                                        </div>
                                                    @else
                                                        <div class="product-label">
                                                            <span class="new">NEW</span>
                                                        </div>
                                                    @endif
                                                </div>
                                                <div class="product-body">
                                                    <p class="product-category">
                                                        {{ $product->category->name }}</p>
                                                    <h3 class="product-name"><a
                                                            href="{{ route('product.page', $product) }}">{{ Str::limit($product->name, 20) }}</a>
                                                    </h3>
                                                    <h4 class="product-price">
                                                        {{ number_format($product->unit_price, 2) }}
                                                    </h4>
                                                </div>
                                            </a>
                                        </div>
                                        <!-- /product -->
                                    @endforeach

                                </div>
                                <div id="slick-nav-1" class="products-slick-nav"></div>
                            </div>
                            <!-- /tab -->
                        </div>
                    </div>
                </div>
                <!-- Products tab & slick -->
            </div>
            <!-- /row -->
        </div>
        <!-- /container -->
    </div>
    <!-- /SECTION -->



    <!-- SECTION -->
    <div class="section">
        <!-- container -->
        <div class="container">
            <!-- row -->
            <div class="row">

                <!-- section title -->
                <div class="col-md-12">
                    <div class="section-title">
                        <h3 class="title">Top selling</h3>
                    </div>
                </div>
                <!-- /section title -->

                <!-- Products tab & slick -->
                <div class="col-md-12">
                    <div class="row">
                        <div class="products-tabs">
                            <!-- tab -->
                            <div id="tab2" class="tab-pane fade in active">
                                <div class="products-slick" data-nav="#slick-nav-2">
                                    @foreach ($topProd as $product)
                                        <!-- product -->
                                        <div class="product">
                                            <a href="{{ route('product.page', $product) }}">
                                                <div class="product-img">
                                                    <img src="{{ asset('storage/images/' . $product->image) }}"
                                                        alt="">
                                                    @if ($product->status == 0)
                                                        <div class="product-label">
                                                            <span class="new">Out of Stock</span>
                                                        </div>
                                                @endif
                                                </div>
                                                <div class="product-body">
                                                    <p class="product-category">
                                                        {{ $product->category->name }}</p>
                                                    <h3 class="product-name"><a
                                                            href="{{ route('product.page', $product) }}">{{ Str::limit($product->name, 20) }}</a>
                                                    </h3>
                                                    <h4 class="product-price">
                                                        {{ number_format($product->unit_price, 2) }}
                                                    </h4>
                                                </div>
                                            </a>
                                        </div>
                                        <!-- /product -->
                                    @endforeach
                                </div>
                                <div id="slick-nav-2" class="products-slick-nav"></div>
                            </div>
                            <!-- /tab -->
                        </div>
                    </div>
                </div>
                <!-- /Products tab & slick -->
            </div>
            <!-- /row -->
        </div>
        <!-- /container -->
    </div>
    <!-- /SECTION -->

    <div class="section">
        <!-- container -->
        <div class="container">
            <!-- row -->
            <div class="row">
                <!-- section title -->
                <div class="col-md-12">
                    <div class="section-title">
                        <h3 class="title">Shop By Category</h3>
                    </div>
                </div>
                <!-- /section title -->
                @foreach ($unique_product as $product)
                    <!-- shop -->
                    <a href="{{ route('productByCategory', $product->category->slug) }}">
                        <div class="col-md-3 col-xs-6">
                            <div class="product">
                                <div class="product-body">

                                    <div class="product-img">
                                        <img src="{{ 'storage/images/' . $product->image }}" alt="">
                                    </div>
                                    <div class="product-name">
                                        <h5><a href="{{ route('productByCategory', $product->category->slug) }}">{{ $product->category->name }}</a></h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                    <!-- /shop -->
                @endforeach


            </div>
            <!-- /row -->
        </div>
        <!-- /container -->
    </div>
    {{-- {{-- <!-- /SECTION --> --}}
    <div class="container text-center">

        <div class="section-title">
            <div class="title"><a class="primary-btn" href="{{ route('store') }}">Browse All Products</a>
            </div>
        </div>
    </div>

@endsection
