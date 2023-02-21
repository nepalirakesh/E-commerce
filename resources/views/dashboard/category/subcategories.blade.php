<!--Recursion is used to display every child-->
<option
    value="{{ $category->id }}"{{ Request::routeIs('category.create') ? (old('parent_id') == $category->id ? 'selected' : '') : (old('category_id') == $category->id ? 'selected' : '') }}>
    {{ count($category->parents) > 0 ? $category->parents->implode('name', '->') . '->' . $category->name : $category->name }}

</option>

@if (count($category->children) > 0)
    @foreach ($category->children as $sub)
        @include('dashboard.category.subcategories', ['category' => $sub])
    @endforeach
@endif
