<?php

namespace App\Http\Livewire;

use App\Facades\Cart;
use App\Models\Product;
use App\Services\CartService;
use Livewire\Component;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;

class ProductDetails extends Component
{
    public $content;
    public $product;
    public $quantity;

    /**
     * Mounts the component on the template.
     *
     * @return void
     */
    public function mount(): void
    {
        $this->quantity = 1;
    }

    public function render()
    {
        $contents = Cart::getContent();

        return view('livewire.product-details', compact('contents'));
    }

    public function addToCartinsingle()
    {
        if (Auth::guest()) {
            session()->put('intendedAction', 'addToCartinsingle');
            redirect()->setIntendedUrl(url()->previous());
            return redirect()->route('login');
        } else {
            $cartContent = Cart::getContent();
            $productQtyOnCart = $cartContent->has($this->product->id) ? $cartContent->get($this->product->id)->get('quantity') : 0;

            if (($this->product->quantity) > $productQtyOnCart) {
                Cart::add($this->product->id, $this->product->name, $this->product->getRawOriginal('unit_price'), 1);
                $this->emit('productAddedToCart');
                session()->flash('success', 'Product added to cart.');
            } else {
                session()->flash('fail', 'You can not order more than' . ' ' . $this->product->quantity . ' ' . 'quantity');
            }
        }
    }
}
