<?php

namespace App\Http\Requests\Api\User;

class UserLicenseRequest extends Request
{
    public function rules(): array
    {
        return [
            'license' => ['required', 'file', 'mimes:jpg,jpeg,png,pdf', 'max:5120'],
        ];
    }

    public function messages(): array
    {
        return [
            'license.required' => 'validation.license_required',
            'license.file'     => 'validation.license_file',
            'license.mimes'    => 'validation.license_mimes',
            'license.max'      => 'validation.license_max',
        ];
    }
}
