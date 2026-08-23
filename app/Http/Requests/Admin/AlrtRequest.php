<?php

namespace App\Http\Requests\Admin;

class AlrtRequest extends Request
{
    public function rules(): array
    {
        return [
            'title_ar' => ['required', 'string', 'max:255'],
            'title_en' => ['required', 'string', 'max:255'],
        ];
    }

    public function messages(): array
    {
        return [
            'title_ar.required' => __('admin.alerts.validation.title_ar_required'),
            'title_ar.max'      => __('admin.alerts.validation.title_max'),
            'title_en.required' => __('admin.alerts.validation.title_en_required'),
            'title_en.max'      => __('admin.alerts.validation.title_max'),
        ];
    }
}
