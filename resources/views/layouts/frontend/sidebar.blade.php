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
                    <div class="checkbox-filter">
                        @foreach ($categories as $category)
                        <div class="input-checkbox">
                            <input type="checkbox" id={{ 'category-' . $category->id }} value={{ $category->slug }} onchange="handleSelect(event)" {{ Request::is('home/categories/' . $category->slug) ? 'checked' : '' }}>
                            <label for={{ 'category-' . $category->id }}>
                                <span></span>
                                {{ $category->slug }}
                                <small>(120)</small>
                            </label>
                        </div>
                        @endforeach

                    </div>
                </div>
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                </ul>
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
                    <h3 class="aside-title">Brand</h3>
                    <div class="checkbox-filter">
                        <div class="input-checkbox">
                            <input type="checkbox" id="brand-1">
                            <label for="brand-1">
                                <span></span>
                                SAMSUNG
                                <small>(578)</small>
                            </label>
                        </div>
                        <div class="input-checkbox">
                            <input type="checkbox" id="brand-2">
                            <label for="brand-2">
                                <span></span>
                                LG
                                <small>(125)</small>
                            </label>
                        </div>
                        <div class="input-checkbox">
                            <input type="checkbox" id="brand-3">
                            <label for="brand-3">
                                <span></span>
                                SONY
                                <small>(755)</small>
                            </label>
                        </div>
                        <div class="input-checkbox">
                            <input type="checkbox" id="brand-4">
                            <label for="brand-4">
                                <span></span>
                                SAMSUNG
                                <small>(578)</small>
                            </label>
                        </div>
                        <div class="input-checkbox">
                            <input type="checkbox" id="brand-5">
                            <label for="brand-5">
                                <span></span>
                                LG
                                <small>(125)</small>
                            </label>
                        </div>
                        <div class="input-checkbox">
                            <input type="checkbox" id="brand-6">
                            <label for="brand-6">
                                <span></span>
                                SONY
                                <small>(755)</small>
                            </label>
                        </div>
                    </div>
                </div>
                <!-- /aside Widget -->

                <!-- aside Widget -->
                <div class="aside">
                    <h3 class="aside-title">Top selling</h3>
                    @foreach($topProd as $topProduct)

                    <div class="product-widget">
                        <a href="{{route('product.page',$topProduct)}}">
                            <div class="product-img">
                                <img src="{{ asset("storage/images/$topProduct->image") }}" alt="">
                            </div>
                            <div class="product-body">
                                <p class="product-category">{{$topProduct->category->name}}</p>
                                <h3 class="product-name"><a href="{{route('product.page',$topProduct)}}">{{$topProduct->name}}</a></h3>
                                <h4 class="product-price">{{$topProduct->unit_price}}</h4>
                            </div>
                        </a>
                    </div>

                    @endforeach
                </div>
                <!-- /aside Widget -->
            </div>
            <!-- /ASIDE -->