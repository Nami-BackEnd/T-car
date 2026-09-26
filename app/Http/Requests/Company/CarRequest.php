<?php

namespace App\Http\Requests\Company;

use App\Models\CarDetail;
use App\Services\Company\CarService;
use Illuminate\Validation\Rule;

class CarRequest extends Request
{
    private const PRICE_FIELDS = [
        'day_price', 'day_lowest_price',
        'week_price', 'week_lowest_price',
        'month_price', 'month_lowest_price',
        'free_km_price',
    ];

    public function rules(): array
    {
        return [
            'image' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:4096'],
            'car_brand_id' => ['required', 'integer', 'exists:brands,id'],
            'car_type_id' => ['required', 'integer', 'exists:car_types,id'],
            'car_model_id' => ['required', 'integer', 'exists:car_models,id'],
            'year' => ['nullable', 'integer', 'min:1990', 'max:'.((int) now()->year + 1)],
            'note_ar' => ['nullable', 'string', 'max:2000'],
            'note_en' => ['nullable', 'string', 'max:2000'],
            'is_subscriber' => ['sometimes', 'boolean'],

            'pricing' => ['required', 'array'],
            'pricing.day_price' => ['required', 'numeric', 'min:0'],
            'pricing.day_lowest_price' => ['required', 'numeric', 'min:0'],
            'pricing.week_price' => ['required', 'numeric', 'min:0'],
            'pricing.week_lowest_price' => ['required', 'numeric', 'min:0'],
            'pricing.month_price' => ['required', 'numeric', 'min:0'],
            'pricing.month_lowest_price' => ['required', 'numeric', 'min:0'],
            'pricing.free_km' => ['required', 'integer', 'min:0'],
            'pricing.free_km_price' => ['required', 'numeric', 'min:0'],

            'subscriptions' => ['nullable', 'array'],
            'subscriptions.*.month_count' => ['required', 'integer', 'between:1,60'],
            'subscriptions.*.price' => ['required', 'numeric', 'min:0'],
            'subscriptions.*.lowest_price' => ['required', 'numeric', 'min:0'],

            'services' => ['nullable', 'array'],
            'services.*.car_additional_service_id' => ['required', 'integer', 'distinct', 'exists:car_additional_services,id'],
            'services.*.price' => ['required', 'numeric', 'min:0'],

            'branches' => ['required', 'array', 'min:1'],
            'branches.*.branch_id' => ['required', 'integer', 'distinct', 'exists:branches,id'],
            'branches.*.stock' => ['required', 'integer', 'min:0'],

            'details' => ['required', 'array'],
            'details.power' => ['nullable', 'string', Rule::in(CarDetail::POWERS)],
            'details.door_count' => ['required', 'integer', Rule::in(CarService::DOOR_COUNTS)],
            'details.has_navigation' => ['sometimes', 'boolean'],
            'details.has_bluetooth' => ['sometimes', 'boolean'],
            'details.has_panorama' => ['sometimes', 'boolean'],
            'details.has_usp' => ['sometimes', 'boolean'],
            'details.has_background_camera' => ['sometimes', 'boolean'],
            'details.has_sensors' => ['sometimes', 'boolean'],
            'details.has_apple_play' => ['sometimes', 'boolean'],
        ];
    }

    public function messages(): array
    {
        $messages = [
            'image.image' => __('company.cars.validation.image_invalid'),
            'image.max' => __('company.cars.validation.image_max'),
            'car_brand_id.required' => __('company.cars.validation.brand_required'),
            'car_brand_id.exists' => __('company.cars.validation.brand_invalid'),
            'car_type_id.required' => __('company.cars.validation.type_required'),
            'car_type_id.exists' => __('company.cars.validation.type_invalid'),
            'car_model_id.required' => __('company.cars.validation.model_required'),
            'car_model_id.exists' => __('company.cars.validation.model_invalid'),
            'year.integer' => __('company.cars.validation.year_invalid'),
            'note_ar.max' => __('company.cars.validation.note_max'),
            'note_en.max' => __('company.cars.validation.note_max'),
            'pricing.required' => __('company.cars.validation.pricing_required'),
            'subscriptions.*.month_count.between' => __('company.cars.validation.months_invalid'),
            'services.*.car_additional_service_id.exists' => __('company.cars.validation.service_invalid'),
            'branches.required' => __('company.cars.validation.branches_required'),
            'branches.min' => __('company.cars.validation.branches_required'),
            'branches.*.branch_id.exists' => __('company.cars.validation.branch_invalid'),
            'branches.*.branch_id.distinct' => __('company.cars.validation.branch_duplicate'),
            'branches.*.stock.min' => __('company.cars.validation.stock_min'),
            'details.required' => __('company.cars.validation.details_required'),
            'details.power.in' => __('company.cars.validation.power_invalid'),
            'details.door_count.in' => __('company.cars.validation.doors_invalid'),
        ];

        foreach (self::PRICE_FIELDS as $field) {
            $messages["pricing.{$field}.numeric"] = __('company.cars.validation.price_numeric');
            $messages["pricing.{$field}.min"] = __('company.cars.validation.price_min');
        }

        $messages['pricing.free_km.min'] = __('company.cars.validation.price_min');

        return $messages;
    }
}
