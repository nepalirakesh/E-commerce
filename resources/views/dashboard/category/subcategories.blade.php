<!--Recursion is used to display every child-->
<option value="{{ $category->id }}"{{ old('parent_id') == $category->id? 'selected' : '' }}>
    {{ count($category->parents)>0 ? $category->parents->implode('name','->') . '->' . $category->name : $category->name }}
  
</option>
@if (count($category->children) > 0)
    @foreach ($category->children as $sub)
        @include('dashboard.category.subcategories', ['category'=>$sub])
    @endforeach
@endif