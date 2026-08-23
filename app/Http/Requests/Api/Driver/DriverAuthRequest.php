<?php

namespace App\Http\Requests\Api\Driver;

class DriverAuthRequest extends Request
{
    public function rules(): array
    {
        return [
            'phone_code' => ['required', 'in:966'],
            'phone'      => ['required', 'string', 'regex:/^(\+?966|0)?5\d{8}$/'],
            'password'   => ['required', 'string', 'min:6'],
        ];
    }

    public function messages(): array
    {
        return [
            'phone_code.required' => __('validation.phone_code_required'),
            'phone_code.in'       => __('validation.phone_code_in'),
            'phone.required'      => __('validation.phone_required'),
            'phone.regex'         => __('validation.phone_regex'),
            'password.required'   => __('validation.password_required'),
            'password.string'     => __('validation.password_string'),
            'password.min'        => __('validation.password_min'),
        ];
    }
}
