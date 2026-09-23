<?php

namespace App\Http\Requests\Admin;

class WarrantyRequest extends Request
{
    public function rules(): array
    {
        return [
            'title_ar'   => ['required', 'string', 'max:255'],
            'title_en'   => ['required', 'string', 'max:255'],
            'content_ar' => ['required', 'string'],
            'content_en' => ['required', 'string'],
        ];
    }

    public function messages(): array
    {
        return [
            'title_ar.required'  => __('admin.warranties.validation.title_ar_required'),
            'title_ar.max'       => __('admin.warranties.validation.title_max'),
            'title_en.required'  => __('admin.warranties.validation.title_en_required'),
            'title_en.max'       => __('admin.warranties.validation.title_max'),
            'content_ar.required'=> __('admin.warranties.validation.content_ar_required'),
            'content_en.required'=> __('admin.warranties.validation.content_en_required'),
        ];
    }
}
