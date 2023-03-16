@extends('layouts.dashboard.master')
@section('title', 'All Categories')
@section('content')

    <div class="content-wrapper" style="height:auto;">
        <div class="content-header">
            <div class="container-fluid px-4">
                @include('layouts.dashboard.crudmessage')
                <div class="card">
                    <div class="card-header">
                        <h3>Categories</h3>
                    </div>

                    @if (count($categories) > 0)
                        <div class="card-body">
                            <table class="table table-bordered" id="myDataTable">
                                <thead class="">
                                    <tr>
                                        <th scope="col">S.N</th>
                                        <th scope="col">Name</th>
                                        <th scope="col">Description</th>
                                        <th scope="col">Parent</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    @foreach ($categories as $category)
                                        <tr>
                                            <td>{{ $categories->firstItem() + $loop->index }}</td>
                                            <td>{{ ucfirst($category->name) }}</td>
                                            <td>{!! ucfirst(Str::limit($category->description, 15)) !!}</td>
                                            <td>{{ count($category->parents) ? $category->parents->implode('name', '/') : 'No Parent' }}
                                            </td>
                                            <td>
                                                <form action="{{ route('category.delete', $category) }}" method="POST">
                                                    <a href="{{ route('category.show', $category) }}"
                                                        class="btn btn-primary btn-xs">Show</a>
                                                    <a href="{{ route('category.edit', $category) }}"
                                                        class="btn btn-secondary btn-xs">Edit</a>
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-xs"
                                                        onclick="return confirm('Are you sure if you want to delete this category?')">Delete</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <div class="container text-center">
                                        <p> No Categories Available</p>
                                    </div>

                    @endif
                    </tbody>
                    </table>
                </div>
                <ul class="pagination justify-content-center">
                    {!! $categories->links('pagination::bootstrap-4') !!}
                </ul>
            </div>
        </div>
    </div>
    </div>
    <div>
    </div>
    </div>

@endsection
