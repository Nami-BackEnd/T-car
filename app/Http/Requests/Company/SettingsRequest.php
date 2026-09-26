<?php

namespace App\Http\Requests\Company;

use App\Models\CompanyAdditionalService;
use App\Models\Country;
use Illuminate\Validation\Rule;

class SettingsRequest extends Request
{
    public function rules(): array
    {
        $companyId = $this->route('company')?->id ?? auth('company')->user()?->company_id;

        $serviceIds = CompanyAdditionalService::query()->pluck('id')->all();
        $countryCodes = Country::query()->whereNotNull('phone_code')->pluck('phone_code')->all();

        return [
            'company_name_ar' => ['required', 'string', 'max:255'],
            'company_name_en' => ['required', 'string', 'max:255'],
            'admin_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', Rule::unique('companies', 'email')->ignore($companyId)],
            'phone_code' => ['required', 'string', Rule::in($countryCodes)],
            'phone' => ['required', 'string', 'max:255'],
            'cities' => ['required', 'array', 'min:1'],
            'cities.*' => ['integer', 'distinct', 'exists:cities,id'],
            'license_category' => ['nullable', 'string', 'max:255'],
            'branch_count' => ['required', 'integer', 'min:1'],
            'max_late_hours_allowed' => ['required', 'integer', 'min:0'],

            'insurance_policy_type' => ['required', Rule::in(['comprehensive', 'deductible'])],
            'insurance_policy_value' => ['nullable', 'required_if:insurance_policy_type,deductible', 'numeric', 'min:0', 'max:100'],

            'address' => ['required', 'string', 'max:1000'],
            'city_id' => ['required', 'integer', 'exists:cities,id'],
            'country_id' => ['required', 'integer', 'exists:countries,id'],
            'latitude' => ['nullable', 'numeric', 'between:-90,90'],
            'longitude' => ['nullable', 'numeric', 'between:-180,180'],

            'logo' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
            'remove_logo' => ['nullable', 'boolean'],

            'commercial_record' => ['required', 'string', 'max:255'],
            'commercial_image' => ['nullable', 'file', 'mimes:pdf,jpg,jpeg,png,webp', 'max:5120'],
            'remove_commercial_image' => ['nullable', 'boolean'],

            'tax_number' => ['required', 'string', 'max:255'],
            'tax_image' => ['nullable', 'file', 'mimes:pdf,jpg,jpeg,png,webp', 'max:5120'],
            'remove_tax_image' => ['nullable', 'boolean'],

            'account_owner_name' => ['required', 'string', 'max:255'],
            'bank_name' => ['required', 'string', 'max:255'],
            'iban_number' => ['required', 'string', 'max:255'],
            'account_number' => ['required', 'string', 'max:255'],

            'services' => ['nullable', 'array'],
            'services.*.pricing_type' => ['required_with:services.*', Rule::in(['free', 'payed'])],
            'services.*.price' => ['nullable', 'required_if:services.*.pricing_type,payed', 'numeric', 'min:0'],
            'services.*.id' => ['required_with:services.*', 'integer', Rule::in($serviceIds)],

            'payment_methods' => ['nullable', 'array'],
            'payment_methods.*' => ['integer', 'distinct', 'exists:payment_methods,id'],
        ];
    }

    public function messages(): array
    {
        return [
            'phone_code.in' => __('company.settings.validation.phone_code_invalid'),
            'cities.required' => __('company.settings.validation.cities_required'),
            'cities.min' => __('company.settings.validation.cities_required'),
            'insurance_policy_value.required_if' => __('company.settings.validation.insurance_value_required'),
            'services.*.pricing_type.in' => __('company.settings.validation.pricing_type_invalid'),
            'services.*.id.in' => __('company.settings.validation.service_invalid'),
        ];
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'license_category' => $this->input('license_category') ?: null,
            'latitude' => $this->input('latitude') !== '' ? $this->input('latitude') : null,
            'longitude' => $this->input('longitude') !== '' ? $this->input('longitude') : null,
            'insurance_policy_value' => $this->input('insurance_policy_type') === 'deductible'
                ? $this->input('insurance_policy_value')
                : null,
        ]);
    }
}
