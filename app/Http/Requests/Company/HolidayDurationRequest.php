<?php

namespace App\Http\Requests\Company;

class HolidayDurationRequest extends Request
{
    public function rules(): array
    {
        return [
            'day_count' => ['required', 'integer', 'between:1,30'],
        ];
    }
}
