{{-- <div class="w-1/4">
    <div class="p-5 mx-2 my-2 max-w-md rounded border-2">
        @if ($content->count() > 0)
            @foreach ($content as $id => $item)
                <p class="text-2xl text-right mb-2">
                    <button
                        class="text-sm p-2 border-2 rounded border-gray-200 hover:border-gray-300 bg-gray-200 hover:bg-gray-300"
                        wire:click="updateCartItem({{ $id }}, 'minus')"> - </button>
                    {{ $item->get('name') }} x {{ $item->get('quantity') }}
                    <button
                        class="text-sm p-2 border-2 rounded border-gray-200 hover:border-gray-300 bg-gray-200 hover:bg-gray-300"
                        wire:click="updateCartItem({{ $id }}, 'plus')"> + </button>
                    <button
                        class="text-sm p-2 border-2 rounded border-red-500 hover:border-red-600 bg-red-500 hover:bg-red-600"
                        wire:click="removeFromCart({{ $id }})">Remove
                    </button>
                </p>
            @endforeach
            <hr class="my-2">
            <button class="w-full p-2 border-2 rounded border-red-500 hover:border-red-600 bg-red-500 hover:bg-red-600"
                wire:click="clearCart">Clear Cart</button>
            <div class="cart-summary">
                <small>{{ $content->count() }} Item(s) selected</small>
                <h5>TOTAL: ${{ $total }}</h5>
            </div>
            <div class="cart-btns">
                <a href="{{ url('/cart') }}">View Cart</a>
                <a href="">Checkout <i class="fa fa-arrow-circle-right"></i></a>
            </div>
        @else
            <p class="text-3xl text-center mb-2">cart is empty!</p>
        @endif
    </div>
</div> --}}

<div class="">
    @if ($content->count() > 0)
        @foreach ($content as $id => $item)
            <div class="product-widget">
                <div class="product-img">
                    <img src="/img/product02.png" alt="">
                </div>
                <div class="product-body">
                    <h3 class="product-name"><a href="#">{{ $item->get('name') }}</a>
                    </h3>
                    <h4 class="product-price"><span
                            class="qty">{{ $item->get('quantity') }}x</span>Rs.{{ $item->get('price') }}
                    </h4>
                    <button
                        class="text-sm p-2 border-2 rounded border-gray-200 hover:border-gray-300 bg-gray-200 hover:bg-gray-300"
                        wire:click="updateCartItem({{ $id }}, 'minus')"> - </button>
                    <button
                        class="text-sm p-2 border-2 rounded border-gray-200 hover:border-gray-300 bg-gray-200 hover:bg-gray-300"
                        wire:click="updateCartItem({{ $id }}, 'plus')"> + </button>

                </div>
                <button class="delete" wire:click="removeFromCart({{ $id }})"><i
                        class="fa fa-close"></i></button>
            </div>
        @endforeach
        <button class="w-full p-2 border-2 rounded border-red-500 hover:border-red-600 bg-red-500 hover:bg-red-600"
            wire:click="clearCart">Clear Cart</button>
        <div class="cart-summary">
            <small>{{ $content->count() }} Item(s) selected</small>
            <h5>TOTAL: Rs.{{ $total }}</h5>
        </div>
        <div class="cart-btns">
            <a href="{{ route('cart') }}">View Cart</a>
            <a href="{{ route('checkout') }}">Checkout <i class="fa fa-arrow-circle-right"></i></a>
        </div>
    @else
        <p class="text-3xl text-center mb-2">cart is empty!</p>
    @endif
