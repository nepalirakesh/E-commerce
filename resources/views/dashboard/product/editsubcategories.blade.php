<!--Recursion is used to display every child-->
@if($product->category->id!==$subcategory->id)
<option value="{{ $subcategory->id }}">
    {{ count($subcategory->parents)>0 ? $subcategory->parents->implode('name','->') . '->' . $subcategory->name :
    $subcategory->name }}
</option>
@endif
@if (count($subcategory->children) > 0)
@foreach ($subcategory->children as $sub)
@include('dashboard.product.editsubcategories', ['subcategory' => $sub])
@endforeach
@endif