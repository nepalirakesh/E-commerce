<?php

namespace App\Http\Controllers;

use App\Mail\OrderMail;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Session;
use Stripe;
use App\Models\Product;
use App\Models\Order;
use App\Models\User;
use Illuminate\Support\Facades\Mail;



class StripePaymentController extends Controller
{
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
        $products = Product::all();

        return view('home.store', compact('products'))->with('success', 'Payment successful!');
    }

    public function checkout()
    {
        $stripe = new \Stripe\StripeClient(env('STRIPE_SECRET'));

        $products = Product::all();
        $totalPrice = 100;

        $lineItems = [];
        foreach ($products as $product) {


            $lineItems[] = [

                'price_data' => [
                    'currency' => 'npr',
                    'product_data' => [
                        'name' => $product->name,
                    ],
                    'unit_amount' => $product->price * 100,
                ],
                'quantity' => 1,


            ];
        }

        $checkout_session = $stripe->checkout->sessions->create([
            'line_items' => $lineItems,
            'mode' => 'payment',
            'success_url' => route('checkout.success'),
            'cancel_url' => route('checkout.cancel'),
        ]);

        // $orders = new Order;
        // $orders->total_price = $totalPrice;
        // $orders->status = 'unpaid';
        // $orders->session_id = $checkout_session;
        // $orders->save();

        $this->sendEmail($products);


        return redirect($checkout_session->url);
    }

    public function success()
    {
        // $email = "ecommercesince1998@gmail.com";

        // $data = ['name' => "Dipen"];
        // $user['to'] = 'ecommercesince1998@gmail.com';

        // Mail::send('mail', $data, function ($messages) use ($user) {
        //     $messages->to($user['to']);
        //     $messages->subject('testing mailer');
        // });
        echo "Success";
    }

    public function sendEmail($products)
    {
        Mail::to('dipenshakya19@gmail.com')->send(new OrderMail($products));
    }

    public function cancel()
    {
        echo "cancel ";
    }
}
