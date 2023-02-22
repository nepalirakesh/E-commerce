<?php

namespace App\Http\Livewire;

use App\Facades\Cart;
use Illuminate\Contracts\View\View;
use Livewire\Component;

class CartComponent extends Component
{
    protected $total;
    protected $content;
    protected $listeners = [
        'productAddedToCart' => 'updateCart',
    ];

    public $layout = null; // Add this line to remove the layout for the component

    /**
     * Mounts the component on the template.
     *
     * @return void
     */
    public function mount(): void
    {
        $this->updateCart();
    }

    /**
     * Renders the component on the browser.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function render(): View
    {
        return view('livewire.cart-component', [
            'total' => $this->total,
            'content' => $this->content,
        ]);
    }

    /**
     * Removes a cart item by id.
     *
     * @param string $id
     * @return void
     */
    public function removeFromCart(string $id): void
    {
        Cart::remove($id);
        $this->updateCart();
    }

    /**
     * Clears the cart content.
     *
     * @return void
     */
    public function clearCart(): void
    {
        Cart::clear();
        $this->updateCart();
    }

    /**
     * Updates a cart item.
     *
     * @param string $id
     * @param string $action
     * @return void
     */
    public function updateCartItem(string $id, string $action): void
    {
        Cart::update($id, $action);
        $this->updateCart();
    }

    /**
     * Rerenders the cart items and total price on the browser.
     *
     * @return void
     */
    public function updateCart()
    {
        $this->total = Cart::total();
        $this->content = Cart::content();
    }
}