@extends('layouts.frontend.master')
@section('content')
    <!-- SECTION -->
    <div class="section">
        <!-- container -->
        <div class="container">
            <!-- row -->
            <div class="row">

                <!-- Order Details -->
                <div class="col-md-12 order-details">
                    <div class="section-title text-center">
                        <h3 class="title">Your Order</h3> <br> <br>
                        <h5>Name: {{ auth()->user()->name }}</h5>
                    </div>
                    <center>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">S.N</th>
                                    <th scope="col">Order Status</th>
                                    <th scope="col">Payment Status</th>
                                    <th scope="col">Order Placed At</th>
                                    <th scope="col">Total</th>
                                    <th>Product</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($orders as $order)
                                    <tr>
                                        <td scope="row">
                                            {{ $loop->iteration }}
                                        </td>
                                        <td>{{ $order->status }}</td>
                                        <td>{{ $order->payment_status }}</td>
                                        <td>{{ $order->created_at }}</td>
                                        <td>Rs {{ number_format($order->total_amount, 2) }}</td>

                                        <td>
                                            @foreach ($order->products as $p)
                                                {{ $p->name }} <br>
                                            @endforeach
                                        </td>
                                        <td>
                                            <button class="btn btn-secondary"> <a
                                                    href="{{ url('/user-order-detail') }}/{{ $order->id }}">View
                                                    More</a></button>
                                        </td>

                                    </tr>
                                @endforeach



                            </tbody>
                        </table>
                    </center>
                </div>
                <!-- /Order Details -->
            </div>
            <!-- /row -->

        </div>
        <!-- /container -->
    </div>
    <!-- /SECTION -->
@endsection
