<?php

namespace Tests\Feature;

use App\Models\Branch;
use App\Models\Brand;
use App\Models\Car;
use App\Models\CarAdditionalService;
use App\Models\CarModel;
use App\Models\CarType;
use App\Models\Company;
use App\Models\CompanyUser;
use DOMDocument;
use DOMXPath;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Testing\TestResponse;
use Tests\TestCase;

class CompanyCarTest extends TestCase
{
    use DatabaseTransactions;

    private ?array $lookups = null;

    /** The "company" guard authenticates CompanyUser rows (branches.company_id references company_users.id). */
    private function actingCompanyUser(): CompanyUser
    {
        $company = Company::create([
            'company_name_ar' => 'شركة اختبار',
            'company_name_en' => 'Test Car',
            'admin_name' => 'Admin',
            'email' => 'cars-'.uniqid().'@tcar.test',
            'phone' => '0500000000',
            'phone_code' => '966',
            'license_category' => 'rent',
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

    private function branch(CompanyUser $owner, string $suffix): Branch
    {
        return Branch::create([
            'company_id' => $owner->id,
            'branch_type' => 'office',
            'name_ar' => 'فرع '.$suffix,
            'name_en' => 'Branch '.$suffix,
            'phone_number' => '05000000'.$suffix,
            'status' => 'approved',
        ]);
    }

    private function lookups(): array
    {
        return $this->lookups ??= [
            Brand::create(['title_ar' => 'تويوتا', 'title_en' => 'Toyota']),
            CarType::create([
                'title_ar' => 'سيدان',
                'title_en' => 'Sedan',
                'is_active' => true,
            ]),
            CarModel::create(['title_ar' => 'كامري', 'title_en' => 'Camry']),
        ];
    }

    /**
     * @param  array<int, array{branch_id: int, stock: int}>  $branches
     * @param  array<int, int>  $serviceIds
     */
    private function payload(array $branches, array $serviceIds): array
    {
        [$brand, $type, $model] = $this->lookups();

        $serviceIds = array_values($serviceIds);
        $servicePrices = [50, 20];

        return [
            'car_brand_id' => $brand->id,
            'car_type_id' => $type->id,
            'car_model_id' => $model->id,
            'year' => 2024,
            'note_ar' => 'ملاحظة',
            'note_en' => 'note',
            'is_subscriber' => 1,
            'pricing' => [
                'day_price' => 100,
                'day_lowest_price' => 90,
                'week_price' => 500,
                'week_lowest_price' => 450,
                'month_price' => 1500,
                'month_lowest_price' => 1400,
                'free_km' => 200,
                'free_km_price' => 5,
            ],
            'subscriptions' => [
                ['month_count' => 3, 'price' => 3000, 'lowest_price' => 2800],
                ['month_count' => 6, 'price' => 5500, 'lowest_price' => 5000],
            ],
            'services' => array_map(
                fn (int $id, int $index) => [
                    'car_additional_service_id' => $id,
                    'price' => $servicePrices[$index] ?? 0,
                ],
                $serviceIds,
                array_keys($serviceIds)
            ),
            'branches' => array_values($branches),
            'details' => [
                'power' => 'hybrid',
                'door_count' => 4,
                'has_navigation' => 1,
                'has_bluetooth' => 1,
                'has_sensors' => 0,
            ],
        ];
    }

    public function test_options_endpoint_returns_company_scoped_data(): void
    {
        $company = $this->actingCompanyUser();
        $branchA = $this->branch($company, '1');
        $branchB = $this->branch($company, '2');
        $otherOwner = $this->actingCompanyUser();
        $otherBranch = $this->branch($otherOwner, '3');
        $this->lookups();

        $response = $this->actingAs($company, 'company')
            ->getJson(route('company.add-car.options'));

        $response->assertOk();
        $ids = collect($response->json('data.branches'))->pluck('id');

        $this->assertTrue($ids->contains($branchA->id));
        $this->assertTrue($ids->contains($branchB->id));
        $this->assertFalse($ids->contains($otherBranch->id));
        $this->assertNotEmpty($response->json('data.brands'));
        $this->assertNotEmpty($response->json('data.car_types'));
        $this->assertNotEmpty($response->json('data.car_models'));
        $this->assertNotEmpty($response->json('data.car_additional_services'));
        $this->assertSame(
            ['diesel', 'petrol', 'hybrid', 'electric', 'gas'],
            $response->json('data.powers')
        );
        $this->assertNotEmpty($response->json('data.years'));
        $this->assertSame([2, 3, 4, 5, 6, 7], $response->json('data.door_counts'));
    }

    public function test_store_creates_car_with_all_relations(): void
    {
        Storage::fake('public');

        $company = $this->actingCompanyUser();
        $branchA = $this->branch($company, '1');
        $branchB = $this->branch($company, '2');
        $this->lookups();
        $serviceIds = CarAdditionalService::pluck('id')->take(2)->all();

        $branches = [
            ['branch_id' => $branchA->id, 'stock' => 4],
            ['branch_id' => $branchB->id, 'stock' => 2],
        ];

        $response = $this->actingAs($company, 'company')
            ->post(route('company.add-car.store'), $this->payload($branches, $serviceIds));

        $response->assertOk();

        $carId = $response->json('data.car.id');
        $this->assertNotNull($carId);

        $car = Car::with(['pricing', 'details', 'subscriptions', 'carServices', 'branches'])->findOrFail($carId);

        $this->assertTrue($car->is_subscriber);
        $this->assertSame(6, (int) $car->count);
        $this->assertSame(100.0, (float) $car->pricing->day_price);
        $this->assertSame(200, (int) $car->pricing->free_km);
        $this->assertSame('hybrid', $car->details->power);
        $this->assertSame(4, (int) $car->details->door_count);
        $this->assertTrue((bool) $car->details->has_navigation);
        $this->assertFalse((bool) $car->details->has_sensors);
        $this->assertCount(2, $car->subscriptions);
        $this->assertCount(2, $car->carServices);
        $this->assertCount(2, $car->branches);
        $this->assertEqualsCanonicalizing(
            [$branchA->id, $branchB->id],
            $car->branches->pluck('id')->all()
        );

        $stock = $car->branches->pluck('pivot.stock', 'id');
        $this->assertSame(4, (int) $stock[$branchA->id]);
        $this->assertSame(2, (int) $stock[$branchB->id]);
    }

    public function test_store_uploads_image_and_saves_it_on_public_disk(): void
    {
        Storage::fake('public');

        $company = $this->actingCompanyUser();
        $branch = $this->branch($company, '1');
        $this->lookups();
        $serviceIds = CarAdditionalService::pluck('id')->take(1)->all();

        $payload = $this->payload([['branch_id' => $branch->id, 'stock' => 3]], $serviceIds);
        $payload['image'] = UploadedFile::fake()->image('car.jpg');

        $response = $this->actingAs($company, 'company')
            ->post(route('company.add-car.store'), $payload);

        $response->assertOk();

        $car = Car::findOrFail($response->json('data.car.id'));
        $this->assertNotNull($car->image);
        Storage::disk('public')->assertExists($car->image);
        $this->assertStringContainsString($car->image, $car->image_url);
    }

    public function test_store_rejects_branch_from_another_company(): void
    {
        $company = $this->actingCompanyUser();
        $this->branch($company, '1');
        $otherOwner = $this->actingCompanyUser();
        $otherBranch = $this->branch($otherOwner, '9');
        $this->lookups();
        $serviceIds = CarAdditionalService::pluck('id')->take(1)->all();

        // Compared before and after rather than against zero, so the assertion
        // holds on a database that already holds a seeded fleet.
        $before = Car::count();

        $this->actingAs($company, 'company')
            ->post(route('company.add-car.store'), $this->payload([['branch_id' => $otherBranch->id, 'stock' => 3]], $serviceIds))
            ->assertStatus(403);

        $this->assertSame($before, Car::count(), 'the rejected request created a car');
    }

    public function test_store_validates_required_fields(): void
    {
        $company = $this->actingCompanyUser();
        $this->branch($company, '1');
        $this->lookups();

        $this->actingAs($company, 'company')
            ->postJson(route('company.add-car.store'), [])
            ->assertStatus(422)
            ->assertJsonValidationErrors(['car_brand_id', 'car_type_id', 'car_model_id', 'branches', 'details']);
    }

    public function test_store_rejects_invalid_power_value(): void
    {
        $company = $this->actingCompanyUser();
        $branch = $this->branch($company, '1');
        $this->lookups();
        $serviceIds = CarAdditionalService::pluck('id')->take(1)->all();

        $payload = $this->payload([['branch_id' => $branch->id, 'stock' => 3]], $serviceIds);
        $payload['details']['power'] = 'nuclear';

        $this->actingAs($company, 'company')
            ->postJson(route('company.add-car.store'), $payload)
            ->assertStatus(422)
            ->assertJsonValidationErrors(['details.power']);
    }

    public function test_update_changes_pricing_stock_and_services(): void
    {
        $company = $this->actingCompanyUser();
        $branchA = $this->branch($company, '1');
        $branchB = $this->branch($company, '2');
        $this->lookups();
        $serviceIds = CarAdditionalService::pluck('id')->take(2)->all();

        $branches = [
            ['branch_id' => $branchA->id, 'stock' => 4],
            ['branch_id' => $branchB->id, 'stock' => 2],
        ];

        $createResponse = $this->actingAs($company, 'company')
            ->post(route('company.add-car.store'), $this->payload($branches, $serviceIds));
        $carId = $createResponse->json('data.car.id');

        $payload = $this->payload([['branch_id' => $branchB->id, 'stock' => 3]], [$serviceIds[0]]);
        $payload['pricing']['day_price'] = 150;
        $payload['details']['door_count'] = 5;
        $payload['details']['power'] = 'electric';
        $payload['subscriptions'] = [];
        $payload['is_subscriber'] = 0;

        $this->actingAs($company, 'company')
            ->put(route('company.edit-car.update', $carId), $payload)
            ->assertOk();

        $car = Car::with(['pricing', 'details', 'subscriptions', 'carServices', 'branches'])->findOrFail($carId);

        $this->assertSame(150.0, (float) $car->pricing->day_price);
        $this->assertSame(5, (int) $car->details->door_count);
        $this->assertSame('electric', $car->details->power);
        $this->assertCount(0, $car->subscriptions);
        $this->assertCount(1, $car->carServices);
        $this->assertCount(1, $car->branches);
        $this->assertSame(3, (int) $car->count);
        $this->assertFalse($car->is_subscriber);
    }

    public function test_show_and_update_are_forbidden_for_other_company(): void
    {
        $owner = $this->actingCompanyUser();
        $ownerBranch = $this->branch($owner, '1');
        $this->lookups();
        $serviceIds = CarAdditionalService::pluck('id')->take(1)->all();

        $carId = $this->actingAs($owner, 'company')
            ->post(route('company.add-car.store'), $this->payload([['branch_id' => $ownerBranch->id, 'stock' => 3]], $serviceIds))
            ->json('data.car.id');

        $intruder = $this->actingCompanyUser();
        $intruderBranch = $this->branch($intruder, '7');

        $this->actingAs($intruder, 'company')
            ->getJson(route('company.edit-car.show', $carId))
            ->assertStatus(403);

        $payload = $this->payload([['branch_id' => $intruderBranch->id, 'stock' => 3]], $serviceIds);
        $this->actingAs($intruder, 'company')
            ->putJson(route('company.edit-car.update', $carId), $payload)
            ->assertStatus(403);
    }

    public function test_add_car_page_ships_api_urls_and_no_hardcoded_branches(): void
    {
        $company = $this->actingCompanyUser();

        $response = $this->actingAs($company, 'company')->get(route('company.add-car'));

        $response->assertOk();
        $response->assertSee('data-car-form', false);
        $response->assertSee(route('company.add-car.options'), false);
        $response->assertSee(route('company.add-car.store'), false);
        // Branch options come from the API, so the demo branches must be gone.
        $response->assertDontSee('data-value="branch1"', false);
    }

    public function test_edit_car_page_targets_the_update_endpoints(): void
    {
        $company = $this->actingCompanyUser();

        $response = $this->actingAs($company, 'company')->get(route('company.edit-car'));

        $response->assertOk();
        $response->assertSee(route('company.edit-car.show', ['car' => 0]), false);
        $response->assertSee(route('company.edit-car.update', ['car' => 0]), false);
        $response->assertDontSee('data-value="branch1"', false);
    }

    public function test_show_endpoint_returns_options_the_edit_form_can_hydrate(): void
    {
        $company = $this->actingCompanyUser();
        $branch = $this->branch($company, '1');
        $this->lookups();
        $serviceIds = CarAdditionalService::pluck('id')->take(1)->all();

        $carId = $this->actingAs($company, 'company')
            ->post(route('company.add-car.store'), $this->payload([['branch_id' => $branch->id, 'stock' => 2]], $serviceIds))
            ->json('data.car.id');

        $response = $this->actingAs($company, 'company')
            ->getJson(route('company.edit-car.show', $carId));

        $response->assertOk();
        $response->assertJsonPath('data.car.id', $carId);
        $response->assertJsonPath('data.car.branches.0.branch_id', $branch->id);
        $response->assertJsonPath('data.car.branches.0.stock', 2);
        $response->assertJsonPath('data.options.branches.0.id', $branch->id);

        // The submitted service must be among the options the edit form renders.
        $this->assertContains(
            $serviceIds[0],
            collect($response->json('data.options.car_additional_services'))->pluck('id')->all()
        );
        $this->assertSame(
            (float) 50,
            (float) $response->json('data.car.services.0.price')
        );
    }

    /** Creates a car as the given company user, the same way the UI would. */
    private function createCar(CompanyUser $owner, array $branches, array $serviceIds = [1], array $overrides = []): int
    {
        return $this->actingAs($owner, 'company')
            ->postJson(route('company.add-car.store'), array_merge(
                $this->payload($branches, $serviceIds),
                $overrides
            ))
            ->assertOk()
            ->json('data.car.id');
    }

    /**
     * A dangling quote in a data-* attribute still leaves the expected text in
     * the response body, so assert on the parsed DOM instead. A browser swallows
     * the following attribute when the quote is missing, which is exactly the
     * kind of breakage a substring assertion cannot see.
     */
    public function test_license_plates_page_renders_the_same_cars_from_the_database(): void
    {
        $company = $this->actingCompanyUser();
        $branch = $this->branch($company, '21');
        $carId = $this->createCar($company, [['branch_id' => $branch->id, 'stock' => 3]]);

        $car = Car::findOrFail($carId);

        $response = $this->actingAs($company, 'company')->get(route('company.license-plates'));

        $response->assertOk();

        $rows = $this->tableRows($response, 'platesTable');
        $this->assertStringContainsString(e($car->brand->title), $rows);
        $this->assertStringContainsString(e($car->carModel->title), $rows);
        $this->assertStringContainsString((string) $car->year, $rows);
        $this->assertStringContainsString(route('company.edit-car').'?car='.$carId, $rows);
        $this->assertStringContainsString((string) $car->count, $rows);

        // The demo rows this screen used to ship are gone. These are picked
        // because none of them exists as a real brand or model in the seeders.
        foreach (['Chery', 'Arrizo', 'Taurus', 'Dzire'] as $demoValue) {
            $this->assertStringNotContainsString($demoValue, $rows);
        }
    }

    public function test_license_plates_filters_navigate_through_the_query_string(): void
    {
        $company = $this->actingCompanyUser();
        $branch = $this->branch($company, '22');
        $carId = $this->createCar($company, [['branch_id' => $branch->id, 'stock' => 1]]);
        $car = Car::findOrFail($carId);
        $model = e($car->carModel->title);

        $this->actingAs($company, 'company')
            ->get(route('company.license-plates', ['brand' => $car->car_brand_id]))
            ->assertOk()
            ->assertSee($model);

        $rows = $this->tableRows(
            $this->actingAs($company, 'company')->get(route('company.license-plates', ['car_model' => 999999])),
            'platesTable'
        );
        $this->assertStringNotContainsString($model, $rows);

        $rows = $this->tableRows(
            $this->actingAs($company, 'company')->get(route('company.license-plates', ['q' => 'zzz-no-such-car'])),
            'platesTable'
        );
        $this->assertStringNotContainsString($model, $rows);

        $rows = $this->tableRows(
            $this->actingAs($company, 'company')->get(route('company.license-plates', ['year' => $car->year])),
            'platesTable'
        );
        $this->assertStringContainsString($model, $rows);
    }

    public function test_license_plates_availability_modal_carries_real_stocks_and_returns_to_its_own_page(): void
    {
        $company = $this->actingCompanyUser();
        $branch = $this->branch($company, '23');
        $carId = $this->createCar($company, [['branch_id' => $branch->id, 'stock' => 4]]);

        $page = $this->actingAs($company, 'company')->get(route('company.license-plates'));
        $page->assertOk();
        $page->assertSee(route('company.office-cars.stocks', ['car' => $carId]), false);
        // The modal posts back to the screen it was opened from.
        $this->assertStringContainsString('value="license-plates"', $page->getContent());

        $this->actingAs($company, 'company')
            ->put(route('company.office-cars.stocks', ['car' => $carId]), [
                'stocks' => [$branch->id => 11],
                'return' => 'license-plates',
            ])
            ->assertRedirect(route('company.license-plates'));

        $this->assertSame(11, (int) Car::findOrFail($carId)->count);
    }

    public function test_availability_matrix_renders_real_branches_cars_and_totals(): void
    {
        // The columns are labelled in Arabic, so read the page as an Arabic user.
        app()->setLocale('ar');

        $company = $this->actingCompanyUser();
        $first = $this->branch($company, '31');
        $second = $this->branch($company, '32');
        $carId = $this->createCar($company, [
            ['branch_id' => $first->id, 'stock' => 3],
            ['branch_id' => $second->id, 'stock' => 4],
        ]);

        $response = $this->actingAs($company, 'company')->get(route('company.car-availability'));
        $response->assertOk();

        $document = new DOMDocument;
        @$document->loadHTML($response->getContent());
        $xpath = new DOMXPath($document);

        // One row per branch of this company, and no leftover hardcoded rows.
        $offices = $xpath->query('//td[contains(@class,"fleet-matrix__office")]');
        $this->assertSame(2, $offices->length);
        $this->assertStringContainsString($first->name_ar, $response->getContent());
        $this->assertStringContainsString($second->name_ar, $response->getContent());
        $this->assertStringNotContainsString('N2 Rental Car', $response->getContent());

        // One cell per branch x car, holding the real pivot stock.
        $cells = $xpath->query('//*[@data-cell]');
        $this->assertSame(2, $cells->length);
        $this->assertSame('3', trim($xpath->query('//*[@data-cell][@data-branch="'.$first->id.'"]//*[@data-count]')->item(0)->nodeValue));
        $this->assertSame('4', trim($xpath->query('//*[@data-cell][@data-branch="'.$second->id.'"]//*[@data-count]')->item(0)->nodeValue));

        // The aggregate fleet-total column is intentionally not rendered.
        $this->assertSame(0, $xpath->query('//*[@data-branch-total]')->length);
        $this->assertSame(0, $xpath->query('//*[@id="grandTotalCell"]')->length);

        // The column header names the car in Arabic with its type and year.
        $header = $xpath->query('//th[.//*[@data-toggle-car="'.$carId.'"]]')->item(0);
        $this->assertNotNull($header);
        $this->assertStringContainsString('كامري', $header->textContent);
        $this->assertStringContainsString('سيدان', $header->textContent);
        $this->assertStringContainsString('2024', $header->textContent);
    }

    public function test_availability_matrix_cell_saves_the_stock_on_every_click(): void
    {
        $company = $this->actingCompanyUser();
        $branch = $this->branch($company, '33');
        $carId = $this->createCar($company, [['branch_id' => $branch->id, 'stock' => 5]]);

        $response = $this->actingAs($company, 'company')->putJson(
            route('company.car-availability.stock', ['car' => $carId]),
            ['branch' => $branch->id, 'stock' => 6]
        );

        $response->assertOk();
        // Answers with the stored number so the stepper can settle on the truth.
        $this->assertSame(6, $response->json('data.stock'));
        $this->assertSame(6, (int) DB::table('car_branches')
            ->where('car_id', $carId)->where('branch_id', $branch->id)->value('stock'));
    }

    public function test_availability_matrix_cell_creates_the_row_for_a_branch_the_car_is_new_to(): void
    {
        $company = $this->actingCompanyUser();
        $first = $this->branch($company, '34');
        $second = $this->branch($company, '35');
        $carId = $this->createCar($company, [['branch_id' => $first->id, 'stock' => 2]]);

        $this->actingAs($company, 'company')->putJson(
            route('company.car-availability.stock', ['car' => $carId]),
            ['branch' => $second->id, 'stock' => 8]
        )->assertOk();

        $this->assertSame(8, (int) DB::table('car_branches')
            ->where('car_id', $carId)->where('branch_id', $second->id)->value('stock'));
    }

    public function test_availability_stock_never_goes_below_zero(): void
    {
        $company = $this->actingCompanyUser();
        $branch = $this->branch($company, '36');
        $carId = $this->createCar($company, [['branch_id' => $branch->id, 'stock' => 1]]);

        $response = $this->actingAs($company, 'company')->putJson(
            route('company.car-availability.stock', ['car' => $carId]),
            ['branch' => $branch->id, 'stock' => -5]
        );

        $response->assertStatus(422);
        $this->assertSame(1, (int) DB::table('car_branches')
            ->where('car_id', $carId)->where('branch_id', $branch->id)->value('stock'));
    }

    public function test_availability_stock_and_toggle_reject_another_companys_car_or_branch(): void
    {
        $company = $this->actingCompanyUser();
        $branch = $this->branch($company, '37');
        $carId = $this->createCar($company, [['branch_id' => $branch->id, 'stock' => 1]]);

        $other = $this->actingCompanyUser();
        $otherBranch = $this->branch($other, '38');
        $otherCarId = $this->createCar($other, [['branch_id' => $otherBranch->id, 'stock' => 1]]);

        // Someone else's car.
        $this->actingAs($company, 'company')->putJson(
            route('company.car-availability.stock', ['car' => $otherCarId]),
            ['branch' => $branch->id, 'stock' => 99]
        )->assertForbidden();

        $this->actingAs($company, 'company')
            ->postJson(route('company.car-availability.toggle', ['car' => $otherCarId]))
            ->assertForbidden();

        // Own car, but a branch that belongs to somebody else.
        $this->actingAs($company, 'company')->putJson(
            route('company.car-availability.stock', ['car' => $carId]),
            ['branch' => $otherBranch->id, 'stock' => 99]
        )->assertForbidden();

        $this->assertSame(1, (int) DB::table('car_branches')
            ->where('car_id', $carId)->where('branch_id', $branch->id)->value('stock'));
    }

    public function test_availability_toggle_flips_the_car_flag(): void
    {
        $company = $this->actingCompanyUser();
        $branch = $this->branch($company, '39');
        $carId = $this->createCar($company, [['branch_id' => $branch->id, 'stock' => 1]]);

        $this->assertTrue((bool) Car::findOrFail($carId)->is_active);

        $off = $this->actingAs($company, 'company')
            ->postJson(route('company.car-availability.toggle', ['car' => $carId]));
        $off->assertOk();
        $this->assertFalse($off->json('data.is_active'));
        $this->assertFalse((bool) Car::findOrFail($carId)->is_active);

        $on = $this->actingAs($company, 'company')
            ->postJson(route('company.car-availability.toggle', ['car' => $carId]));
        $on->assertOk();
        $this->assertTrue($on->json('data.is_active'));
        $this->assertTrue((bool) Car::findOrFail($carId)->is_active);
    }

    public function test_availability_tabs_and_filters_narrow_the_matrix_server_side(): void
    {
        $company = $this->actingCompanyUser();
        $keep = $this->branch($company, '40');
        $drop = $this->branch($company, '41');
        [$brand, $type, $model] = $this->lookups();

        $visible = $this->createCar($company, [['branch_id' => $keep->id, 'stock' => 1]]);
        $hidden = $this->createCar($company, [['branch_id' => $drop->id, 'stock' => 1]], [1], [
            'year' => 2019,
        ]);

        // "Inactive only" has to drop the column, not just dim it.
        Car::findOrFail($hidden)->forceFill(['is_active' => false])->save();

        $inactive = $this->actingAs($company, 'company')
            ->get(route('company.car-availability', ['status' => 'inactive']));
        $inactive->assertOk();
        $inactive->assertDontSee('data-toggle-car="'.$visible.'"', false);
        $inactive->assertSee('data-toggle-car="'.$hidden.'"', false);

        // A branch filter narrows the rows. Scoped to the office cells: the
        // filter dropdown still offers every branch, so a page-wide check would
        // pass either way.
        $onlyKeep = $this->actingAs($company, 'company')
            ->get(route('company.car-availability', ['branch' => $keep->id, 'status' => 'all']));
        $onlyKeep->assertOk();

        $document = new DOMDocument;
        @$document->loadHTML($onlyKeep->getContent());
        $offices = (new DOMXPath($document))->query('//td[contains(@class,"fleet-matrix__office")]');

        $this->assertSame(1, $offices->length);
        $this->assertStringContainsString($keep->name_en, $offices->item(0)->textContent);
        $this->assertStringNotContainsString($drop->name_en, $offices->item(0)->textContent);

        // A year filter narrows the columns.
        $year2019 = $this->actingAs($company, 'company')
            ->get(route('company.car-availability', ['year' => 2019, 'status' => 'all']));
        $year2019->assertOk();
        $year2019->assertSee('data-toggle-car="'.$hidden.'"', false);
        $year2019->assertDontSee('data-toggle-car="'.$visible.'"', false);
    }

    public function test_availability_page_hides_other_companys_branches_and_cars(): void
    {
        $company = $this->actingCompanyUser();
        $mine = $this->branch($company, '42');
        $carId = $this->createCar($company, [['branch_id' => $mine->id, 'stock' => 1]]);

        $other = $this->actingCompanyUser();
        $theirBranch = $this->branch($other, '43');
        $theirCarId = $this->createCar($other, [['branch_id' => $theirBranch->id, 'stock' => 1]]);

        $response = $this->actingAs($company, 'company')->get(route('company.car-availability'));
        $response->assertOk();
        $response->assertSee('data-toggle-car="'.$carId.'"', false);
        $response->assertDontSee('data-toggle-car="'.$theirCarId.'"', false);
        $response->assertDontSee($theirBranch->name_en);
    }

    public function test_stock_save_keeps_the_active_branch_filter_on_screen(): void
    {
        $company = $this->actingCompanyUser();
        $branch = $this->branch($company, '26');
        $carId = $this->createCar($company, [['branch_id' => $branch->id, 'stock' => 1]]);

        $page = $this->actingAs($company, 'company')
            ->get(route('company.office-cars', ['branch' => $branch->id]));
        $page->assertOk();

        // Scoped to the modal form: the page also has a branch <select> for
        // the filter, and a plain name="branch" match would pass either way.
        $document = new DOMDocument;
        @$document->loadHTML($page->getContent());
        $carried = (new DOMXPath($document))
            ->query('//form[@id="carAvailabilityForm"]//input[@name="branch"]/@value');

        $this->assertNotFalse($carried);
        $this->assertSame(1, $carried->length, 'the stock form does not carry the active branch');
        $this->assertSame((string) $branch->id, $carried->item(0)->nodeValue);

        $this->actingAs($company, 'company')
            ->put(route('company.office-cars.stocks', ['car' => $carId]), [
                'stocks' => [$branch->id => 3],
                'return' => 'office-cars',
                'branch' => $branch->id,
            ])
            ->assertRedirect(route('company.office-cars', ['branch' => $branch->id]));
    }

    public function test_edit_page_delete_form_targets_the_loaded_car(): void
    {
        $company = $this->actingCompanyUser();
        $carId = $this->createCar($company, [['branch_id' => $this->branch($company, '27')->id, 'stock' => 1]]);

        $page = $this->actingAs($company, 'company')->get(route('company.edit-car', ['car' => $carId]));
        $page->assertOk();

        // The delete form is server-rendered, so it must not fall back to the
        // /0 placeholder that used to swallow the delete. Scoped to the form
        // itself: data-show-url/data-update-url are /0 by design and get
        // rewritten by the page script once the car id is known.
        $document = new DOMDocument;
        @$document->loadHTML($page->getContent());
        $deleteForms = (new DOMXPath($document))->query('//form[@data-confirm and @action]');

        $this->assertNotFalse($deleteForms);
        $this->assertGreaterThan(0, $deleteForms->length, 'the edit page has no delete form');

        $actions = [];
        foreach ($deleteForms as $form) {
            $actions[] = $form->getAttribute('action');
        }

        $this->assertContains(route('company.edit-car.destroy', ['car' => $carId]), $actions);
        $this->assertNotContains(route('company.edit-car.destroy', ['car' => 0]), $actions);
    }

    public function test_stock_save_cannot_be_redirected_off_site(): void
    {
        $company = $this->actingCompanyUser();
        $branch = $this->branch($company, '24');
        $carId = $this->createCar($company, [['branch_id' => $branch->id, 'stock' => 1]]);

        $this->actingAs($company, 'company')
            ->put(route('company.office-cars.stocks', ['car' => $carId]), [
                'stocks' => [$branch->id => 2],
                'return' => 'https://evil.example.com/steal',
            ])
            ->assertRedirect(route('company.office-cars'));
    }

    public function test_car_availability_modal_is_reachable_from_both_car_screens(): void
    {
        $company = $this->actingCompanyUser();
        $this->createCar($company, [['branch_id' => $this->branch($company, '25')->id, 'stock' => 1]]);

        foreach (['company.office-cars', 'company.license-plates'] as $screen) {
            $response = $this->actingAs($company, 'company')->get(route($screen));

            $response->assertOk();
            $response->assertSee('id="carAvailabilityModal"', false);
            $response->assertSee('data-bs-target="#carAvailabilityModal"', false);
        }

        // The action menu with the activity log and delete only exists on the
        // office screen; the plates list is meant to stay edit-only.
        $office = $this->actingAs($company, 'company')->get(route('company.office-cars'));
        $office->assertSee('data-bs-target="#carLogsModal"', false);
        $office->assertSee('form[data-confirm]', false);

        $plates = $this->actingAs($company, 'company')->get(route('company.license-plates'));
        $plates->assertDontSee('data-bs-target="#carLogsModal"', false);
        $plates->assertDontSee('action-menu-btn', false);
        $plates->assertDontSee('bi-three-dots', false);
    }

    public function test_car_pages_show_the_shared_success_modal_instead_of_an_alert(): void
    {
        $company = $this->actingCompanyUser();

        foreach (['company.add-car', 'company.edit-car'] as $screen) {
            $response = $this->actingAs($company, 'company')->get(route($screen));

            $response->assertOk();
            $response->assertSee('id="successModal"', false);
            $response->assertSee('id="successModalMessage"', false);
            $response->assertSee('bi-check-circle-fill', false);
            // The success path must not fall back to a native popup.
            $this->assertStringContainsString('window.showSuccessModal(', $response->getContent());
            $this->assertStringNotContainsString(
                'window.alert((res.data && res.data.message)',
                $response->getContent()
            );
            // And it must not bounce the user to the availability screen.
            $this->assertStringNotContainsString(
                "window.location.href = @json(route('company.car-availability'))",
                $response->getContent()
            );
        }
    }

    private function tableRows(TestResponse $response, string $tableId): string
    {
        $matched = preg_match(
            '/<table[^>]*id="'.preg_quote($tableId, '/').'".*?<tbody>(.*?)<\/tbody>/s',
            $response->getContent(),
            $matches
        );

        return $matched ? $matches[1] : '';
    }

    private function assertFormHasDataAttribute(TestResponse $response, string $attribute, string $expected): void
    {
        $document = new DOMDocument;
        @$document->loadHTML($response->getContent());
        $nodes = (new DOMXPath($document))->query('//*[@'.$attribute.']');

        $this->assertNotFalse($nodes);
        $this->assertGreaterThan(0, $nodes->length, "[$attribute] is not a parsable attribute on the page");

        $values = [];
        foreach ($nodes as $node) {
            $values[] = $node->getAttribute($attribute);
        }

        $this->assertContains($expected, $values, "[$attribute] = ".implode(', ', $values));
    }

    public function test_add_car_page_ships_parsable_api_urls(): void
    {
        $company = $this->actingCompanyUser();
        $response = $this->actingAs($company, 'company')->get(route('company.add-car'));

        $response->assertOk();
        $this->assertFormHasDataAttribute($response, 'data-store-url', route('company.add-car.store'));
        $this->assertFormHasDataAttribute($response, 'data-options-url', route('company.add-car.options'));
    }

    public function test_edit_car_page_ships_parsable_api_urls(): void
    {
        $company = $this->actingCompanyUser();
        $response = $this->actingAs($company, 'company')->get(route('company.edit-car'));

        $response->assertOk();
        $this->assertFormHasDataAttribute($response, 'data-update-url', route('company.edit-car.update', ['car' => 0]));
        $this->assertFormHasDataAttribute($response, 'data-show-url', route('company.edit-car.show', ['car' => 0]));
    }

    public function test_cars_list_renders_rows_from_the_database(): void
    {
        $company = $this->actingCompanyUser();
        $branch = $this->branch($company, '11');
        [$brand, $type, $model] = $this->lookups();

        $carId = $this->createCar($company, [['branch_id' => $branch->id, 'stock' => 4]]);

        $response = $this->actingAs($company, 'company')->get(route('company.office-cars'));

        $response->assertOk();
        $response->assertViewIs('company.pages.office-cars');
        $response->assertSee(e($brand->title_en), false);
        $response->assertSee(e($model->title_en), false);
        $response->assertSee('2024', false);

        $row = $response->viewData('cars')->first();
        $this->assertSame($carId, $row->id);
        $this->assertSame(4, (int) $row->count);
    }

    public function test_cars_list_never_shows_another_company_cars(): void
    {
        $mine = $this->actingCompanyUser();
        $other = $this->actingCompanyUser();
        $theirBranch = $this->branch($other, '22');

        $theirCarId = $this->createCar($other, [['branch_id' => $theirBranch->id, 'stock' => 1]]);

        $response = $this->actingAs($mine, 'company')->get(route('company.office-cars'));

        $response->assertOk();
        $this->assertNull($response->viewData('cars')->firstWhere('id', $theirCarId));
    }

    public function test_cars_list_filters_narrow_the_query(): void
    {
        $company = $this->actingCompanyUser();
        $branch = $this->branch($company, '33');
        [$brand, $type, $model] = $this->lookups();
        $otherBrand = Brand::where('id', '!=', $brand->id)->firstOrFail();

        $this->createCar($company, [['branch_id' => $branch->id, 'stock' => 3]]);
        $secondCarId = $this->createCar(
            $company,
            [['branch_id' => $branch->id, 'stock' => 1]],
            [1],
            ['car_brand_id' => $otherBrand->id, 'year' => 2021]
        );

        // A brand that matches nothing must return an empty table, not everything.
        $this->actingAs($company, 'company')
            ->get(route('company.office-cars', ['brand' => 999999]))
            ->assertOk()
            ->assertViewHas('cars', fn ($cars) => $cars->isEmpty());

        $this->actingAs($company, 'company')
            ->get(route('company.office-cars', ['brand' => $brand->id]))
            ->assertOk()
            ->assertViewHas('cars', fn ($cars) => $cars->count() === 1);

        // Branch scoping is a join through car_branches, not a string match.
        $this->actingAs($company, 'company')
            ->get(route('company.office-cars', ['branch' => $branch->id, 'year' => 2021]))
            ->assertOk()
            ->assertViewHas('cars', fn ($cars) => $cars->first()?->id === $secondCarId);

        $this->actingAs($company, 'company')
            ->get(route('company.office-cars', ['car_model' => $model->id, 'car_type' => $type->id]))
            ->assertOk()
            ->assertViewHas('cars', fn ($cars) => $cars->count() === 2);
    }

    public function test_cars_list_search_matches_brand_and_notes(): void
    {
        $company = $this->actingCompanyUser();
        $branch = $this->branch($company, '34');
        [$brand] = $this->lookups();

        $this->createCar($company, [['branch_id' => $branch->id, 'stock' => 1]]);

        $this->actingAs($company, 'company')
            ->get(route('company.office-cars', ['q' => $brand->title_en]))
            ->assertOk()
            ->assertViewHas('cars', fn ($cars) => $cars->count() === 1);

        $this->actingAs($company, 'company')
            ->get(route('company.office-cars', ['q' => 'zzzz-no-such-car']))
            ->assertOk()
            ->assertViewHas('cars', fn ($cars) => $cars->isEmpty());
    }

    public function test_cars_list_ignores_a_branch_the_company_does_not_own(): void
    {
        $mine = $this->actingCompanyUser();
        $other = $this->actingCompanyUser();
        $theirBranch = $this->branch($other, '44');
        $myBranch = $this->branch($mine, '45');

        $this->createCar($mine, [['branch_id' => $myBranch->id, 'stock' => 2]]);

        $this->actingAs($mine, 'company')
            ->get(route('company.office-cars', ['branch' => $theirBranch->id]))
            ->assertOk()
            // Falls back to "all branches" instead of erroring or leaking.
            ->assertViewHas('branch_id', null)
            ->assertViewHas('cars', fn ($cars) => $cars->count() === 1);
    }

    public function test_cars_list_availability_tab_is_stock_derived(): void
    {
        $company = $this->actingCompanyUser();
        $full = $this->branch($company, '55');
        $empty = $this->branch($company, '66');

        $carId = $this->createCar($company, [
            ['branch_id' => $full->id, 'stock' => 2],
            ['branch_id' => $empty->id, 'stock' => 0],
        ]);

        $this->actingAs($company, 'company')
            ->get(route('company.office-cars', ['branch' => $empty->id, 'status' => 'available']))
            ->assertOk()
            ->assertViewHas('cars', fn ($cars) => $cars->isEmpty());

        $this->actingAs($company, 'company')
            ->get(route('company.office-cars', ['branch' => $empty->id, 'status' => 'unavailable']))
            ->assertOk()
            ->assertViewHas('cars', fn ($cars) => $cars->first()?->id === $carId);
    }

    public function test_cars_list_paginates(): void
    {
        $company = $this->actingCompanyUser();
        $branch = $this->branch($company, '67');

        for ($i = 0; $i < 12; $i++) {
            $this->createCar($company, [['branch_id' => $branch->id, 'stock' => 1]]);
        }

        $firstPage = $this->actingAs($company, 'company')
            ->get(route('company.office-cars'))
            ->assertOk();

        $this->assertCount(10, $firstPage->viewData('cars'));
        $this->assertSame(12, $firstPage->viewData('cars')->total());

        $secondPage = $this->actingAs($company, 'company')
            ->get(route('company.office-cars', ['page' => 2]))
            ->assertOk();

        $this->assertCount(2, $secondPage->viewData('cars'));
    }

    public function test_cars_list_page_size_falls_back_when_unsupported(): void
    {
        $company = $this->actingCompanyUser();
        $branch = $this->branch($company, '68');
        $this->createCar($company, [['branch_id' => $branch->id, 'stock' => 1]]);

        // Only 10/25/50/100 are offered, so anything else must not be trusted.
        $this->actingAs($company, 'company')
            ->get(route('company.office-cars', ['per_page' => 2]))
            ->assertOk()
            ->assertViewHas('cars', fn ($cars) => $cars->perPage() === 10);
    }

    public function test_cars_list_renders_filters_as_a_plain_get_form(): void
    {
        $company = $this->actingCompanyUser();
        $branch = $this->branch($company, '77');
        [$brand, , $model] = $this->lookups();

        $response = $this->actingAs($company, 'company')->get(route('company.office-cars'));

        $response->assertOk();
        $response->assertSee('method="GET"', false);
        $response->assertSee('action="'.route('company.office-cars').'"', false);
        $response->assertSee('name="brand"', false);
        $response->assertSee('name="car_model"', false);
        $response->assertSee('name="branch"', false);
        // Options come from the database, so the seeded lookups must appear.
        $response->assertSee(e($brand->title_en), false);
        $response->assertSee(e($model->title_en), false);
        $response->assertSee(e($branch->name_en), false);
    }

    public function test_cars_list_links_each_row_to_its_own_edit_page(): void
    {
        $company = $this->actingCompanyUser();
        $branch = $this->branch($company, '88');

        $carId = $this->createCar($company, [['branch_id' => $branch->id, 'stock' => 1]]);

        $this->actingAs($company, 'company')
            ->get(route('company.office-cars'))
            ->assertOk()
            ->assertSee(route('company.edit-car').'?car='.$carId, false);
    }

    public function test_availability_modal_renders_every_company_branch(): void
    {
        $company = $this->actingCompanyUser();
        $withStock = $this->branch($company, '99');
        $withoutStock = $this->branch($company, '00');

        $carId = $this->createCar($company, [['branch_id' => $withStock->id, 'stock' => 5]]);

        $this->actingAs($company, 'company')
            ->get(route('company.office-cars'))
            ->assertOk()
            // The modal lists every branch, so a car that holds nothing in a
            // branch still shows that branch with a real 0 rather than missing.
            ->assertSee('name="stocks['.$withStock->id.']"', false)
            ->assertSee('name="stocks['.$withoutStock->id.']"', false)
            ->assertSee(route('company.office-cars.stocks', ['car' => $carId]), false);
    }

    public function test_updating_branch_stocks_recalculates_the_car_count(): void
    {
        $company = $this->actingCompanyUser();
        $first = $this->branch($company, '13');
        $second = $this->branch($company, '14');

        $carId = $this->createCar($company, [
            ['branch_id' => $first->id, 'stock' => 2],
            ['branch_id' => $second->id, 'stock' => 3],
        ]);

        $this->actingAs($company, 'company')
            ->put(route('company.office-cars.stocks', $carId), [
                'stocks' => [$first->id => 7, $second->id => 0],
            ])
            ->assertRedirect(route('company.office-cars'));

        $car = Car::find($carId);
        $this->assertSame(7, (int) $car->count);
        $this->assertSame(7, (int) $car->branches()->where('branches.id', $first->id)->first()->pivot->stock);
        $this->assertSame(0, (int) $car->branches()->where('branches.id', $second->id)->first()->pivot->stock);
    }

    public function test_editing_stocks_from_the_availability_modal_is_forbidden_for_another_company(): void
    {
        $mine = $this->actingCompanyUser();
        $other = $this->actingCompanyUser();
        $theirBranch = $this->branch($other, '12');

        $carId = $this->createCar($other, [['branch_id' => $theirBranch->id, 'stock' => 1]]);

        $this->actingAs($mine, 'company')
            ->put(route('company.office-cars.stocks', $carId), [
                'stocks' => [$theirBranch->id => 10],
            ])
            ->assertForbidden();
    }

    public function test_updating_stocks_validates_the_payload(): void
    {
        $company = $this->actingCompanyUser();
        $branch = $this->branch($company, '19');
        $carId = $this->createCar($company, [['branch_id' => $branch->id, 'stock' => 1]]);

        $this->actingAs($company, 'company')
            ->put(route('company.office-cars.stocks', $carId), [
                'stocks' => [$branch->id => -5],
            ])
            ->assertSessionHasErrors('stocks.'.$branch->id);
    }

    public function test_deleting_a_car_removes_its_relations_and_image(): void
    {
        Storage::fake('public');
        $company = $this->actingCompanyUser();
        $branch = $this->branch($company, '17');

        $carId = $this->createCar($company, [['branch_id' => $branch->id, 'stock' => 2]]);

        $this->actingAs($company, 'company')
            ->delete(route('company.edit-car.destroy', $carId))
            ->assertRedirect(route('company.office-cars'))
            ->assertSessionHas('status', __('company.cars.deleted'));

        $this->assertNotSame('company.cars.deleted', __('company.cars.deleted'));

        $this->assertNull(Car::find($carId));
        $this->assertSame(0, DB::table('car_branches')->where('car_id', $carId)->count());
        $this->assertSame(0, DB::table('car_services')->where('car_id', $carId)->count());
        $this->assertSame(0, DB::table('car_subscriptions')->where('car_id', $carId)->count());
        $this->assertSame(0, DB::table('car_pricing')->where('car_id', $carId)->count());
        $this->assertSame(0, DB::table('car_details')->where('car_id', $carId)->count());
    }

    public function test_deleting_a_car_from_another_company_is_forbidden(): void
    {
        $mine = $this->actingCompanyUser();
        $other = $this->actingCompanyUser();
        $theirBranch = $this->branch($other, '18');

        $carId = $this->createCar($other, [['branch_id' => $theirBranch->id, 'stock' => 1]]);

        $this->actingAs($mine, 'company')
            ->delete(route('company.edit-car.destroy', $carId))
            ->assertForbidden();

        $this->assertNotNull(Car::find($carId));
    }
}
