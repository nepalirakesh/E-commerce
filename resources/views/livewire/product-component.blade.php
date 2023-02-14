<div>
    <!-- product -->
    @foreach ($products as $product)
        <div class="col-md-4 col-xs-6">
            <div class="product">
                <div class="product-img">
                    <img src="./img/product01.png" alt="">
                    <div class="product-label">
                        <span class="sale">-30%</span>
                        <span class="new">NEW</span>
                    </div>
                </div>
                <div class="product-body">
                    <p class="product-category">Category</p>
                    <h3 class="product-name"><a href="#">{{ $product->name }}</a></h3>
                    <h4 class="product-price">Rs {{ $product->unit_price }} </h4>
                    <input class="mb-2 border-2 rounded" type="number" min="1" wire:model="quantity">


                    <div class="product-btns">
                        <button class="quick-view"><i class="fa fa-eye"></i><span class="tooltipp">quick
                                view</span></button>
                    </div>
                </div>
                <div class="add-to-cart">
                    <button wire:click="addToCart" class="add-to-cart-btn"><i class="fa fa-shopping-cart"></i> add to
                        cart</button>
                </div>
            </div>
        </div>
    @endforeach
    <!-- /product -->
</div>
