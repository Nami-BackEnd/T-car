<?php

namespace App\Services\Company;

use App\Models\Bank;
use App\Models\City;
use App\Models\Company;
use App\Models\CompanyAdditionalService;
use App\Models\CompanyBankInformation;
use App\Models\CompanyService;
use App\Models\CompanyUser;
use App\Models\Country;
use App\Models\PaymentMethod;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class SettingsService
{
    public const DISK = 'public';

    public const LOGO_DIR = 'companies/logos';

    public const DOCUMENTS_DIR = 'companies/documents';

    /**
     * Everything the settings page renders, straight from the database.
     */
    public function payload(CompanyUser $user): array
    {
        $company = $user->companyProfile();

        $company->load(['country', 'city', 'bankInformation', 'paymentMethods', 'cities']);

        return [
            'company' => $company,
            'bank' => $company->bankInformation,
            'countries' => $this->countries(),
            'cities' => $this->cities(),
            'banks' => $this->banks(),
            'scopeCityIds' => $company->cities->pluck('id')->all(),
            'additionalServices' => $this->additionalServices(),
            'serviceSettings' => $this->serviceSettings($company),
            'paymentMethods' => $this->paymentMethods(),
            'selectedPaymentMethodIds' => $company->paymentMethods->pluck('id')->all(),
        ];
    }

    public function update(CompanyUser $user, array $data): Company
    {
        $company = $user->companyProfile();

        return DB::transaction(function () use ($company, $data) {
            $company->fill($this->companyData($data));

            $this->storeFiles($company, $data);

            $company->save();

            $company->cities()->sync($data['cities']);

            $this->syncBank($company, $data);
            $this->syncPaymentMethods($company, $data);
            $this->syncServices($company, $data);

            return $company->refresh();
        });
    }

    private function companyData(array $data): array
    {
        return [
            'company_name_ar' => $data['company_name_ar'],
            'company_name_en' => $data['company_name_en'],
            'admin_name' => $data['admin_name'],
            'email' => $data['email'],
            'phone' => $data['phone'],
            'phone_code' => $data['phone_code'],
            'license_category' => $data['license_category'] ?? null,
            'branch_count' => $data['branch_count'],
            'max_late_hours_allowed' => $data['max_late_hours_allowed'],
            'insurance_policy_type' => $data['insurance_policy_type'],
            'insurance_policy_value' => $data['insurance_policy_value'] ?? null,
            'address' => $data['address'],
            'city_id' => $data['city_id'],
            'country_id' => $data['country_id'],
            'latitude' => $data['latitude'] ?? null,
            'longitude' => $data['longitude'] ?? null,
            'commercial_record' => $data['commercial_record'],
            'tax_number' => $data['tax_number'],
        ];
    }

    private function storeFiles(Company $company, array $data): void
    {
        $this->replaceFile(
            $company,
            $data['logo'] ?? null,
            (bool) ($data['remove_logo'] ?? false),
            'logo',
            self::LOGO_DIR
        );

        $this->replaceFile(
            $company,
            $data['commercial_image'] ?? null,
            (bool) ($data['remove_commercial_image'] ?? false),
            'commercial_image',
            self::DOCUMENTS_DIR
        );

        $this->replaceFile(
            $company,
            $data['tax_image'] ?? null,
            (bool) ($data['remove_tax_image'] ?? false),
            'tax_image',
            self::DOCUMENTS_DIR
        );
    }

    private function replaceFile(
        Company $company,
        ?UploadedFile $upload,
        bool $remove,
        string $attribute,
        string $directory,
    ): void {
        $current = $company->{$attribute};

        if ($upload) {
            if ($current) {
                $this->delete($current);
            }

            $company->{$attribute} = $upload->store($directory, self::DISK);

            return;
        }

        if ($remove && $current) {
            $this->delete($current);
            $company->{$attribute} = null;
        }
    }

    private function delete(string $path): void
    {
        if (Storage::disk(self::DISK)->exists($path)) {
            Storage::disk(self::DISK)->delete($path);
        }
    }

    private function syncBank(Company $company, array $data): void
    {
        CompanyBankInformation::updateOrCreate(
            ['company_profile_id' => $company->id],
            [
                'account_owner_name' => $data['account_owner_name'],
                'bank_name' => $data['bank_name'],
                'iban_number' => $data['iban_number'],
                'account_number' => $data['account_number'],
            ]
        );
    }

    private function syncPaymentMethods(Company $company, array $data): void
    {
        $company->paymentMethods()->sync($data['payment_methods'] ?? []);
    }

    private function syncServices(Company $company, array $data): void
    {
        $services = $data['services'] ?? [];

        $selected = CompanyAdditionalService::query()
            ->whereIn('id', array_column($services, 'id'))
            ->pluck('id');

        CompanyService::query()
            ->where('company_id', $company->id)
            ->whereNotIn('company_additional_services_id', $selected)
            ->delete();

        foreach ($services as $service) {
            $pricingType = $service['pricing_type'];

            CompanyService::updateOrCreate(
                [
                    'company_id' => $company->id,
                    'company_additional_services_id' => $service['id'],
                ],
                [
                    'pricing_type' => $pricingType,
                    'price' => $pricingType === 'payed' ? ($service['price'] ?? null) : null,
                ]
            );
        }
    }

    private function serviceSettings(Company $company): Collection
    {
        return $company->services()
            ->get()
            ->keyBy('company_additional_services_id');
    }

    private function countries(): Collection
    {
        return Country::query()->ordered()->get(['id', 'title_ar', 'title_en', 'phone_code']);
    }

    private function cities(): Collection
    {
        return City::query()
            ->ordered()
            ->with('country:id,title_ar,title_en,phone_code')
            ->get(['id', 'title_ar', 'title_en', 'country_id', 'latitude', 'longitude']);
    }

    private function banks(): Collection
    {
        return Bank::query()->orderBy('title_en')->get(['id', 'title_ar', 'title_en']);
    }

    private function additionalServices(): Collection
    {
        return CompanyAdditionalService::query()->orderBy('id')->get(['id', 'title_ar', 'title_en', 'icon']);
    }

    private function paymentMethods(): Collection
    {
        return PaymentMethod::query()->orderBy('id')->get(['id', 'title_ar', 'title_en', 'icon']);
    }
}
