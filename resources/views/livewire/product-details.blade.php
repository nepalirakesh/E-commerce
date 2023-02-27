<div>
    <div class="col-md-5">
        <div class="product-details">
            <h2 class="product-name">{{$product->name}}</h2>
            <div>
                <div class="product-rating">
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star-o"></i>
                </div>
                <a class="review-link" href="#">10 Review(s) | Add your review</a>
            </div>
            <div>
                <h3 class="product-price">Rs{{$product->unit_price}}
                </h3>
                <span class="product-available">In Stock</span>
            </div>
            <p>{{$product->description}}</p>

            <div class="product-options">
                <label>
                    Size
                    <select class="input-select">
                        <option value="0">X</option>
                    </select>
                </label>
                <label>
                    Color
                    <select class="input-select">
                        <option value="0">Red</option>
                    </select>
                </label>
            </div>

            <div class="add-to-cart">
                <input class="mb-2 border-2 rounded" type="number" min="1" wire:model="quantity">


                <button wire:click="addToCartinsingle" class="add-to-cart-btn"><i class="fa fa-shopping-cart"></i>
                    add to cart</button>
            </div>

            <ul class="product-btns">
                <li><a href="#"><i class="fa fa-heart-o"></i> add to wishlist</a></li>
                <li><a href="#"><i class="fa fa-exchange"></i> add to compare</a></li>
            </ul>

            <ul class="product-links">
                <li>Category:</li>
                <li><a href="#">Headphones</a></li>
                <li><a href="#">Accessories</a></li>
            </ul>

            <ul class="product-links">
                <li>Share:</li>
                <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
                <li><a href="#"><i class="fa fa-envelope"></i></a></li>
            </ul>

        </div>
    </div>
</div>