<?php

namespace App\Http\Requests\Api\User;

class JoinUsRequest extends Request
{
    public function rules(): array
    {
        return [
            'name'         => ['required', 'string', 'max:255'],
            'phone'        => ['required', 'string', 'max:255'],
            'company_name' => ['required', 'string', 'max:255'],
            'email'        => ['required', 'email', 'max:255'],
            'size'         => ['required', 'string', 'max:255'],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required'         => 'validation.name_required',
            'name.string'           => 'validation.name_string',
            'name.max'              => 'validation.name_max',
            'phone.required'        => 'validation.phone_required',
            'phone.string'          => 'validation.phone_string',
            'phone.max'             => 'validation.phone_max',
            'company_name.required' => 'validation.company_name_required',
            'company_name.string'   => 'validation.company_name_string',
            'company_name.max'      => 'validation.company_name_max',
            'email.required'        => 'validation.email_required',
            'email.email'           => 'validation.email_invalid',
            'email.max'             => 'validation.email_max',
            'size.required'         => 'validation.size_required',
            'size.string'           => 'validation.size_string',
            'size.max'              => 'validation.size_max',
        ];
    }
}
