@extends('layouts.frontend.master')
@section('content')
    <div class="section">
        <div class="container">
            <div class="row">
                <div class="col-md-12 order-details">
                    <div class="section-title text-center">
                        <h4 class="text-center">Your purchased product
                        </h4>
                    </div>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Product Name</th>
                                <th>Product Price</th>
                                <th>Quantity</th>
                                <th>Image</th>
                                <th>Sub Total</th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach ($orders as $myOrderItem)
                                @foreach ($myOrderItem->products as $product)
                                    <tr>
                                        <td>{{ $product->name }}</td>
                                        <td>Rs.{{ $product->orders()->where('order_id', $myOrderItem->id)->first()->pivot->price }}
                                        </td>
                                        <td> {{ $product->orders()->where('order_id', $myOrderItem->id)->first()->pivot->quantity }}
                                        </td>
                                        <td>
                                            <img src=" {{ asset("storage/images/$product->image") }}" alt=""
                                                width="50px" height="50px">
                                        </td>
                                        <td>Rs.{{ $product->orders()->where('order_id', $myOrderItem->id)->first()->pivot->price *$product->orders()->where('order_id', $myOrderItem->id)->first()->pivot->quantity }}
                                        </td>
                                    </tr>
                                @endforeach
                            @endforeach

                        </tbody>

                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
