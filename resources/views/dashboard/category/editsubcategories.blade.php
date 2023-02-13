<!--Recursion is used to display every child-->
@if($category->id!==$subcategory->id)
<option value="{{ $subcategory->id }}"{{ $category->parent_id == $subcategory->id? 'selected' : '' }}>
    {{ count($subcategory->parents)>0 ? $subcategory->parents->implode('name','->') . '->' . $subcategory->name : $subcategory->name }}
  </option>

@if (count($subcategory->children) > 0)
    @foreach ($subcategory->children as $sub)
        @include('dashboard.category.editsubcategories', ['subcategory' => $sub])
    @endforeach
@endif
@endif