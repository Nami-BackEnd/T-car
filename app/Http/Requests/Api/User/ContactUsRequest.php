<?php

namespace App\Http\Requests\Api\User;

class ContactUsRequest extends Request
{
    public function rules(): array
    {
        return [
            'name'         => ['required', 'string', 'max:255'],
            'email'        => ['required', 'email', 'max:255'],
            'reason'       => ['nullable', 'string', 'max:255'],
            'order_number' => ['nullable', 'string', 'max:255'],
            'message'      => ['nullable', 'string'],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required'       => 'validation.name_required',
            'name.string'         => 'validation.name_string',
            'name.max'            => 'validation.name_max',
            'email.required'      => 'validation.email_required',
            'email.email'         => 'validation.email_invalid',
            'email.max'           => 'validation.email_max',
            'reason.string'       => 'validation.reason_string',
            'reason.max'          => 'validation.reason_max',
            'order_number.string' => 'validation.order_number_string',
            'order_number.max'    => 'validation.order_number_max',
            'message.string'      => 'validation.message_string',
        ];
    }
}
