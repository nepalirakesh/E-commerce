<div>
    <div class="col-md-5">
        @if ($message = Session::get('success'))
            <div class="alert alert-success alert-block">
                <button type="button" class="close" data-dismiss="alert"></button>
                <strong>{{ $message }}</strong>
            </div>
        @endif

        @if ($message = Session::get('fail'))
            <div class="alert alert-danger alert-block">
                <button type="button" class="close" data-dismiss="alert"></button>
                <strong>{{ $message }}</strong>
            </div>
        @endif

        <div class="product-details">
            <h2 class="product-name">{{ $product->name }}</h2>
            <div>
                <h3 class="product-price">Rs {{ number_format($product->unit_price, 2) }}
                </h3>
                @if ($product->status !== 0)
                    <span class="badge" style="background-color:green;">In Stock</span>
                @endif
            </div>
            <p>{{ Str::limit($product->description,40) }}</p><br>
            <div class="add-to-cart">
                @if ($product->status == 0)
                    <button class="add-to-cart-btn"><i class="fa fa-shopping-cart"></i>
                        Out of Stock</button>
                @else
                    <button wire:click="addToCartinsingle" class="add-to-cart-btn"><i class="fa fa-shopping-cart"></i>
                        add to cart</button>
                @endif
            </div>
            <ul class="product-links">
                <li>Category:</li>
                <li><a href="#">{{ $product->category->name }}</a></li>

            </ul>
        </div>

    </div>
</div>
