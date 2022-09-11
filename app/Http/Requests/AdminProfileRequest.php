<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AdminProfileRequest extends FormRequest
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
            'name'  => 'required|string',
            "role_id" => 'required|numeric|exists:roles,id',
            'email'  => 'required|email|unique:admins,email,'.$this->id,
            'currentPassword'  => 'required|min:8',
            'newPassword'  => 'nullable|string|min:8',
            'confirmNewPassword'  => 'nullable|string| min:8   ',
            'photo'  => 'nullable',
            ''  => '',
            ''  => '',
            ''  => '',
        ];
    }

    public function messages() {
        return [
            'name.required' => 'Name Is Required',
            'name.string' => 'Name Should Be Text',
            'email.required' => 'Email Is Required',
            'email.email' => 'Email Should Be of Type Email',
            'currentPassword.required' => 'Current Password Is Required',
            'newPassword.min' => 'new password cant be less than 8 chars',
            'confirmNewPassword.min' => 'confirm new password cant be less than 8 chars',
            '' => '',
            '' => '',
            '' => '',
            '' => '',
            '' => '',
        ];
    }
}
