<?php

namespace Database\Seeders;

use App\Models\Branch;
use App\Models\Brand;
use App\Models\Car;
use App\Models\CarAdditionalService;
use App\Models\CarModel;
use App\Models\CarType;
use App\Models\CompanyUser;
use App\Services\Company\CarService;
use Illuminate\Database\Seeder;

class CompanyCarSeeder extends Seeder
{
    use ResolvesCompanyOwner;

    /**
     * Fleet definition. Each row is one car, listed the way the add-car screen
     * asks for it: a brand/model/type/year, prices, subscriptions, services,
     * specs, and how many units sit in each branch.
     *
     * Lookups are referenced by their english title rather than a hardcoded id,
     * so the seeder keeps working after the lookup seeders are re-run.
     */
    public const FLEET = [
        [
            'brand' => 'Toyota', 'model' => 'Camry', 'type' => 'Sedan', 'year' => 2024,
            'power' => 'hybrid', 'door_count' => 4,
            'is_subscriber' => true,
            'note_ar' => 'كامري هجين، تكييف، كاميرات خلفية.',
            'note_en' => 'Hybrid Camry with AC and rear cameras.',
            'pricing' => ['day' => 250, 'week' => 1400, 'month' => 4200, 'free_km' => 200],
            'subscriptions' => [3, 6, 12],
            'services' => ['Additional Driver', 'Unlimited Mileage', 'CDW'],
            'stock' => ['Riyadh Branch' => 6, 'Jeddah Branch' => 4, 'Dammam Branch' => 3],
        ],
        [
            'brand' => 'Toyota', 'model' => 'Land Cruiser', 'type' => 'SUV', 'year' => 2023,
            'power' => 'diesel', 'door_count' => 5,
            'is_subscriber' => false,
            'note_ar' => 'لاندكروزر ديزل، مناسبة للرحلات البرية الطويلة.',
            'note_en' => 'Diesel Land Cruiser, suited for long trips.',
            'pricing' => ['day' => 650, 'week' => 3600, 'month' => 11000, 'free_km' => 300],
            'subscriptions' => [6, 12],
            'services' => ['Additional Driver', 'CDW'],
            'stock' => ['Riyadh Branch' => 3, 'Dammam Branch' => 2],
        ],
        [
            'brand' => 'Toyota', 'model' => 'Highlander', 'type' => 'SUV', 'year' => 2025,
            'power' => 'petrol', 'door_count' => 5,
            'is_subscriber' => true,
            'note_ar' => 'هايلاندر عائلية، بانوراما وبلوتوث.',
            'note_en' => 'Family Highlander with panorama roof and bluetooth.',
            'pricing' => ['day' => 420, 'week' => 2300, 'month' => 7000, 'free_km' => 250],
            'subscriptions' => [3, 6, 12],
            'services' => ['Additional Driver', 'Unlimited Mileage'],
            'stock' => ['Riyadh Branch' => 4, 'Jeddah Branch' => 2, 'Abha Branch' => 1],
        ],
        [
            'brand' => 'Nissan', 'model' => 'Yaris', 'type' => 'Hatchback', 'year' => 2022,
            'power' => 'petrol', 'door_count' => 4,
            'is_subscriber' => false,
            'note_ar' => 'ياريس اقتصادية، مناسبة للتنقل داخل المدينة.',
            'note_en' => 'Economical Yaris, good for city driving.',
            'pricing' => ['day' => 150, 'week' => 850, 'month' => 2600, 'free_km' => 150],
            'subscriptions' => [1, 3, 6],
            'services' => ['Additional Driver'],
            'stock' => ['Jeddah Branch' => 5, 'Madinah Branch' => 3, 'Riyadh Branch' => 4],
        ],
        [
            'brand' => 'Hyundai', 'model' => 'Tucson', 'type' => 'SUV', 'year' => 2023,
            'power' => 'petrol', 'door_count' => 5,
            'is_subscriber' => true,
            'note_ar' => 'توسان، مع شاشة ملاحة ونظام مانع سرقة.',
            'note_en' => 'Tucson with navigation and immobiliser.',
            'pricing' => ['day' => 280, 'week' => 1550, 'month' => 4800, 'free_km' => 200],
            'subscriptions' => [3, 6],
            'services' => ['Additional Driver', 'CDW', 'Non-Smoker Car'],
            'stock' => ['Riyadh Branch' => 2, 'Abha Branch' => 2],
        ],
        [
            'brand' => 'Kia', 'model' => 'Cerato', 'type' => 'Sedan', 'year' => 2022,
            'power' => 'petrol', 'door_count' => 4,
            'is_subscriber' => false,
            'note_ar' => 'سيراتو، حالة جديدة.',
            'note_en' => 'Cerato, brand new condition.',
            'pricing' => ['day' => 180, 'week' => 1000, 'month' => 3000, 'free_km' => 150],
            'subscriptions' => [1, 3],
            'services' => ['Additional Driver', 'Unlimited Mileage'],
            'stock' => ['Jeddah Branch' => 3, 'Madinah Branch' => 2],
        ],
        [
            'brand' => 'Kia', 'model' => 'Sportage', 'type' => 'SUV', 'year' => 2021,
            'power' => 'petrol', 'door_count' => 4,
            'is_subscriber' => false,
            'note_ar' => 'سبورتاج، خيار اقتصادي للعائلات.',
            'note_en' => 'Sportage, an affordable family option.',
            'pricing' => ['day' => 190, 'week' => 1050, 'month' => 3200, 'free_km' => 150],
            'subscriptions' => [1, 3],
            'services' => ['Additional Driver'],
            'stock' => ['Madinah Branch' => 4, 'Abha Branch' => 3],
        ],
        [
            'brand' => 'Hyundai', 'model' => 'Sonata', 'type' => 'Sedan', 'year' => 2023,
            'power' => 'petrol', 'door_count' => 4,
            'is_subscriber' => true,
            'note_ar' => 'سوناتا، قيادة مريحة ومساحة داخلية واسعة.',
            'note_en' => 'Sonata, comfortable drive with roomy cabin.',
            'pricing' => ['day' => 320, 'week' => 1800, 'month' => 5500, 'free_km' => 250],
            'subscriptions' => [6, 12],
            'services' => ['Additional Driver', 'CDW'],
            'stock' => ['Riyadh Branch' => 2, 'Dammam Branch' => 1],
        ],
        [
            'brand' => 'Ford', 'model' => 'Explorer', 'type' => 'SUV', 'year' => 2022,
            'power' => 'petrol', 'door_count' => 7,
            'is_subscriber' => false,
            'note_ar' => 'إكسبلورر، سبعة مقاعد.',
            'note_en' => 'Explorer, seven seats.',
            'pricing' => ['day' => 480, 'week' => 2700, 'month' => 8200, 'free_km' => 300],
            'subscriptions' => [6],
            'services' => ['Additional Driver', 'CDW'],
            'stock' => ['Riyadh Branch' => 1, 'Abha Branch' => 1],
        ],
    ];

    public function __construct(private readonly CarService $service) {}

    public function run(): void
    {
        $owner = $this->owner();

        if (! $owner) {
            $this->command?->warn('CompanyCarSeeder: no company user found, skipping.');

            return;
        }

        $branches = $this->branches($owner);
        $serviceIds = $this->serviceIds();
        $created = 0;
        $skipped = 0;

        foreach (self::FLEET as $entry) {
            $model = CarModel::query()->where('title_en', $entry['model'])->first();
            $brand = Brand::query()->where('title_en', $entry['brand'])->first();
            $type = CarType::query()->where('title_en', $entry['type'])->first();

            if (! $model || ! $brand || ! $type) {
                $this->command?->warn(
                    "CompanyCarSeeder: skipping {$entry['brand']} {$entry['model']}, run the lookup seeders first."
                );

                continue;
            }

            // Idempotency: a model/year pair that already sits in one of the
            // company's branches is left alone, so the seeder can be re-run
            // without stacking up duplicate cars.
            if ($this->alreadySeeded($owner, $model, $entry['year'])) {
                $skipped++;

                continue;
            }

            $branchRows = $this->branchRows($entry['stock'], $branches);

            if (! $branchRows) {
                $this->command?->warn(
                    "CompanyCarSeeder: no branches matched for {$entry['model']}, skipping."
                );

                continue;
            }

            $this->service->create(
                $this->payload($entry, $brand, $type, $model, $branchRows, $serviceIds),
                $owner->id
            );

            $created++;
        }

        $this->command?->info("CompanyCarSeeder: {$created} cars created, {$skipped} already existed.");
    }

    private function payload(array $entry, Brand $brand, CarType $type, CarModel $model, array $branchRows, array $serviceIds): array
    {
        $pricing = $entry['pricing'];

        return [
            'car_brand_id' => $brand->id,
            'car_type_id' => $type->id,
            'car_model_id' => $model->id,
            'year' => $entry['year'],
            'note_ar' => $entry['note_ar'],
            'note_en' => $entry['note_en'],
            'is_subscriber' => $entry['is_subscriber'],
            'pricing' => [
                'day_price' => $pricing['day'],
                'day_lowest_price' => (int) round($pricing['day'] * 0.9),
                'week_price' => $pricing['week'],
                'week_lowest_price' => (int) round($pricing['week'] * 0.9),
                'month_price' => $pricing['month'],
                'month_lowest_price' => (int) round($pricing['month'] * 0.9),
                'free_km' => $pricing['free_km'],
                'free_km_price' => 0.5,
            ],
            'subscriptions' => array_map(fn (int $months) => [
                'month_count' => $months,
                // Long subscriptions get a bigger discount, like the add screen.
                'price' => (int) round($pricing['month'] * $months),
                'lowest_price' => (int) round($pricing['month'] * $months * (1 - min(0.2, $months * 0.01))),
            ], $entry['subscriptions']),
            'services' => array_values(array_filter(array_map(
                fn (string $title) => isset($serviceIds[$title])
                    ? ['car_additional_service_id' => $serviceIds[$title], 'price' => 50]
                    : null,
                $entry['services']
            ))),
            'branches' => $branchRows,
            'details' => [
                'power' => $entry['power'],
                'door_count' => $entry['door_count'],
                'has_navigation' => true,
                'has_bluetooth' => true,
                'has_sensors' => in_array($entry['year'], [2023, 2024, 2025], true),
                'has_background_camera' => true,
            ],
        ];
    }

    /**
     * Maps the fleet's english branch names to ids, and reports the ones the
     * BranchSeeder did not create so a typo cannot silently drop stock.
     */
    private function branchRows(array $stock, array $branches): array
    {
        $rows = [];

        foreach ($stock as $name => $units) {
            if (! isset($branches[$name])) {
                $this->command?->warn("CompanyCarSeeder: branch '{$name}' is missing, its stock was skipped.");

                continue;
            }

            $rows[] = ['branch_id' => $branches[$name], 'stock' => $units];
        }

        return $rows;
    }

    private function alreadySeeded(CompanyUser $owner, CarModel $model, int $year): bool
    {
        return Car::query()
            ->where('car_model_id', $model->id)
            ->where('year', $year)
            ->whereHas(
                'branches',
                fn ($q) => $q->where('branches.company_id', $owner->id)
            )
            ->exists();
    }

    private function branches(CompanyUser $owner): array
    {
        return Branch::query()
            ->where('company_id', $owner->id)
            ->pluck('id', 'name_en')
            ->all();
    }

    private function serviceIds(): array
    {
        return CarAdditionalService::query()->pluck('id', 'title_en')->all();
    }
}
