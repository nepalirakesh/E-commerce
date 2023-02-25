<?php

namespace App\Mail;

use App\Models\Product;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Stripe\Product as StripeProduct;

class OrderMail extends Mailable
{
    use Queueable, SerializesModels;

    public $myOrders;



    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($myOrders)
    {
        $this->myOrders = $myOrders;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Order Confirmation')->view('mail');
    }
}