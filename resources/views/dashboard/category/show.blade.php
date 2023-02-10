@extends('layouts.dashboard.master')
@section('title', $category->name)
@section('content')
    <div class="container mt-5">
        <h3 class="text-center">Category</h3>
        <div class="container border border-dark p-2 w-50">
            <h5> {{ $category->name }}</h5>
            <hr>
            <p>{{ $category->description }}</p>

            <hr>
            <div>
                <span>Parent Category :</span>
                @if ($category->parent)
                     <span class="p-1"><a href="{{ route('category.show', $category->parent) }}">{{ $category->parent->name }}</a></span>
                     @else
                    <span>None</span>
                @endif
            </div>
            <div>
                <span>Sub Categories :</span>
                @if (count($category->children)>0)
                    @foreach ($category->children as $children)
                        <span class="p-1"><a href="{{ route('category.show', $children) }}">{{ $children->name }}</a></span>
                    @endforeach
                @else
                    <span>None</span>
                @endif
            </div>


        </div>
        <div class="container text-center p-2 w-50">
            <form action="{{ route('category.delete', $category) }}" method="POST">
                @csrf
                @method('DELETE')
                <a href="{{ route('category.index') }}" class="btn btn-primary btn-sm">Index</a>
                <a href="{{ route('category.edit', $category) }}" class="btn btn-secondary btn-sm">Edit</a>
                <button class="btn btn-danger btn-sm" type="submit"
                    onclick="return confirm('Are you sure?')">Delete</button>
            </form>
        </div>
    </div>
@endsection
