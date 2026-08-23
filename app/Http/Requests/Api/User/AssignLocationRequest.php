<?php

namespace App\Http\Requests\Api\User;

class AssignLocationRequest extends Request
{
    public function rules(): array
    {
        return [
            'latitude'  => ['required', 'numeric', 'between:-90,90'],
            'longitude' => ['required', 'numeric', 'between:-180,180'],
        ];
    }

    public function messages(): array
    {
        return [
            'latitude.required'  => 'validation.latitude_required',
            'latitude.numeric'   => 'validation.latitude_numeric',
            'latitude.between'   => 'validation.latitude_between',
            'longitude.required' => 'validation.longitude_required',
            'longitude.numeric'  => 'validation.longitude_numeric',
            'longitude.between'  => 'validation.longitude_between',
        ];
    }
}
