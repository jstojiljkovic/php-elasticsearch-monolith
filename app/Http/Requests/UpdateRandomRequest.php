<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRandomRequest extends FormRequest
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
            'company' => 'nullable|string',
            'phone_number' => 'nullable|string',
            'description' => 'nullable|string',
            'type' => 'nullable|string',
            'iban' => 'nullable|string|max:34',
            'pan' => 'nullable|string',
            'cvv' => 'nullable|int',
            'expiration' => 'nullable|string',
            'hex_color' => 'nullable|string',
            'country' => 'nullable|string|max:100',
            'latitude' => 'nullable|float',
            'longitude' => 'nullable|float',
            'birthday' => 'nullable|date',
        ];
    }
}
