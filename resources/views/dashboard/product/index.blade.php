@extends('layouts.dashboard.master')
@section('title', 'Index Product')
@section('content')

    <div class="content-wrapper">
        <div class="content-header">

            @include('layouts.dashboard.crudmessage')
            <div class="container-fluid px-4">
                <div class="card">
                    <div class="card-header">
                        <h3>Products</h3>

                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="card-body">
                                <table class="table table-bordered display " id="products-table">
                                    {{-- <table class="table container table-bordered w-75 text-center" style="table-layout: fixed">
                            --}}
                                    <thead class="">
                                        <tr>
                                            <th scope="col">SN</th>
                                            <th scope="col">Name</th>
                                            <th scope="col">Description</th>
                                            <th scope="col">Category</th>
                                            <th scope="col">Image</th>
                                            <th scope="col">Quantity</th>
                                            <th scope="col">Price</th>
                                            <th scope="col">Manage</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($products as $product)
                                            <tr>
                                                <td>{{ $product->id }}</td>
                                                <td>{{ ucfirst($product->name) }}</td>
                                                <td>{{ Str::limit($product->description, 25) }}</td>
                                                <td>{{ ucfirst($product->category->name) }}</td>
                                                <td>
                                                    <img src=" {{ asset("storage/images/$product->image") }}" alt=""
                                                        width="50px" height="50px">
                                                </td>
                                                <td>{{ $product->quantity }}</td>
                                                <td>{{ $product->unit_price }}</td>
                                                <td>
                                                    <form action="{{ route('product.delete', $product) }}" method="POST">
                                                        <a href="{{ route('product.show', $product) }}"
                                                            class="btn btn-primary btn-sm">Show</a>
                                                        <a href="{{ route('product.edit', $product) }}"
                                                            class="btn btn-secondary btn-sm">Edit</a>
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger btn-sm"
                                                            onclick="return confirm('Are you sure?')">Delete</button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                {{ $products->links() }}

                            </div>
                        </div>

                    </div>
                </div>

            </div>
        @endsection
