<?php

namespace App\Http\Livewire;

use App\Facades\Cart;
use App\Models\Product;
use Livewire\Component;
use Illuminate\Contracts\View\View;


class ProductComponent extends Component
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

    /**
     * Renders the component on the browser.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function render(): View
    {
        return view('livewire.product-component');
    }

    public function addToCart()
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