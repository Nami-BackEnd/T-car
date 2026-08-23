<?php

namespace App\Http\Requests\Api\Driver;

class ChangeLangRequest extends Request
{
    public function rules(): array
    {
        return [
            'lang' => ['required', 'string', 'in:en,ar'],
        ];
    }

    public function messages(): array
    {
        return [
            'lang.required' => 'validation.lang_required',
            'lang.string'   => 'validation.lang_string',
            'lang.in'       => 'validation.lang_in',
        ];
    }
}
