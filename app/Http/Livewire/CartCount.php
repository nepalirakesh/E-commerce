<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Services\CartService;

class CartCount extends Component
{
    public $count;

    public function mount(CartService $cartService)
    {
        $this->count = $cartService->count();
    }

    public function render()
    {
        return view('livewire.cart-count');
    }

    protected $listeners = [
        'productAddedToCart' => 'updateCount',
    ];

    public function updateCount(CartService $cartService)
    {
        $this->count = $cartService->count();
        $this->emit('productAddedToCart');

    }
}