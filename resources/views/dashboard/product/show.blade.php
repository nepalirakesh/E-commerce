@extends('layouts.dashboard.master')
@section('title', 'Show Product')
@section('content')
    <div class="container">
        <div class="row">
            <div class="content-wrapper">
                <div class="col-10">

                    <div class="card">
                        <div class="card-header text-center">
                            <h5> {{ ucfirst($product->name) }}</h5>
                        </div>
                        <div class="card-body text-center">
                            <img src="{{ asset("storage/images/$product->image") }}" alt="" width="500px"
                                height="300px">
                            <p class="card-text">{{ ucfirst($product->description) }}</p>
                            <hr>
                            <p><b>Price(In Rs) : </b>{{ $product->unit_price }}</p>
                            <p><b>Available Quantity : </b>{{ $product->quantity }}</p>
                            @if ($product->specification)
                                <hr>
                                <p><b>Specification</b></p>
                                @foreach ($product->specification as $spec)
                                    <p><b>{{ $spec->specification }} : </b>{{ $spec->value }}</p>
                                @endforeach
                            @endif
                        </div>
                    </div>
                    <div class="card-body text-center">
                        <img src="{{ asset("storage/images/$product->image") }}" alt="" width="500px"
                            height="300px">
                        <p class="card-text">{{ ucfirst($product->description) }}</p>
                        <hr>
                        <p><b>Price(In Rs):</b>{!! ucfirst($product->unit_price) !!}</p>
                        <p><b>Quantity:</b>{!! ucfirst($product->quantity) !!}</p>
                    </div>

                    <div class="card-footer text-center">
                        <form action="{{ route('product.delete', $product) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <a href="{{ route('product.index') }}" class="btn btn-primary btn-sm">Index</a>
                            <a href="{{ route('product.edit', $product) }}" class="btn btn-secondary btn-sm">Edit</a>
                            <button class="btn btn-danger btn-sm" type="submit"
                                onclick="return confirm('Are you sure?')">Delete</button>
                        </form>
                    </div>
                </div>


            </div>
            <div>
            </div>

        @endsection
