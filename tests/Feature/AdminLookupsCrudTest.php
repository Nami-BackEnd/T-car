<?php

namespace Tests\Feature;

use App\Models\Admin;
use App\Models\Airport;
use App\Models\Brand;
use App\Models\CarType;
use App\Models\City;
use App\Models\CompanyAdditionalService;
use App\Models\Country;
use App\Models\Vacation;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class AdminLookupsCrudTest extends TestCase
{
    use DatabaseTransactions;

    private function admin(): Admin
    {
        return Admin::first() ?? Admin::create([
            'name' => 'Test Admin',
            'email' => 'test-admin@tcar.com',
            'password' => Hash::make('12345678'),
            'is_active' => true,
        ]);
    }

    public function test_lookup_ajax_crud_flow(): void
    {
        $admin = $this->admin();

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

        // index returns paginated JSON
        for ($i = 1; $i <= 12; $i++) {
            City::create([
                'title_ar' => "مدينة {$i}",
                'title_en' => "City {$i}",
                'country_id' => $country->id,
                'latitude' => 24.0 + $i,
                'longitude' => 46.0 + $i,
            ]);
        }
        $response = $this->actingAs($admin, 'admin')->getJson(route('admin.lookups.index', 'cities'));
        $response->assertOk()->assertJsonStructure(['data', 'pagination', 'message', 'code']);
        $this->assertCount(10, $response->json('data'));

        // search works on bilingual title
        $found = $this->actingAs($admin, 'admin')->getJson(route('admin.lookups.index', 'cities').'?search=Riyadh');
        $this->assertGreaterThanOrEqual(1, count($found->json('data')));

        // store validation fails (missing EN name, bad coordinates, missing country)
        $invalid = $this->actingAs($admin, 'admin')->postJson(route('admin.lookups.store', 'cities'), [
            'title_ar' => 'مكة',
            'latitude' => 120,
            'longitude' => 500,
        ]);
        $invalid->assertStatus(422);
        $errors = $invalid->json('errors');
        $this->assertTrue(isset($errors['title_en'], $errors['latitude'], $errors['longitude'], $errors['country_id']));

        // an unknown country is rejected
        $badCountry = $this->actingAs($admin, 'admin')->postJson(route('admin.lookups.store', 'cities'), [
            'title_ar' => 'مكة',
            'title_en' => 'Makkah',
            'country_id' => 999999,
        ]);
        $badCountry->assertStatus(422);
        $this->assertNotNull($badCountry->json('errors.country_id'));

        // store succeeds with coordinates and a country
        $stored = $this->actingAs($admin, 'admin')->postJson(route('admin.lookups.store', 'cities'), [
            'title_ar' => 'جدة',
            'title_en' => 'Jeddah',
            'country_id' => $country->id,
            'latitude' => 21.5433,
            'longitude' => 39.1728,
        ]);
        $stored->assertOk();
        $cityId = $stored->json('data.row.id');
        $this->assertNotNull($cityId);
        $this->assertEquals('جدة', $stored->json('data.row.title_ar'));
        $this->assertEquals('Jeddah', $stored->json('data.row.title_en'));
        $this->assertEquals('Jeddah', City::find($cityId)->title_en);
        $this->assertEquals($country->id, City::find($cityId)->country_id);
        $this->assertEquals('Saudi Arabia', $stored->json('data.row.country'));

        // update succeeds
        $updated = $this->actingAs($admin, 'admin')->putJson(route('admin.lookups.update', ['cities', $cityId]), [
            'title_ar' => 'جدة الجديدة',
            'title_en' => 'New Jeddah',
            'country_id' => $country->id,
            'latitude' => 21.6,
            'longitude' => 39.2,
        ]);
        $updated->assertOk();
        $this->assertEquals('New Jeddah', City::find($cityId)->title_en);

        // entity with city relation resolves the localized city name
        $airportStored = $this->actingAs($admin, 'admin')->postJson(route('admin.lookups.store', 'airports'), [
            'title_ar' => 'مطار الملك خالد',
            'title_en' => 'King Khalid Airport',
            'city_id' => $city->id,
        ]);
        $airportStored->assertOk();
        $airportId = $airportStored->json('data.row.id');
        $this->assertEquals('Riyadh', $airportStored->json('data.row.city'));

        // invalid city_id is rejected
        $badCity = $this->actingAs($admin, 'admin')->postJson(route('admin.lookups.store', 'airports'), [
            'title_ar' => 'مطار',
            'title_en' => 'Airport',
            'city_id' => 999999,
        ]);
        $badCity->assertStatus(422);
        $this->assertTrue($badCity->json('errors.city_id') !== null);

        // toggle update (is_active) works
        $type = CarType::create(['title_ar' => 'صغيرة', 'title_en' => 'Compact', 'is_active' => true]);
        $toggled = $this->actingAs($admin, 'admin')->putJson(route('admin.lookups.update', ['car-types', $type->id]), [
            'title_ar' => 'صغيرة',
            'title_en' => 'Compact',
            'is_active' => false,
        ]);
        $toggled->assertOk();
        $this->assertFalse((bool) CarType::find($type->id)->is_active);

        // date-based entity works
        $holiday = $this->actingAs($admin, 'admin')->postJson(route('admin.lookups.store', 'vacations'), [
            'name_ar' => 'اليوم الوطني',
            'name_en' => 'National Day',
            'date' => '2026-09-23',
        ]);
        $holiday->assertOk();
        $holidayId = $holiday->json('data.row.id');
        $this->assertEquals('2026-09-23', Vacation::find($holidayId)->date->toDateString());
        $this->assertEquals('اليوم الوطني', $holiday->json('data.row.name_ar'));
        $this->assertEquals('National Day', $holiday->json('data.row.name_en'));
        $this->assertEquals('اليوم الوطني', $holiday->json('data.row.title_ar'));

        // list rows are normalized the same way (names + short date)
        $list = $this->actingAs($admin, 'admin')->getJson(route('admin.lookups.index', 'vacations'));
        $list->assertOk();
        $this->assertEquals('National Day', $list->json('data.0.title_en'));
        $this->assertEquals('2026-09-23', $list->json('data.0.date'));

        // destroy works
        $brand = Brand::create(['title_ar' => 'تويوتا', 'title_en' => 'Toyota']);
        $deleted = $this->actingAs($admin, 'admin')->deleteJson(route('admin.lookups.destroy', ['brands', $brand->id]));
        $deleted->assertOk();
        $this->assertDatabaseMissing('brands', ['id' => $brand->id]);

        // company-services entity works end to end
        $serviceStored = $this->actingAs($admin, 'admin')->postJson(route('admin.lookups.store', 'company-services'), [
            'title_ar' => 'توصيل للمطار',
            'title_en' => 'Airport Delivery',
        ]);
        $serviceStored->assertOk();
        $serviceId = $serviceStored->json('data.row.id');
        $this->assertEquals('توصيل للمطار', $serviceStored->json('data.row.title_ar'));
        $this->assertEquals('Airport Delivery', $serviceStored->json('data.row.title_en'));

        $serviceList = $this->actingAs($admin, 'admin')->getJson(route('admin.lookups.index', 'company-services'));
        $serviceList->assertOk();
        $this->assertEquals('Airport Delivery', $serviceList->json('data.0.title_en'));

        $serviceUpdated = $this->actingAs($admin, 'admin')->putJson(route('admin.lookups.update', ['company-services', $serviceId]), [
            'title_ar' => 'توصيل المطار',
            'title_en' => 'Airport Drop-off',
        ]);
        $serviceUpdated->assertOk();
        $this->assertEquals('Airport Drop-off', CompanyAdditionalService::find($serviceId)->title_en);

        $this->actingAs($admin, 'admin')->deleteJson(route('admin.lookups.destroy', ['company-services', $serviceId]));
        $this->assertDatabaseMissing('company_additional_services', ['id' => $serviceId]);

        // airport delete
        $this->actingAs($admin, 'admin')->deleteJson(route('admin.lookups.destroy', ['airports', $airportId]));
        $this->assertDatabaseMissing('airports', ['id' => $airportId]);

        // unknown entity is 404
        $this->actingAs($admin, 'admin')->getJson(route('admin.lookups.index', 'not-a-real-entity'))->assertNotFound();

        // page renders with map for cities
        $view = $this->actingAs($admin, 'admin')->get(route('admin.lookups.index', 'cities'));
        $view->assertOk()
            ->assertSee('lookupsTable')
            ->assertSee('lookupMap')
            ->assertSee(__('admin.nav.setup'))
            ->assertSee(__('admin.nav.locations'))
            ->assertSee(__('admin.nav.car_lists'))
            ->assertSee(__('admin.nav.company_data'))
            ->assertSee(__('admin.nav.payments'))
            ->assertSee(__('admin.lookups.cities'))
            ->assertSee('admin/lookups/cities');

        // non-map page renders
        $this->actingAs($admin, 'admin')->get(route('admin.lookups.index', 'brands'))->assertOk();
    }

    public function test_countries_lookup_crud(): void
    {
        $admin = $this->admin();

        // a malformed phone code is rejected
        $invalid = $this->actingAs($admin, 'admin')->postJson(route('admin.lookups.store', 'countries'), [
            'title_ar' => 'مصر',
            'title_en' => 'Egypt',
            'phone_code' => '20',
        ]);
        $invalid->assertStatus(422);
        $this->assertNotNull($invalid->json('errors.phone_code'));

        $missingCode = $this->actingAs($admin, 'admin')->postJson(route('admin.lookups.store', 'countries'), [
            'title_ar' => 'مصر',
            'title_en' => 'Egypt',
        ]);
        $missingCode->assertStatus(422);
        $this->assertNotNull($missingCode->json('errors.phone_code'));

        $stored = $this->actingAs($admin, 'admin')->postJson(route('admin.lookups.store', 'countries'), [
            'title_ar' => 'مصر',
            'title_en' => 'Egypt',
            'phone_code' => '+20',
        ]);
        $stored->assertOk();
        $countryId = $stored->json('data.row.id');

        $this->assertDatabaseHas('countries', ['id' => $countryId, 'phone_code' => '+20']);

        $list = $this->actingAs($admin, 'admin')->getJson(route('admin.lookups.index', 'countries').'?search=Egypt');
        $list->assertOk();
        $this->assertEquals('+20', $list->json('data.0.phone_code'));

        $updated = $this->actingAs($admin, 'admin')->putJson(route('admin.lookups.update', ['countries', $countryId]), [
            'title_ar' => 'مصر الجديدة',
            'title_en' => 'New Egypt',
            'phone_code' => '+201',
        ]);
        $updated->assertOk();
        $this->assertDatabaseHas('countries', ['id' => $countryId, 'phone_code' => '+201', 'title_en' => 'New Egypt']);

        // the countries page renders and offers localized country options for the city form
        $view = $this->actingAs($admin, 'admin')->get(route('admin.lookups.index', 'countries'));
        $view->assertOk()
            ->assertSee(__('admin.lookups.countries'))
            ->assertSee(__('admin.lookups.phone_code'))
            ->assertSee('optionSources');

        $citiesView = $this->actingAs($admin, 'admin')->get(route('admin.lookups.index', 'cities'));
        $citiesView->assertOk()->assertSee('New Egypt');

        $this->actingAs($admin, 'admin')->deleteJson(route('admin.lookups.destroy', ['countries', $countryId]));
        $this->assertDatabaseMissing('countries', ['id' => $countryId]);
    }
}
