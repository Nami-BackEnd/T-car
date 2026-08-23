<?php

namespace App\Http\Requests\Api\User;

class VerifyOtpRequest extends Request
{
    public function rules(): array
    {
        return [
            'phone_code' => ['required', 'in:966'],
            'phone'      => ['required', 'string', 'regex:/^(\+?966|0)?5\d{8}$/'],
            'otp'        => ['required', 'string', 'size:4'],
            'otp_type'       => ['required', 'string', 'in:login,change_phone'],

        ];
    }

    public function messages(): array
    {
        return [
            'phone_code.required' => __('validation.phone_code_required'),
            'phone_code.in'       => __('validation.phone_code_in'),
            'phone.required'      => __('validation.phone_required'),
            'phone.regex'         => __('validation.phone_regex'),
            'otp.required'        => __('validation.otp_required'),
            'otp.string'          => __('validation.otp_string'),
            'otp.size'            => __('validation.otp_size'),
            'otp_type.required'   => __('validation.otp_type_required'),
            'otp_type.string'     => __('validation.otp_type_string'),
            'otp_type.in'         => __('validation.otp_type_in'),
        ];
    }
}
