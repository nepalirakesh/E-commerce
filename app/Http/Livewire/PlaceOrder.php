<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Facades\Cart;
use Illuminate\Support\Facades\DB;
use App\Models\Order;
use App\Models\OrderProduct;

class PlaceOrder extends Component
{
    public $mobile_number;
    public $address;
    public $name;
    public $email;

    public $total;
    public $content;
    protected $listeners = [
        'productAddedToCart' => 'updateCart',
    ];
    public function rules()
    {
        return [
            'name' => 'required|string|max:121',
            'email' => 'required|email|max:121',
            'mobile_number' => 'required|string|min:10',
            'address' => 'required|string|max:500'
        ];
    }

    public $layout = null; // Add this line to remove the layout for the component

    public function totalProductAmount()
    {

    }

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
    /**
     * placeorder() is not completed
     */
    public function placeOrder()
    {
        $this->validate();

        //     $content = Cart::getContent();
        //     // dd($content);

        $order = Order::create([
            'user_id' => auth()->user()->id,
            'mobile' => $this->mobile_number,
            'address' => $this->address,
            'status' => 'pending',
            'total_amount' => $this->total,

        ]);


        foreach ($this->content as $item) {
            $orderProduct = OrderProduct::create([
                'order_id' => $order->id,
                'product_id' => $item->id,
                'price' => $item->price,
                'quantity' => $item->quantity,
            ]);
        }

        //     Cart::clear();

        //     session()->flash('success', 'Order placed successfully.');

        //     return redirect()->route('cart');
    }
    public function render()
    {
        $this->name = auth()->user()->name;
        $this->email = auth()->user()->email;
        return view('livewire.place-order', [
            'total' => $this->total,
            'content' => $this->content,
        ]);
    }


}