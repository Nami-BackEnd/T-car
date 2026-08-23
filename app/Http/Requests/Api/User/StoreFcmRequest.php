<?php

namespace App\Http\Requests\Api\User;

class StoreFcmRequest extends Request
{
    public function rules(): array
    {
        return [
            'token' => ['required', 'string'],
            'type'  => ['required', 'string'],
        ];
    }

    public function messages(): array
    {
        return [
            'token.required' => __('validation.token_required'),
            'token.string'   => __('validation.token_string'),
            'type.required'  => __('validation.fcm_type_required'),
            'type.string'    => __('validation.fcm_type_string'),
            'type.in'        => __('validation.fcm_type_in'),
        ];
    }
}
