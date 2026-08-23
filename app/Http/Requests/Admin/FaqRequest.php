<?php

namespace App\Http\Requests\Admin;

class FaqRequest extends Request
{
    public function rules(): array
    {
        return [
            'type'        => ['required', 'in:user,driver'],
            'question_ar' => ['required', 'string', 'max:255'],
            'question_en' => ['required', 'string', 'max:255'],
            'answer_ar'   => ['required', 'string'],
            'answer_en'   => ['required', 'string'],
        ];
    }

    public function messages(): array
    {
        return [
            'type.required'        => __('admin.faqs.validation.type_required'),
            'type.in'              => __('admin.faqs.validation.type_invalid'),
            'question_ar.required' => __('admin.faqs.validation.question_ar_required'),
            'question_ar.max'      => __('admin.faqs.validation.question_max'),
            'question_en.required' => __('admin.faqs.validation.question_en_required'),
            'question_en.max'      => __('admin.faqs.validation.question_max'),
            'answer_ar.required'   => __('admin.faqs.validation.answer_ar_required'),
            'answer_en.required'   => __('admin.faqs.validation.answer_en_required'),
        ];
    }
}
