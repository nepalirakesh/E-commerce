<!-- SECTION -->
<div class="section">
    <!-- container -->
    <div class="container">
        <!-- row -->
        <div class="row">
            <!-- ASIDE -->
            <div id="aside" class="col-md-3 position-fixed" >
                <!-- aside Widget -->
                <div class="aside">
                    <h3 class="aside-title">Categories</h3>
                    <div id="mn-wrapper">
                        <div class="mn-sidebar">
                            <div class="mn-navblock">
                                <ul class="mn-vnavigation">
                                    @if (count($rootCategories) > 0)
                                        @foreach ($rootCategories as $root)
                                            @include('home.categories', ['category' => $root])
                                        @endforeach
                                    @else
                                        <p>No categories available</p>
                                    @endif
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /aside Widget -->

                <!-- aside Widget -->
                <div class="aside">
                    <h3 class="aside-title">Price</h3>

                    <form action="{{ route('product.price') }}" method="GET">
                        @csrf
                        <div class="price-filter">
                            <div id="price-slider">

                            </div>
                            <div class="input-number">
                                <input id="price-min" name="price_min" type="number" required>
                                <span class="qty-up">+</span>
                                <span class="qty-down">-</span>
                            </div>
                            <span>-</span>
                            <div class="input-number">
                                <input id="price-max" name="price_max" type="number" required>
                                <span class="qty-up">+</span>
                                <span class="qty-down">-</span>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-sm">Filter</button>
                    </form>

                </div>
                <!-- /aside Widget -->

                <!-- aside Widget -->
                <div class="aside">
                    <h3 class="aside-title">Top selling</h3>
                    @if (count($topProd) > 0)
                        @foreach ($topProd as $topProduct)
                            <div class="product-widget">
                                <a href="{{ route('product.page', $topProduct) }}">
                                    <div class="product-img">
                                        <img src="{{ asset("storage/images/$topProduct->image") }}" alt="">
                                    </div>
                                    <div class="product-body">
                                        <p class="product-category">{{ $topProduct->category->name }}</p>
                                        <h3 class="product-name"><a
                                                href="{{ route('product.page', $topProduct) }}">{{ $topProduct->name }}</a>
                                        </h3>
                                        <h4 class="product-price">Rs {{ number_format($topProduct->unit_price, 2) }}
                                        </h4>
                                    </div>
                                </a>
                            </div>
                        @endforeach
                    @else
                        <p>No products available</p>
                    @endif
                </div>
                <!-- /aside Widget -->
            </div>
            <!-- /ASIDE -->
