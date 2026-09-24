<?php

namespace App\Http\Requests\Admin;

class ClientInstructionsRequest extends Request
{
    public function rules(): array
    {
        return [
            'content_ar' => ['required', 'string'],
            'content_en' => ['required', 'string'],
        ];
    }

    public function messages(): array
    {
        return [
            'content_ar.required' => __('admin.client_instructions.validation.content_ar_required'),
            'content_ar.string'   => __('admin.client_instructions.validation.content_string'),
            'content_en.required' => __('admin.client_instructions.validation.content_en_required'),
            'content_en.string'   => __('admin.client_instructions.validation.content_string'),
        ];
    }
}
