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
                        <h4>View Orders
                        </h4>
                    </div>

                    <div class="card-body">
                        @include('layouts.dashboard.crudmessage')
                        <table class="table table-bordered" id="myDataTable">
                            <thead>
                                <tr>
                                    <th>OrderId</th>
                                    {{-- <th>Subtotal</th> --}}
                                    <th>Total</th>
                                    {{-- <th>First Name</th> --}}
                                    {{-- <th>Last Name</th> --}}
                                    {{-- <th>Mobile</th> --}}
                                    <th>Customer Details</th>
                                    <th>Order Status</th>
                                    <th>Payment Status</th>
                                    <th>Order Date</th>
                                    {{-- <th colspan=\"2\" class=\"text-center\">Action</th> --}}
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($orders as $list)
                                    <tr>
                                        <td><a
                                                href="{{ url('admin/order_detail') }}/{{ $list->id }}">{{ $list->id }}</a>
                                        </td>
                                        <td>{{ $list->total_amount }}</td>
                                        <td>
                                            {{ $list->user->name }} <br>
                                            {{ $list->user->email }}
                                        </td>
                                        <td>
                                            <form action="{{ url('admin/update-order/' . $list->id) }}" method="POST">
                                                @csrf
                                                @method('PUT')
                                                <div class="mb-3">
                                                    <select name="order_status" id="" class="">
                                                        <option {{ $list->status == 'pending' ? 'selected' : '' }}
                                                            value="pending">
                                                            Pending</option>

                                                        <option {{ $list->status == 'delivered' ? 'selected' : '' }}
                                                            value="delivered">
                                                            Delivered</option>
                                                    </select>
                                                    <span>

                                                        <button type="submit" class="btn btn-primary  btn-sm">Update Order
                                                            Status</button>
                                                    </span>
                                                </div>

                                            </form>
                                        </td>
                                        <td> {{ $list->payment_status }}</td>
                                        <td>{{ $list->created_at }}</td>
                                        {{-- <td><a href="">Details</a></td> --}}

                                        {{-- <td>{{ $list->name }}</td> --}}
                                        {{-- <td>{{ $list->email }}</td> --}}

                                    </tr>
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
