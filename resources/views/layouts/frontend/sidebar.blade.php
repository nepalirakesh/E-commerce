<!-- SECTION -->
<div class="section">
    <!-- container -->
    <div class="container">
        <!-- row -->
        <div class="row">
            <!-- ASIDE -->
            <div id="aside" class="col-md-3">
                <!-- aside Widget -->
                <div class="aside">
                    <h3 class="aside-title">Categories</h3>
                    <div id="mn-wrapper">
                        <div class="mn-sidebar">
                            <div class="mn-navblock">
                                <ul class="mn-vnavigation">
                                    @foreach (App\Models\Category::getRootCategories() as $root)
                                        @include('home.categories', ['category' => $root])
                                    @endforeach
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
                    @foreach (App\Models\Product::getTopProducts() as $topProduct)
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
                                    <h4 class="product-price">Rs {{ number_format($topProduct->unit_price, 2) }}</h4>
                                </div>
                            </a>
                        </div>
                    @endforeach
                </div>
                <!-- /aside Widget -->
            </div>
            <!-- /ASIDE -->
