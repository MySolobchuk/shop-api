<?php

namespace App\Http\Requests\Product;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => ['required', 'max:80'],
            'label' => ['nullable', 'max:80'],
            'description' => ['nullable'],
            'first_price' => ['required','numeric'],
            'price' => ['required','numeric'],
            'code' => ['required', 'integer'],
            'preview' => ['nullable'],
            'category_id' => ['nullable', 'integer', 'exists:categories,id']
        ];
    }
}
