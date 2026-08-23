<?php

namespace App\Http\Requests\Admin;

use Illuminate\Validation\Rule;

class UserRequest extends Request
{
    public function rules(): array
    {
        $userId = $this->route('user')?->id;

        return [
            'name'         => ['nullable', 'string', 'max:255'],
            'phone_code'   => ['required', 'string', 'max:6'],
            'phone'        => ['required', 'string', 'max:20', Rule::unique('users', 'phone')->ignore($userId)],
            'email'        => ['nullable', 'email', 'max:255', Rule::unique('users', 'email')->ignore($userId)],
            'birth_date'   => ['nullable', 'date', 'before:today'],
            'balance'      => ['nullable', 'numeric', 'min:0'],
            'lang'         => ['nullable', 'in:ar,en'],
            'address_name' => ['nullable', 'string', 'max:255'],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required'       => __('admin.users.validation.name_required'),
            'name.string'         => __('admin.users.validation.name_string'),
            'name.max'            => __('admin.users.validation.name_max'),
            'phone_code.required' => __('admin.users.validation.phone_code_required'),
            'phone_code.max'      => __('admin.users.validation.phone_code_max'),
            'phone.required'      => __('admin.users.validation.phone_required'),
            'phone.max'           => __('admin.users.validation.phone_max'),
            'phone.unique'        => __('admin.users.validation.phone_unique'),
            'email.email'         => __('admin.users.validation.email_invalid'),
            'email.max'           => __('admin.users.validation.email_max'),
            'email.unique'        => __('admin.users.validation.email_unique'),
            'birth_date.date'     => __('admin.users.validation.birth_date_invalid'),
            'birth_date.before'   => __('admin.users.validation.birth_date_before'),
            'balance.numeric'     => __('admin.users.validation.balance_numeric'),
            'balance.min'         => __('admin.users.validation.balance_min'),
            'lang.in'             => __('admin.users.validation.lang_invalid'),
        ];
    }
}
