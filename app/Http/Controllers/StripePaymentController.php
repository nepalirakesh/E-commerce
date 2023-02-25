<?php

namespace App\Http\Controllers;

use App\Mail\OrderMail;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Session;
use Stripe;
use App\Models\Product;
use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use App\Facades\Cart;



class StripePaymentController extends Controller
{
    public $userOrders;
    //API integration
    public function stripe()
    {
        return view('stripe');
    }

    public function stripepost(Request $request)
    {


        Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));

        Stripe\Charge::create([
            "amount" => 100 * 100,
            "currency" => "npr",
            "source" => $request->stripeToken,
            "description" => "My payment"
        ]);

        // Session::flash('success', 'Payment successful!');
        $orders = Order::all();

        return view('home.store', compact('products'))->with('success', 'Payment successful!');
    }

    public function checkout()
    {
        $stripe = new \Stripe\StripeClient(env('STRIPE_SECRET'));

        $contents = Cart::getContent();



        $lineItems = [];
        foreach ($contents as $item) {


            $lineItems[] = [

                'price_data' => [
                    'currency' => 'npr',
                    'product_data' => [
                        'name' => $item->get('name'),
                    ],
                    'unit_amount' => $item->get('price') * 100,
                ],
                'quantity' => $item->get('quantity'),


            ];
        }

        // $checkout_session = $stripe->checkout->sessions->create([
        //     'line_items' => $lineItems,
        //     'mode' => 'payment',
        //     'success_url' => route('checkout.success'),
        //     'cancel_url' => route('checkout.cancel'),
        // ]);

        // $orders = new Order;
        // $orders->total_price = $totalPrice;
        // $orders->status = 'unpaid';
        // $orders->session_id = $checkout_session;
        // $orders->save();



        return redirect(route('checkout.success'));
    }

    public function success()
    {
        $contents = Cart::getContent();

        $orders = Order::create([
            'user_id' => auth()->user()->id,
            // 'mobile' => "3343324",
            // 'address' =>"Kathmandu",
            'total_amount' => floatVal(Cart::total()),





        ]);
        // $orderId = $orders->id;


        foreach ($contents as $id => $item) {
            $orderProduct = OrderProduct::create([
                'order_id' => $orders->id,
                'product_id' => $id,
                'price' => $item['price'],
                'quantity' => $item['quantity'],
            ]);

        }

        // $user = auth()->user(); // get the authenticated user
        $myOrders = Order::where('id', $orders->id)
            ->orderBy('created_at')
            ->get();


        $this->sendEmail($myOrders);
    }

    public function sendEmail($myOrders)
    {
        echo "success";
        Mail::to(auth()->user()->email)->send(new OrderMail($myOrders));

    }

    public function cancel()
    {
        echo "cancel ";
    }
}