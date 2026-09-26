<?php

namespace App\Http\Requests\Company;

use App\Models\Driver;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Unique;

class DriverRequest extends Request
{
    /**
     * Normalize checkbox values so `required_if` on the branch list behaves
     * whether the field arrives as "0"/"1", true/false, or is absent.
     */
    protected function prepareForValidation(): void
    {
        $this->merge([
            'assigned_to_all_branches' => $this->filled('assigned_to_all_branches')
                ? $this->boolean('assigned_to_all_branches')
                : (bool) ($this->route('driver')?->assigned_to_all_branches ?? false),
            'is_active' => $this->filled('is_active')
                ? $this->boolean('is_active')
                : (bool) ($this->route('driver')?->is_active ?? true),
        ]);
    }

    public function rules(): array
    {
        $driver = $this->route('driver');
        $driverId = $driver instanceof Driver ? $driver->id : null;
        $companyId = $this->currentCompanyId();

        return [
            'name' => ['required', 'string', 'max:255'],
            'phone_code' => ['required', 'string', 'max:10', Rule::exists('countries', 'phone_code')],
            'phone' => ['required', 'string', 'max:20'],
            'lang' => ['nullable', 'string', Rule::in(['ar', 'en'])],
            'license_expiration_date' => ['required', 'date'],
            'identity_number' => [
                'required',
                'string',
                'max:50',
                $this->uniqueToCompany('identity_number', $driverId, $companyId),
            ],
            'email' => [
                'nullable',
                'email',
                'max:255',
                $this->uniqueToCompany('email', $driverId, $companyId),
            ],
            'password' => [$driverId ? 'nullable' : 'required', 'string', 'min:8', 'confirmed'],

            'assigned_to_all_branches' => ['sometimes', 'boolean'],
            'branches' => [
                $this->boolean('assigned_to_all_branches') ? 'nullable' : 'required',
                'array',
            ],
            'branches.*' => [
                'integer',
                Rule::exists('branches', 'id')->where(
                    fn ($query) => $query->where('company_id', $companyId)
                ),
            ],
            'is_active' => ['sometimes', 'boolean'],
        ];
    }

    public function messages(): array
    {
        return [
            'identity_number.unique' => __('company.drivers.validation.identity_number_unique'),
            'email.unique' => __('company.drivers.validation.email_unique'),
            'phone_code.exists' => __('company.drivers.validation.phone_code_invalid'),
            'branches.required' => __('company.drivers.validation.branches_required'),
        ];
    }

    private function uniqueToCompany(string $column, ?int $driverId, int $companyId): Unique
    {
        return Rule::unique(Driver::class, $column)
            ->where(fn ($query) => $query->where('company_id', $companyId))
            ->whereNull('deleted_at')
            ->ignore($driverId);
    }

    private function currentCompanyId(): int
    {
        return (int) auth('company')->id();
    }
}
