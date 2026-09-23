<?php

namespace App\Http\Requests\Admin;

class SettingRequest extends Request
{
    public function rules(): array
    {
        return [
            'daily_booking_showing'           => ['boolean'],
            'monthly_booking_showing'         => ['boolean'],
            'station_booking_showing'         => ['boolean'],
            'airport_booking_showing'         => ['boolean'],
            'international_booking_showing'   => ['boolean'],
            'rewards_screen_showing'          => ['boolean'],
            'free_cancellation_time'          => ['required', 'integer', 'min:0'],
            'partial_cancellation_time'       => ['required', 'integer', 'min:0'],
            'partial_cancellation_percentage' => ['required', 'numeric', 'min:0', 'max:100'],
            'number_days_of_refund'           => ['required', 'integer', 'min:0'],
            'tax_value'                       => ['required', 'numeric', 'min:0', 'max:100'],
            'riyal_to_points_conversion'      => ['required', 'numeric', 'min:0'],
            'driver_reword_value'             => ['required', 'numeric', 'min:0'],
            'logo'                            => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp,svg', 'max:2048'],
        ];
    }

    public function messages(): array
    {
        $messages = [];

        foreach ([
            'daily_booking_showing',
            'monthly_booking_showing',
            'station_booking_showing',
            'airport_booking_showing',
            'international_booking_showing',
            'rewards_screen_showing',
        ] as $field) {
            $messages["$field.boolean"]  = 'validation.setting_boolean';
        }

        foreach ($this->rules() as $field => $rules) {
            if (in_array('boolean', $rules)) {
                continue;
            }
            if (in_array('image', $rules)) {
                $messages["$field.image"] = 'validation.logo_image';
                $messages["$field.mimes"] = 'validation.logo_mimes';
                $messages["$field.max"]   = 'validation.logo_max';
                continue;
            }
            $messages["$field.required"] = 'validation.setting_required';

            if (in_array('integer', $rules)) {
                $messages["$field.integer"] = 'validation.setting_integer';
            }

            if (in_array('numeric', $rules)) {
                $messages["$field.numeric"] = 'validation.setting_numeric';
            }

            foreach ($rules as $rule) {
                if (is_string($rule) && str_starts_with($rule, 'min:')) {
                    $messages["$field.min"] = 'validation.setting_min';
                }
                if (is_string($rule) && str_starts_with($rule, 'max:')) {
                    $messages["$field.max"] = 'validation.setting_percentage_max';
                }
            }
        }

        return $messages;
    }
}
