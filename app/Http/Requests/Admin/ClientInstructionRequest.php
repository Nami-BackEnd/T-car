<?php

namespace App\Http\Requests\Admin;

class ClientInstructionRequest extends Request
{
    public function rules(): array
    {
        return [
            'sections'               => ['required', 'array'],
            'sections.user'          => ['required', 'array'],
            'sections.driver'        => ['required', 'array'],
            'sections.*.content_ar'  => ['required', 'string'],
            'sections.*.content_en'  => ['required', 'string'],
        ];
    }

    public function messages(): array
    {
        return [
            'sections.required'              => 'validation.sections_required',
            'sections.array'                 => 'validation.sections_invalid',
            'sections.user.required'         => 'validation.sections_required',
            'sections.user.array'            => 'validation.sections_invalid',
            'sections.driver.required'       => 'validation.sections_required',
            'sections.driver.array'          => 'validation.sections_invalid',
            'sections.*.content_ar.required' => 'validation.content_required',
            'sections.*.content_ar.string'   => 'validation.content_string',
            'sections.*.content_en.required' => 'validation.content_required',
            'sections.*.content_en.string'   => 'validation.content_string',
        ];
    }
}
