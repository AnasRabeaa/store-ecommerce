<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class shippingsRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'id' => 'required |exists:settings',
            'value' => 'required',
            'plain_value' => 'nullable|numeric'
        ];
    }

    //Messages For Validation Errors
    public function messages()
    {
        return [
            'value_plain.numeric' => 'Insert A Number For Shipping Value',
        ];
    }
}
