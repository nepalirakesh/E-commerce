<div>
    <div class="col-md-5">

        <div class="product-details">
            <h2 class="product-name">{{$product->name}}</h2>

            <div>
                <h3 class="product-price">Rs{{$product->unit_price}}
                </h3>
                @if ($product->status == 0)
                <span class="badge" style="background-color: red">Out of Stock</span>
                @else
                <span class="badge" style="background-color:green;">In Stock</span>
                @endif
            </div>
            <p>{{$product->description}}</p><br>



            <div class="add-to-cart">
                <label for="Qty">Qty

                </label>
                <input class="mb-2 border-2 rounded" type="number" min="1" wire:model="quantity" style="width:50px"
                    max="{{$product->quantity}}">&nbsp;&nbsp;&nbsp;


                <button wire:click="addToCartinsingle" class="add-to-cart-btn"><i class="fa fa-shopping-cart"></i>
                    add to cart</button>
            </div>



            <ul class="product-links">
                <li>Category:</li>
                <li><a href="#">{{$product->category->name}}</a></li>

            </ul>



        </div>
    </div>
</div>