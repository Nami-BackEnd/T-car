<?php

namespace Tests\Feature;

use App\Http\Middleware\SetCompanyLocale;
use App\Models\Bank;
use App\Models\City;
use App\Models\Company;
use App\Models\CompanyAdditionalService;
use App\Models\CompanyBankInformation;
use App\Models\CompanyService;
use App\Models\CompanyUser;
use App\Models\Country;
use App\Models\PaymentMethod;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class CompanySettingsTest extends TestCase
{
    use DatabaseTransactions;

    private function actingCompanyUser(): CompanyUser
    {
        $company = Company::create([
            'company_name_ar' => 'شركة اختبار',
            'company_name_en' => 'Test Company',
            'admin_name' => 'Admin',
            'email' => 'settings-'.uniqid().'@tcar.test',
        ]);

        return CompanyUser::create([
            'company_id' => $company->id,
            'name' => 'Manager',
            'email' => 'manager-'.uniqid().'@tcar.test',
            'password' => Hash::make('12345678'),
            'phone' => '0500000000',
            'is_active' => true,
        ]);
    }

    private function lookups(): array
    {
        $country = Country::create([
            'title_ar' => 'المملكة العربية السعودية',
            'title_en' => 'Saudi Arabia',
            'phone_code' => '+966',
        ]);

        $city = City::create([
            'title_ar' => 'الرياض',
            'title_en' => 'Riyadh',
            'country_id' => $country->id,
            'latitude' => 24.7136,
            'longitude' => 46.6753,
        ]);

        $otherCity = City::create([
            'title_ar' => 'جدة',
            'title_en' => 'Jeddah',
            'country_id' => $country->id,
            'latitude' => 21.4858,
            'longitude' => 39.1925,
        ]);

        return [
            Country::create(['title_ar' => 'مصر', 'title_en' => 'Egypt', 'phone_code' => '+20']),
            City::create(['title_ar' => 'القاهرة', 'title_en' => 'Cairo', 'country_id' => $country->id]),
            $country,
            $city,
            $otherCity,
            Bank::create(['title_ar' => 'بنك البلاد', 'title_en' => 'Bank Albilad']),
            PaymentMethod::create(['title_ar' => 'تمارا', 'title_en' => 'Tamara', 'icon' => 'bi-credit-card-2-front']),
            PaymentMethod::create(['title_ar' => 'تابي', 'title_en' => 'Tabby', 'icon' => 'bi-cash-stack']),
            CompanyAdditionalService::create(['title_ar' => 'تم', 'title_en' => 'Tam', 'icon' => 'bi-check2-square']),
            CompanyAdditionalService::create(['title_ar' => 'سائق', 'title_en' => 'Driver', 'icon' => 'bi-person-plus']),
        ];
    }

    public function test_page_requires_authentication(): void
    {
        $this->get(route('company.settings'))->assertRedirect(route('company.login'));
    }

    public function test_page_renders_database_backed_data(): void
    {
        $user = $this->actingCompanyUser();
        [$otherCountry, , $country, $city, $otherCity, $bank, $tamara, , $tam, $driver] = $this->lookups();

        $this->withSession([SetCompanyLocale::SESSION_KEY => 'ar']);

        $response = $this->actingAs($user, 'company')->get(route('company.settings'));

        $response->assertOk();
        $response->assertSee('name="phone_code"', false);
        $response->assertSee('name="country_id"', false);
        $response->assertSee('name="city_id"', false);
        $response->assertSee('name="cities[]"', false);
        $response->assertSee('name="insurance_policy_type"', false);
        $response->assertSee('name="latitude"', false);
        $response->assertSee('name="services['.$tam->id.'][id]"', false);
        $response->assertSee('name="payment_methods[]"', false);

        // Values come from the database, not from hardcoded markup.
        $response->assertSee('+966');
        $response->assertSee('السعودية');
        $response->assertSee('تمارا');
        $response->assertSee('Riyadh');
        $response->assertSee('Jeddah');

        $bankOptions = trim($bank->title_en.' '.$bank->title_ar.' '.$tamara->icon.' '.$tam->icon.' '.$driver->icon.' '.$otherCity->title_en.' '.$otherCountry->title_en);
        foreach (explode(' ', $bankOptions) as $token) {
            $response->assertSee($token, false);
        }
    }

    public function test_page_localizes_arabic_and_english_titles(): void
    {
        $user = $this->actingCompanyUser();
        [, , , $city, , , $tamara, $tabby, $tam, $driver] = $this->lookups();

        $arabic = $this->withSession([SetCompanyLocale::SESSION_KEY => 'ar'])
            ->actingAs($user, 'company')
            ->get(route('company.settings'));

        $arabic->assertSee($city->title_ar);
        $arabic->assertSee($tamara->title_ar);
        $arabic->assertSee($tabby->title_ar);
        $arabic->assertSee($tam->title_ar);
        $arabic->assertSee($driver->title_ar);

        $english = $this->withSession([SetCompanyLocale::SESSION_KEY => 'en'])
            ->actingAs($user, 'company')
            ->get(route('company.settings'));

        $english->assertSee($city->title_en);
        $english->assertSee($tamara->title_en);
        $english->assertSee($tabby->title_en);
        $english->assertSee($tam->title_en);
        $english->assertSee($driver->title_en);
    }

    public function test_page_has_no_static_country_codes_or_duplicated_ids(): void
    {
        $user = $this->actingCompanyUser();
        $this->lookups();

        $html = $this->actingAs($user, 'company')
            ->get(route('company.settings'))
            ->getContent();

        // The nine hardcoded calling codes are gone.
        foreach (['+965', '+974', '+973', '+968', '+962', '+961'] as $code) {
            $this->assertStringNotContainsString('>'.$code.' <i', $html);
        }

        // No duplicated element ids inside the settings form (duplicate ids break
        // label/for wiring). The shared layout ships pre-existing duplicate
        // `clip*` ids on its inline copy-to-clipboard SVGs, so scope to the form.
        preg_match('/<form\b.*?<\/form>/s', $html, $form);
        $this->assertNotEmpty($form, 'The settings form was not rendered.');

        preg_match_all('/\sid="([^"]+)"/', $form[0], $matches);
        $ids = $matches[1];
        $duplicates = array_keys(array_filter(array_count_values($ids), fn ($count) => $count > 1));

        $this->assertSame([], $duplicates, 'Duplicate ids: '.implode(', ', $duplicates));
    }

    public function test_update_persists_company_bank_scope_services_and_payment_methods(): void
    {
        Storage::fake('public');

        $user = $this->actingCompanyUser();
        [, , $country, $city, $otherCity, , $tamara, $tabby, $tam, $driver] = $this->lookups();

        $response = $this->actingAs($user, 'company')->put(route('company.settings.update'), [
            'company_name_ar' => 'الشركة الجديدة',
            'company_name_en' => 'New Company',
            'admin_name' => 'مدير جديد',
            'email' => 'new@tcar.test',
            'phone_code' => '+966',
            'phone' => '0500000000',
            'cities' => [$city->id, $otherCity->id],
            'license_category' => 'rent',
            'branch_count' => 3,
            'max_late_hours_allowed' => 4,
            'insurance_policy_type' => 'deductible',
            'insurance_policy_value' => 10,
            'address' => 'عنوان الشركة',
            'city_id' => $city->id,
            'country_id' => $country->id,
            'latitude' => 24.7136,
            'longitude' => 46.6753,
            'logo' => UploadedFile::fake()->image('logo.png'),
            'commercial_record' => '1010792746',
            'commercial_image' => UploadedFile::fake()->create('cr.pdf', 100, 'application/pdf'),
            'tax_number' => '300000000000003',
            'tax_image' => UploadedFile::fake()->create('tax.pdf', 100, 'application/pdf'),
            'account_owner_name' => 'صاحب الحساب',
            'bank_name' => 'Bank Albilad',
            'iban_number' => 'SA6135000440137935350007',
            'account_number' => '440137935350007',
            'services' => [
                $tam->id => ['id' => $tam->id, 'pricing_type' => 'payed', 'price' => 5],
                $driver->id => ['id' => $driver->id, 'pricing_type' => 'free'],
            ],
            'payment_methods' => [$tamara->id],
        ]);

        $response->assertRedirect(route('company.settings'));

        $company = $user->companyProfile()->refresh()->load(['bankInformation', 'cities', 'paymentMethods', 'services']);

        $this->assertSame('الشركة الجديدة', $company->company_name_ar);
        $this->assertSame('New Company', $company->company_name_en);
        $this->assertSame('new@tcar.test', $company->email);
        $this->assertSame('+966', $company->phone_code);
        $this->assertSame(3, $company->branch_count);
        $this->assertSame(4, $company->max_late_hours_allowed);
        $this->assertSame('deductible', $company->insurance_policy_type);
        $this->assertSame('10.00', $company->insurance_policy_value);
        $this->assertSame('1010792746', $company->commercial_record);
        $this->assertSame('300000000000003', $company->tax_number);
        $this->assertNotNull($company->logo);
        $this->assertNotNull($company->commercial_image);
        $this->assertNotNull($company->tax_image);

        Storage::disk('public')->assertExists($company->logo);

        $this->assertCount(2, $company->cities);
        $this->assertEqualsCanonicalizing(
            [$city->id, $otherCity->id],
            $company->cities->pluck('id')->all()
        );

        $this->assertSame('صاحب الحساب', $company->bankInformation->account_owner_name);
        $this->assertSame('SA6135000440137935350007', $company->bankInformation->iban_number);

        $this->assertSame([$tamara->id], $company->paymentMethods->pluck('id')->all());

        $this->assertCount(2, $company->services);
        $this->assertSame('payed', $company->services->firstWhere('company_additional_services_id', $tam->id)->pricing_type);
        $this->assertSame('free', $company->services->firstWhere('company_additional_services_id', $driver->id)->pricing_type);
        $this->assertNull($company->services->firstWhere('company_additional_services_id', $driver->id)->price);

        $this->assertSame(1, CompanyBankInformation::where('company_profile_id', $company->id)->count());
    }

    public function test_update_removes_deselected_services(): void
    {
        $user = $this->actingCompanyUser();
        [, , $country, $city, , , $tamara, $tabby, $tam, $driver] = $this->lookups();

        $company = $user->companyProfile();

        CompanyService::create([
            'company_id' => $company->id,
            'company_additional_services_id' => $tam->id,
            'pricing_type' => 'payed',
            'price' => 5,
        ]);
        CompanyService::create([
            'company_id' => $company->id,
            'company_additional_services_id' => $driver->id,
            'pricing_type' => 'payed',
            'price' => 200,
        ]);

        $this->actingAs($user, 'company')->put(route('company.settings.update'), [
            'company_name_ar' => 'ش',
            'company_name_en' => 'S',
            'admin_name' => 'A',
            'email' => $company->email,
            'phone_code' => '+966',
            'phone' => '0500000000',
            'cities' => [$city->id],
            'branch_count' => 1,
            'max_late_hours_allowed' => 0,
            'insurance_policy_type' => 'comprehensive',
            'address' => 'عنوان',
            'city_id' => $city->id,
            'country_id' => $country->id,
            'commercial_record' => '123',
            'tax_number' => '456',
            'account_owner_name' => 'Owner',
            'bank_name' => 'Bank Albilad',
            'iban_number' => 'SA00',
            'account_number' => '0000',
            'services' => [
                $tam->id => ['id' => $tam->id, 'pricing_type' => 'free'],
            ],
            'payment_methods' => [$tamara->id, $tabby->id],
        ])->assertRedirect(route('company.settings'));

        $this->assertSame([$tam->id], CompanyService::where('company_id', $company->id)->pluck('company_additional_services_id')->all());
        $this->assertNull($company->refresh()->insurance_policy_value);
        $this->assertEqualsCanonicalizing([$tamara->id, $tabby->id], $company->paymentMethods->pluck('id')->all());
    }

    public function test_update_requires_a_city_for_the_scope(): void
    {
        $user = $this->actingCompanyUser();
        [, , $country, $city] = $this->lookups();

        $this->actingAs($user, 'company')
            ->from(route('company.settings'))
            ->put(route('company.settings.update'), [
                'company_name_ar' => 'ش',
                'company_name_en' => 'S',
                'admin_name' => 'A',
                'email' => $user->companyProfile()->email,
                'phone_code' => '+966',
                'phone' => '0500000000',
                'cities' => [],
                'branch_count' => 1,
                'max_late_hours_allowed' => 0,
                'insurance_policy_type' => 'comprehensive',
                'address' => 'عنوان',
                'city_id' => $city->id,
                'country_id' => $country->id,
                'commercial_record' => '123',
                'tax_number' => '456',
                'account_owner_name' => 'Owner',
                'bank_name' => 'Bank Albilad',
                'iban_number' => 'SA00',
                'account_number' => '0000',
            ])
            ->assertRedirect(route('company.settings'))
            ->assertSessionHasErrors('cities');
    }

    public function test_update_rejects_a_phone_code_not_in_the_countries_table(): void
    {
        $user = $this->actingCompanyUser();
        [, , $country, $city] = $this->lookups();

        $this->actingAs($user, 'company')
            ->from(route('company.settings'))
            ->put(route('company.settings.update'), [
                'company_name_ar' => 'ش',
                'company_name_en' => 'S',
                'admin_name' => 'A',
                'email' => $user->companyProfile()->email,
                'phone_code' => '+999',
                'phone' => '0500000000',
                'cities' => [$city->id],
                'branch_count' => 1,
                'max_late_hours_allowed' => 0,
                'insurance_policy_type' => 'comprehensive',
                'address' => 'عنوان',
                'city_id' => $city->id,
                'country_id' => $country->id,
                'commercial_record' => '123',
                'tax_number' => '456',
                'account_owner_name' => 'Owner',
                'bank_name' => 'Bank Albilad',
                'iban_number' => 'SA00',
                'account_number' => '0000',
            ])
            ->assertSessionHasErrors('phone_code');
    }

    public function test_company_profile_is_created_and_linked_when_missing(): void
    {
        $user = CompanyUser::create([
            'company_id' => null,
            'name' => 'Orphan Manager',
            'email' => 'orphan-'.uniqid().'@tcar.test',
            'password' => Hash::make('12345678'),
            'is_active' => true,
        ]);

        $this->assertNull($user->company_id);

        $company = $user->companyProfile();

        $this->assertNotNull($user->refresh()->company_id);
        $this->assertSame($company->id, $user->company_id);
        $this->assertSame('Orphan Manager', $company->admin_name);
    }
}
