@extends('layouts.frontend.master')
@section('content')
    <!-- /NAVIGATION -->

    @include('layouts.frontend.sidebar')
    <!-- STORE -->
    <div id="store" class="col-md-9">
        @include('layouts.dashboard.crudmessage')

        @if (!Session::has('notAvailable'))
            <!-- store products -->
            <div class="row">
                <!-- product -->
                <div class="container" style="padding:15px; width:auto;font-size:18px;">
                    @if (isset($search))
                        <span style="font-weight:500">{{ $search }}</span>
                    @elseif(isset($selectedCategory))
                        @if (count($selectedCategory->parents))
                            @foreach ($selectedCategory->parents as $parent)
                                <span>{{ $parent->name }} &#9002</span>
                            @endforeach
                            <span style="font-weight:500">{{ $selectedCategory->name }}</span>
                        @else
                            <span style="font-weight:500">{{ $selectedCategory->name }}</span>
                        @endif
                    @elseif(isset($price_filter))
                        {{ dd($min_price) }}
                        <span style="font-weight:500">{{ $price_filter }}</span>
                    @else
                        <span style="font-weight:500">All Products</span>
                    @endif
                    <div>
                        <span class="store-qty">Showing
                            {{ $products->firstItem() }}-{{ $products->lastItem() }} of {{ $products->total() }}
                            available products</span>
                    </div>

                </div>

                @foreach ($products as $product)
                    <livewire:product-component :product='$product' />
                @endforeach

                <!-- /product -->
            </div>
            <!-- /store products -->

            <!-- store bottom filter -->
            <div class="store-filter clearfix">

                <ul class="pagination justify-content-center">
                    {!! $products->withQueryString()->links('pagination::bootstrap-4') !!}
                </ul>
            </div>
            <!-- /store bottom filter -->
        @endif
    </div>
    <!-- /STORE -->

    </div>
    <!-- /row -->
    </div>
    <!-- /container -->
    </div>
    <!-- /SECTION -->
@endsection
