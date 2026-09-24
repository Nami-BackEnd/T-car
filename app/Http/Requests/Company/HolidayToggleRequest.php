<?php

namespace App\Http\Requests\Company;

class HolidayToggleRequest extends Request
{
    public function rules(): array
    {
        return [
            'active' => ['required', 'boolean'],
            'day_count' => ['sometimes', 'integer', 'between:1,30'],
        ];
    }
}
