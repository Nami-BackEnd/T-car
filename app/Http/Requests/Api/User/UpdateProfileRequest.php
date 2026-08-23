<?php

namespace App\Http\Requests\Api\User;

class UpdateProfileRequest extends Request
{
    public function rules(): array
    {
        return [
            'name'       => ['required', 'string', 'max:255'],
            'email'      => ['required', 'email', 'max:255', 'unique:users,email,' . $this->user()?->id],
            'birth_date' => ['required', 'date', 'before:today'],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required'       => 'validation.name_required',
            'email.required'      => 'validation.email_required',
            'email.email'         => 'validation.email_invalid',
            'email.unique'        => 'validation.email_unique',
            'birth_date.required' => 'validation.birth_date_required',
            'birth_date.date'     => 'validation.birth_date_invalid',
            'birth_date.before'   => 'validation.birth_date_past',
        ];
    }
}
