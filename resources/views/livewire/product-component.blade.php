{{-- @include('layouts.flash-message') --}}


<!-- product -->
<a href="{{ route('product.page', $product) }}">
    <div class="col-md-4 col-xs-6">
        <div class="product">

            <div class="product-img">
                <img src="{{ asset("storage/images/$product->image") }}" alt="">
                @if ($product->status == 0)
                <div class="product-label">
                    <span class="badge badge-pill badge-danger" style="background-color: red">Out Of Stock</span>
                </div>
                @endif
            </div>
            <div class="product-body">{{$product->category->name }}</p>
                <h3 class="product-name"><a href="#">{{Str::limit($product->name,20)   }}</a></h3>
                <h4 class="product-price">Rs {{ number_format($product->unit_price, 2) }} </h4>
            </div>
        </div>
    </div>
</a>
<!-- /product -->