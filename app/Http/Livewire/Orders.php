<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Order;

class Orders extends Component
{
    public $userId;

    public function render()
    {
        $orders = Order::where('user_id', $this->userId)->latest()->get();
        // dd($orders);
        return view('livewire.orders', ['orders' => $orders]);
    }
}