
@if (count($category->children) > 0)
    {{-- <li class="dropdown-submenu {{Request::is('home/categories/'.$category->slug)?'active':''}}"><a href="{{route('productByCategory',$category->slug)}}">{{ $category->name }}</a> --}}
        <li class="dropdown-submenu"><a href="{{route('productByCategory',$category->slug)}}">{{ $category->name }}</a>

        <ul class="dropdown-menu">
            @foreach ($category->children as $child)
                @include('home.categories', ['category' => $child])
            @endforeach
        </ul>
    </li>
@else
    <li><a href="{{route('productByCategory',$category->slug)}}">{{ $category->name }}</a></li>
@endif
  