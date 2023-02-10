<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoryRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => ($this->method() === "PUT") ? 'required|unique:categories,name,' . $this->category->id : 
            'required|unique:categories,name,',
            'description'=> 'required|min:20|max:300',
            'category' => 'nullable|integer',
            ];
    }
}
