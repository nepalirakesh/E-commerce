@extends('layouts.frontend.master')
@section('content')
<!-- /NAVIGATION -->
@if (Session::has('success'))
<div class="alert alert-success text-center mt-5">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
    <p>{{ Session::get('success') }}</p>
</div>
@endif
@include('layouts.frontend.sidebar')
<!-- STORE -->
<div id="store" class="col-md-9">
    <!-- store top filter -->
    <div class="store-filter clearfix">
        <div class="store-sort">
            <label>
                Sort By:
                <select class="input-select">
                    <option value="0">Popular</option>
                    <option value="1">Position</option>
                </select>
            </label>

            <label>
                Show:
                <select class="input-select">
                    <option value="0">20</option>
                    <option value="1">50</option>
                </select>
            </label>
        </div>
        <ul class="store-grid">
            <li class="active"><i class="fa fa-th"></i></li>
            <li><a href="#"><i class="fa fa-th-list"></i></a></li>
        </ul>
    </div>
    <!-- /store top filter -->
    @if (Session::has('notAvailable'))
    <p class="text-center">{{ Session::get('notAvailable') }}</p>
    @else
    <!-- store products -->
    <div class="row">

        <!-- product -->

        <h1 class="text-center">
            {{-- {{ isset($selectedCategory) ? $selectedCategory->name : 'All Products' }} --}}
            @if(isset($selectedCategory))
            {{$selectedCategory->name}}
            @elseif(isset($search))
            {{$search}}
            @elseif(isset($price_filter))
            {{$price_filter}}
            @else
            {{'All Products'}}
            @endif
        </h1>
        @foreach ($products as $product)
        <livewire:product-component :product='$product' />
        @endforeach
        @endif




        <!-- /product -->
    </div>
    <!-- /store products -->

    <!-- store bottom filter -->
    <div class="store-filter clearfix">
        <span class="store-qty">Showing {{ $products->count() }}-{{ $products->total() }}
            products</span>
        <ul class="pagination justify-content-center">
            {!! $products->withQueryString()->links('pagination::bootstrap-4') !!}
        </ul>
    </div>
    <!-- /store bottom filter -->
</div>
<!-- /STORE -->
</div>
<!-- /row -->
</div>
<!-- /container -->
</div>
<!-- /SECTION -->

<!-- NEWSLETTER -->
<div id="newsletter" class="section">
    <!-- container -->
    <div class="container">
        <!-- row -->
        <div class="row">
            <div class="col-md-12">
                <div class="newsletter">
                    <p>Sign Up for the <strong>NEWSLETTER</strong></p>
                    <form>
                        <input class="input" type="email" placeholder="Enter Your Email">
                        <button class="newsletter-btn"><i class="fa fa-envelope"></i> Subscribe</button>
                    </form>
                    <ul class="newsletter-follow">
                        <li>
                            <a href="#"><i class="fa fa-facebook"></i></a>
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-twitter"></i></a>
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-instagram"></i></a>
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-pinterest"></i></a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- /row -->
    </div>
    <!-- /container -->
</div>
<!-- /NEWSLETTER -->
@endsection