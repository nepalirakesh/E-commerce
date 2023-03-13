@extends('layouts.dashboard.master')
@section('title', 'Edit' . ' ' . $category->name)
@section('content')
    <div class="content">
        <div class="content-wrapper">
            <div class="content-header">
                <div class="container-fluid px-4  w-75 mt-5">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="text-center">Edit Category</h3>
                        </div>
                        <form class="card-body" action="{{ route('category.update', $category) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label for="title">Edit Name</label>
                                <input type="text" class="form-control" id="title" aria-describedby="emailHelp"
                                    placeholder="Enter Name" name="name" value="{{ $category->name }}">
                                <span style="color:red">
                                    @error('name')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </div>
                            <div class="form-group">
                                <label for="parent">Main Category</label>
                                <select class="form-control" name="parent_id" id="parent">
                                    @foreach ($rootCategories as $root)
                                        @if ($root->id == $category->id)
                                            <option value=""selected>None</option>
                                            @continue
                                        @endif
                                        @include('dashboard.category.editsubcategories', [
                                            'subcategory' => $root,
                                            'category' => $category,
                                        ])
                                    @endforeach
                                </select>

                                <span style="color:red">
                                    @error('parent_id')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </div>
                            <div class="form-group">
                                <label for="description">Edit Description</label>
                                <textarea class="form-control" name="description" id="my-editor" cols="" rows="3"
                                    placeholder="Enter Description">{{ $category->description }}</textarea>
                                <span style="color:red">
                                    @error('description')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </div>
                            <div class="text-center">
                                <button type="submit" class="btn btn-primary">Update</button>
                            </div>
                        </form>
                    </div>
                    <div>
                    </div>
                </div>
            </div>
        @endsection
