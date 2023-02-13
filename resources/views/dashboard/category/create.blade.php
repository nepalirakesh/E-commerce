@extends('layouts.dashboard.master')
@section('title', 'Create Category')
@section('content')
<div class="container w-50 mt-5">
    <h3 class="text-center">Create Category</h3>
    <div class="card">
        <form class="p-3 border" action="{{ route('category.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="parent">Main Category</label>
                <select class="form-control" name="parent_id" id="parent">
                    <option disabled selected>Select Main Category</option>
                    <option value="">None</option>
                    @foreach ($rootCategories as $root)
                    @include('dashboard.category.subcategories',['category'=>$root])
                    @endforeach
                </select>
                <span style="color:red">
                    @error('parent_id')
                    {{ $message }}
                    @enderror
                </span>
            </div>
            <div class="form-group">
                <label for="title">Name</label>
                <input type="text" class="form-control" id="title" aria-describedby="emailHelp" placeholder="Enter Name"
                    name="name" value="{{ old('name') }}">
                <span style="color:red">
                    @error('name')
                    {{ $message }}
                    @enderror
                </span>
            </div>
            <div class="form-group">
                <label for="description">Description</label>
                <textarea class="form-control" name="description" id="my-editor" cols="" rows="3"
                    placeholder="Enter Description">{{ old('description') }}</textarea>
                <span style="color:red">
                    @error('description')
                    {{ $message }}
                    @enderror
                </span>
            </div>
            <div class="text-center">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </form>
    </div>
</div>
@endsection