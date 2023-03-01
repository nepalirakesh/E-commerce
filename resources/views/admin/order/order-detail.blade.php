@extends('layouts.dashboard.master')
@section('title', 'Orders')



@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid px-4">
                <div class="card">
                    <div class="card-header">
                        <h4>Order Details
                        </h4>
                    </div>
                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success">{{ session('status') }}</div>
                        @endif

                        <table class="table table-bordered" id="myDataTable">
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

            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->


    </div>
    <!-- /.content-wrapper -->

@endsection
