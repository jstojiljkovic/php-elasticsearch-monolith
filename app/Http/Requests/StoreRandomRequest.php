<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreRandomRequest extends FormRequest
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
            'company' => 'required|string',
            'phone_number' => 'required|string',
            'description' => 'nullable|string',
            'type' => 'required|string',
            'iban' => 'required|string|max:34',
            'pan' => 'required|string',
            'cvv' => 'required|int',
            'expiration' => 'required|string',
            'hex_color' => 'required|string',
            'country' => 'nullable|string|max:100',
            'latitude' => 'required|float',
            'longitude' => 'required|float',
            'birthday' => 'required|date',
        ];
    }
}
