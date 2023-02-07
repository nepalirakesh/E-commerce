@extends('layouts.dashboard.master')
@section('title', 'All Categories')
@section('content')
    <div class="container text-center mt-5">
        <h3>Categories</h3>
        <table class="table container text-center w-75">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">SN</th>
                    <th scope="col">Name</th>
                    <th scope="col">Description</th>
                    <th scope="col">Parent</th>
                    <th scope="col">Status</th>
                    <th scope="col">Action</th>

                </tr>
            </thead>
            <tbody>
                @foreach ($categories as $category)
                    <tr>
                        <td>{{ $categories->firstItem() + $loop->index }}</td>
                        <td>{{ ucfirst($category->name) }}</td>
                        <td>{!! ucfirst(Str::limit($category->description,15)) !!}</td>
                        <td>{{$category->parent_id?$category->parent->name:'No parent'}}</td>
                        <td>{{ $category->status ? 'In Stock' : 'Out Of Stock' }}</td>

                        <td>
                            <form action="{{ route('category.delete', $category) }}" method="POST">
                                <a href="{{ route('category.show', $category) }}" class="btn btn-primary btn-xs">Show</a>
                                <a href="{{ route('category.edit', $category) }}" class="btn btn-secondary btn-xs">Edit</a>
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-xs"
                                    onclick="return confirm('Are you sure?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <ul class="pagination justify-content-center">
            {!! $categories->links('pagination::bootstrap-4') !!}
        </ul>
    </div>

@endsection
