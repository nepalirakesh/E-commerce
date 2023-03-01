<?php

namespace App\Http\Livewire;

use App\Facades\Cart;
use App\Models\Product;
use Livewire\Component;
use Illuminate\Contracts\View\View;


class ProductDetails extends Component
{

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
        return view('livewire.product-details');
    }
    public function addToCartinsingle()
    {
        if (auth()->check()) {
            Cart::add($this->product->id, $this->product->name, $this->product->getRawOriginal('unit_price'), $this->quantity);
            session()->flash('success', 'Product added to cart.');
            $this->emit('productAddedToCart');
        } else {
            return redirect()->route('login');
        }
    }
}
