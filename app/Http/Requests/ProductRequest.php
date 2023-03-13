<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;


class ProductRequest extends FormRequest
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
            'name' => ($this->method() === 'PUT') ? 'required |string | min:5 | max:40|unique:products,name,' . $this->product->id : 'required| string | min:5 | max:40 | unique:products,name',
            'image' => ($this->method() === 'PUT') ? 'mimes:jpeg,jpg,png' : 'required | mimes:jpeg,jpg,png',
            'description' => 'required | min:30 | max:1200',
            'category_id' => 'required',
            'quantity' => 'required | integer',
            'price' => 'required | numeric',
            'specifications.*.specification' => 'distinct',
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'specifications.*.specification.distinct' => 'Specification name has a duplicate value',
        ];
    }
}