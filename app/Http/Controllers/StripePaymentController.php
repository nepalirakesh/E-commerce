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
use App\Models\Category;
use App\Services\CartService;
use Illuminate\Support\Facades\DB;

class StripePaymentController extends Controller
{
    protected $cartService;
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

        $checkout_session = $stripe->checkout->sessions->create([
            'line_items' => $lineItems,
            'mode' => 'payment',
            'success_url' => route('checkout.success'),
            'cancel_url' => route('checkout.cancel'),
        ]);
        return redirect($checkout_session->url);
    }

    public function __construct(CartService $cartService)
    {
        $this->cartService = $cartService;
    }

    public function success()
    {
        $contents = Cart::getContent();

        $orders = Order::create([
            'user_id' => auth()->user()->id,
            // 'mobile' => "3343324",
            // 'address' =>"Kathmandu",
            'total_amount' => (float) (Cart::total()),
        ]);

        foreach ($contents as $id => $item) {
            $orderProduct = OrderProduct::create([
                'order_id' => $orders->id,
                'product_id' => $id,
                'price' => $item['price'],
                'quantity' => $item['quantity'],
            ]);

            // getting quantity from products table
            $product_quantity = DB::table('products')->where('id', $id)->value('quantity');

            $cart_quantity = $item['quantity'];

            // //subtracting products quantity from orders quantity table and updating products quantity table
            $changed_quantity = $product_quantity - $cart_quantity;
            Product::where('id', $id)->update(array('quantity' => $changed_quantity));

            if ($changed_quantity == 0) {
                Product::where('id', $id)->update(array('status' => '0'));
            }
        }

        $this->cartService->clear();

        // $user = auth()->user(); // get the authenticated user
        $myOrders = Order::where('id', $orders->id)
            ->orderBy('created_at')
            ->get();

        $this->sendEmail($myOrders);
        $categories = Category::all();
        $products = Product::latest()->paginate(12);

        return redirect()->route('home', compact('categories', 'products'))->with('success', 'Payment done');
    }

    public function sendEmail($myOrders)
    {
        Mail::to(auth()->user()->email)->send(new OrderMail($myOrders));
    }

    public function cancel()
    {
        echo "cancel ";
    }
}