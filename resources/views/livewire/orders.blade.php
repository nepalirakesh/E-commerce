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
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($orders as $order)
                                    <tr>
                                        <th scope="row">{{ $loop->iteration }}</th>
                                        <td>{{ $order->status }}</td>
                                        <td>{{ $order->payment_status }}</td>
                                        <td>{{ $order->created_at }}</td>
                                        <td>{{ $order->total_amount }}</td>
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