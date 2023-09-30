<?php

namespace App\Http\Requests\Box;

use Illuminate\Foundation\Http\FormRequest;

class StoreBoxRequest extends FormRequest
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
            'title' => ['required', 'max:80'],
            'size' => ['required', 'integer', 'min::0'],
            'price' => ['required', 'numeric', 'min:0'],
            'delivery_id' => ['required', 'exists:deliveries,id'],
            'methodPayment' => ['nullable', 'string'],
        ];
    }

}
