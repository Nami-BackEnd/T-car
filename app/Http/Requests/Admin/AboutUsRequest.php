<?php

namespace App\Http\Requests\Admin;

class AboutUsRequest extends Request
{
    public function rules(): array
    {
        return [
            'sections'               => ['required', 'array'],
            'sections.user'          => ['required', 'array'],
            'sections.driver'        => ['required', 'array'],
            'sections.*.title_ar'    => ['required', 'string', 'max:255'],
            'sections.*.title_en'    => ['required', 'string', 'max:255'],
            'sections.*.content_ar'  => ['required', 'string'],
            'sections.*.content_en'  => ['required', 'string'],
        ];
    }

    public function messages(): array
    {
        return [
            'sections.required'            => 'validation.sections_required',
            'sections.array'               => 'validation.sections_invalid',
            'sections.user.required'       => 'validation.sections_required',
            'sections.user.array'          => 'validation.sections_invalid',
            'sections.driver.required'     => 'validation.sections_required',
            'sections.driver.array'        => 'validation.sections_invalid',
            'sections.*.title_ar.required' => 'validation.title_required',
            'sections.*.title_ar.string'   => 'validation.title_string',
            'sections.*.title_ar.max'      => 'validation.title_max',
            'sections.*.title_en.required' => 'validation.title_required',
            'sections.*.title_en.string'   => 'validation.title_string',
            'sections.*.title_en.max'      => 'validation.title_max',
            'sections.*.content_ar.required' => 'validation.content_required',
            'sections.*.content_ar.string'   => 'validation.content_string',
            'sections.*.content_en.required' => 'validation.content_required',
            'sections.*.content_en.string'   => 'validation.content_string',
        ];
    }
}
