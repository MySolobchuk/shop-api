<?php

namespace App\Http\Requests\Order;

use App\Enums\Countries;
use App\Enums\Gender;
use BenSampo\Enum\Rules\EnumValue;
use Illuminate\Foundation\Http\FormRequest;

class StoreOrderRequest extends FormRequest
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
            'user_id' => ['integer', 'exists:users,id'],
            'user_information' => ['array', 'required'],
            'user_information.email' => ['required', 'string', 'email'],
            'user_information.fullname' => ['required', 'string', 'min:1'],
            'user_information.gender' => ['nullable', 'string', new EnumValue(Gender::class)],
            'user_information.agree_to_receive_information' => ['required', 'boolean'],
            'deliver_information' => ['array', 'required'],
            'deliver_information.fullname' => ['required', 'string', 'min:1'],
            'deliver_information.business' => ['required', 'string', 'min:1'],
            'deliver_information.nip_ue' => ['required', 'string'],
            'deliver_information.address' => ['required', 'string'],
            'deliver_information.zip_code' => ['required', 'string'],
            'deliver_information.country' => ['required', 'string', new EnumValue(Countries::class)],
            'deliver_information.city' => ['required', 'string'],
            'deliver_information.phone' => ['required', 'string'],
            'alt_deliver_information' => ['nullable', 'array', 'bail', 'min:8'],
            'alt_deliver_information.fullname' => ['required_with:alt_deliver_information', 'string'],
            'alt_deliver_information.business' => ['required_with:alt_deliver_information', 'string', 'min:1'],
            'alt_deliver_information.nip_ue' => ['required_with:alt_deliver_information', 'string'],
            'alt_deliver_information.address' => ['required_with:alt_deliver_information', 'string'],
            'alt_deliver_information.zip_code' => ['required_with:alt_deliver_information', 'string'],
            'alt_deliver_information.country' => ['required_with:alt_deliver_information', 'string', new EnumValue(Countries::class)],
            'alt_deliver_information.city' => ['required_with:alt_deliver_information', 'string'],
            'alt_deliver_information.phone' => ['required_with:alt_deliver_information', 'string'],
            'items' => ['array', 'required'],
            'items.*' => ['array', 'required'],
            'items.*.product_id' => ['integer', 'required', 'exists:products,id', 'distinct'],
            'items.*.count' => ['integer', 'required'],
            'confirm_regulations_store' => ['boolean', 'required'],
            'confirm_privacy_policy' => ['boolean', 'required'],
        ];
    }
}
