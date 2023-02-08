{{-- <!-- Displaying the current category -->
<li value="{{ $category->id }}">{{ $category->name}}

    <!-- If category has children -->
    @if (count($category->children) > 0)

        <!-- Create a nested unordered list -->
        <ul>

            <!-- Loop through this category's children -->
            @foreach ($category->children as $sub)

                <!-- Call this blade file again (recursive) and pass the current subcategory to it -->
                @include('dashboard.subcategories.categories', ['category' => $sub])
        
            @endforeach
        </ul>
    @endif
</li> --}}
<option value="{{ $category->id }}">{{ $category->name }}</option>
@if (count($category->children) > 0)
    @foreach ($category->children as $sub)
        @include('dashboard.category.subcategories', ['category' => $sub])
    @endforeach
@endif
