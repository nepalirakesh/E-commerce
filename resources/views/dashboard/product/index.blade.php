@extends('layouts.dashboard.master')
@section('content')

<div class="container text-center mt-5" style="width:1000px">
    <h3>Products</h3>
    <table class="table container text-center">
        {{-- <table class="table container table-bordered w-75 text-center" style="table-layout: fixed"> --}}
            <thead class="thead-dark">
                <tr>
                    <th scope="col">SN</th>
                    <th scope="col">Name</th>
                    <th scope="col">Description</th>
                    <th scope="col">Category</th>
                    <th scope="col">Image</th>
                    <th scope="col">Price</th>
                    <th scope="col">Quantity</th>
                    <th scope="col">Manage</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($products as $product)
                <tr>
                    <td>{{ $product->id}}</td>
                    <td>{{ ucfirst($product->category_id) }}</td>
                    <td>{{ ucfirst($product->name) }}</td>
                    <td>{{$product->image}}</td>
                    <td>
                        <img src=" {{asset( " storage/images/$product->image" )}}" alt="" width="50px" height="50px">
                    </td>
                    <td>
                        <form action="{{ route('product.delete', $product) }}" method="POST">
                            <a href="{{ route('product.show', $product) }}" class="btn btn-primary btn-sm">Show</a>
                            <a href="{{ route('product.edit', $product) }}" class="btn btn-secondary btn-sm">Edit</a>
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
        {{-- <ul class="pagination justify-content-center">
            {!! $posts->links('pagination::bootstrap-4') !!}
        </ul> --}}
</div>
@endsection