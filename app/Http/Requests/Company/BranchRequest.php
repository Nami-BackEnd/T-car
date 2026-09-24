<?php

namespace App\Http\Requests\Company;

class BranchRequest extends Request
{
    private const DAYS = [
        'saturday',
        'sunday',
        'monday',
        'tuesday',
        'wednesday',
        'thursday',
        'friday',
    ];

    public function rules(): array
    {
        return [
            'branch_type' => ['required', 'string', 'in:branch,withdrawal'],
            'name_ar' => ['required', 'string', 'max:255'],
            'name_en' => ['required', 'string', 'max:255'],
            'person_name' => ['nullable', 'string', 'max:255'],
            'person_email' => ['nullable', 'email', 'max:255'],
            'phone_code' => ['nullable', 'string', 'max:10'],
            'phone_number' => ['nullable', 'string', 'max:20'],
            'general_phone_code' => ['nullable', 'string', 'max:10'],
            'general_phone_number' => ['nullable', 'string', 'max:20'],
            'address' => ['nullable', 'string'],
            'latitude' => ['nullable', 'numeric', 'between:-90,90'],
            'longitude' => ['nullable', 'numeric', 'between:-180,180'],
            'is_airport_branch' => ['sometimes', 'boolean'],
            'is_train_station_branch' => ['sometimes', 'boolean'],
            'notes_ar' => ['nullable', 'string'],
            'notes_en' => ['nullable', 'string'],

            'airports' => ['nullable', 'array'],
            'airports.*' => ['integer', 'exists:airports,id'],
            'train_stations' => ['nullable', 'array'],
            'train_stations.*' => ['integer', 'exists:train_stations,id'],

            'working_hours' => ['nullable', 'array'],
            'working_hours.*.day' => ['required', 'string', 'in:'.implode(',', self::DAYS)],
            'working_hours.*.is_open' => ['sometimes', 'boolean'],
            'working_hours.*.from' => ['nullable', 'date_format:H:i'],
            'working_hours.*.to' => ['nullable', 'date_format:H:i'],

            'delivery_hours' => ['nullable', 'array'],
            'delivery_hours.*.day' => ['required', 'string', 'in:'.implode(',', self::DAYS)],
            'delivery_hours.*.is_open' => ['sometimes', 'boolean'],
            'delivery_hours.*.from' => ['nullable', 'date_format:H:i'],
            'delivery_hours.*.to' => ['nullable', 'date_format:H:i'],

            'driver_service' => ['sometimes', 'array'],
            'driver_service.enabled' => ['sometimes', 'boolean'],
            'driver_service.day_price' => ['nullable', 'numeric', 'min:0'],
            'driver_service.week_price' => ['nullable', 'numeric', 'min:0'],
            'driver_service.month_price' => ['nullable', 'numeric', 'min:0'],

            'child_seat_service' => ['sometimes', 'array'],
            'child_seat_service.enabled' => ['sometimes', 'boolean'],
            'child_seat_service.day_price' => ['nullable', 'numeric', 'min:0'],
            'child_seat_service.week_price' => ['nullable', 'numeric', 'min:0'],
            'child_seat_service.month_price' => ['nullable', 'numeric', 'min:0'],

            'airport_fast_delivery' => ['sometimes', 'array'],
            'airport_fast_delivery.price' => ['nullable', 'numeric', 'min:0'],

            'special_delivery_service' => ['sometimes', 'array'],
            'special_delivery_service.price' => ['nullable', 'numeric', 'min:0'],
            'special_delivery_service.distance' => ['nullable', 'numeric', 'min:0'],

            'delivery_only_prices' => ['nullable', 'array'],
            'delivery_only_prices.*.distance' => ['required', 'numeric', 'min:0'],
            'delivery_only_prices.*.price' => ['required', 'numeric', 'min:0'],

            'vacations' => ['nullable', 'array'],
            'vacations.*' => ['integer'],
        ];
    }

    public function messages(): array
    {
        return [
            'branch_type.in' => __('company.branches.validation.branch_type_in'),
            'name_ar.max' => __('company.branches.validation.name_max'),
            'name_en.max' => __('company.branches.validation.name_max'),
            'person_email.email' => __('company.branches.validation.email_invalid'),
            'latitude.between' => __('company.branches.validation.latitude_between'),
            'longitude.between' => __('company.branches.validation.longitude_between'),
        ];
    }
}
