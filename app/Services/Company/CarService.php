<?php

namespace App\Services\Company;

use App\Models\Branch;
use App\Models\Brand;
use App\Models\Car;
use App\Models\CarAdditionalService;
use App\Models\CarDetail;
use App\Models\CarModel;
use App\Models\CarType;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class CarService
{
    public const YEAR_RANGE = 10;

    public const MONTH_RANGE = 12;

    public const DOOR_COUNTS = [2, 3, 4, 5, 6, 7];

    public const CAR_RELATIONS = [
        'brand', 'type', 'carModel', 'pricing', 'details',
        'subscriptions', 'carServices.additionalService', 'branches',
    ];

    /**
     * Every list the add/edit car screen needs, resolved from the database so
     * the page ships no hardcoded brands, types, models or services.
     */
    public function options(int $companyId): array
    {
        return [
            'branches' => $this->branches($companyId),
            'brands' => $this->titles(
                Brand::query()->orderBy($this->localeColumn('title'))->get(['id', 'title_ar', 'title_en'])
            ),
            'car_types' => $this->titles(
                CarType::query()->where('is_active', true)->orderBy($this->localeColumn('title'))->get(['id', 'title_ar', 'title_en'])
            ),
            'car_models' => $this->titles(
                CarModel::query()->orderBy($this->localeColumn('title'))->get(['id', 'title_ar', 'title_en'])
            ),
            'car_additional_services' => $this->titles(
                CarAdditionalService::query()->orderBy($this->localeColumn('title'))->get(['id', 'title_ar', 'title_en'])
            ),
            'powers' => CarDetail::POWERS,
            'power_labels' => $this->powerLabels(),
            'door_counts' => self::DOOR_COUNTS,
            'years' => $this->years(),
            'month_counts' => range(1, self::MONTH_RANGE),
        ];
    }

    /**
     * The car list screen ("عرض السيارات"). Rows are the company's own cars,
     * the "available" column is the stock the car actually holds in the branch
     * currently being viewed, and every filter option is resolved here so the
     * page can be re-rendered from the query string with no client filtering.
     */
    public function listCars(int $companyId, array $filters = []): array
    {
        $branchId = $filters['branch'] ?? null;
        $branchId = filled($branchId) ? (int) $branchId : null;

        if ($branchId !== null && ! $this->companyBranches($companyId)->contains('id', $branchId)) {
            $branchId = null;
        }

        $query = $this->companyCarsQuery($companyId)
            ->with(['brand', 'carModel', 'type', 'branches'])
            // Choosing a branch scopes the list to the cars assigned to it. The
            // stock threshold is left to the status filter so "not available"
            // can still show a car that holds 0 here.
            ->when($branchId !== null, fn ($q) => $q->whereHas(
                'branches',
                fn ($b) => $b->where('branches.id', $branchId)
            ));

        $this->applyListFilters($query, $filters);

        $status = in_array($filters['status'] ?? null, ['available', 'unavailable'], true)
            ? $filters['status']
            : 'all';

        // Availability is a read-only, stock-derived state: a car is available in
        // the viewed branch when it holds at least one unit there, otherwise when
        // its overall count is above zero. Filtering in SQL keeps the paginator
        // totals honest instead of filtering an already-fetched page.
        if ($status !== 'all') {
            $wanted = $status === 'available';
            $branchIdForStatus = $branchId;

            $query->where(function ($q) use ($branchIdForStatus, $wanted) {
                if ($branchIdForStatus === null) {
                    $q->where('count', $wanted ? '>' : '=', 0);

                    return;
                }

                $q->whereHas(
                    'branches',
                    fn ($b) => $b->where('branches.id', $branchIdForStatus)
                        ->where('car_branches.stock', $wanted ? '>' : '=', 0)
                );
            });
        }

        $sort = in_array($filters['sort'] ?? null, ['year', 'available', 'brand'], true)
            ? $filters['sort']
            : null;

        match ($sort) {
            'year' => $query->orderByDesc('year'),
            'available' => $query->orderByDesc('count'),
            'brand' => $query->orderBy('car_brand_id'),
            default => $query->orderByDesc('id'),
        };

        $cars = $query->paginate(
            $this->perPage($filters),
            ['*'],
            'page',
            max(1, (int) ($filters['page'] ?? 1))
        )->withQueryString();

        $branchStocks = [];
        if ($branchId !== null) {
            foreach ($cars as $car) {
                $branchStocks[$car->id] = (int) ($car->branches->firstWhere('id', $branchId)?->pivot->stock ?? 0);
            }
        }

        return [
            'cars' => $cars,
            'branch_id' => $branchId,
            'status' => $status,
            'sort' => $sort,
            'branch_stocks' => $branchStocks,
            'branches' => $this->branches($companyId),
            'brands' => $this->titles(Brand::query()->orderBy($this->localeColumn('title'))->get(['id', 'title_ar', 'title_en'])),
            'car_types' => $this->titles(CarType::query()->where('is_active', true)->orderBy($this->localeColumn('title'))->get(['id', 'title_ar', 'title_en'])),
            'car_models' => $this->titles(CarModel::query()->orderBy($this->localeColumn('title'))->get(['id', 'title_ar', 'title_en'])),
            'years' => $this->years(),
        ];
    }

    /**
     * The availability matrix ("التوفر"): one row per branch, one column per
     * car. A cell is exactly one car_branches row, so the stepper edits real
     * stock instead of a hardcoded number, and the row total is the branch's
     * own fleet size. The column list is the company's real cars, so the table
     * can get wide and scrolls sideways.
     */
    public function availabilityMatrix(int $companyId, array $filters = []): array
    {
        $status = in_array($filters['status'] ?? null, ['active', 'inactive'], true)
            ? $filters['status']
            : 'all';

        $branches = $this->branches($companyId);

        $branchId = $filters['branch'] ?? null;
        $branchId = filled($branchId) ? (int) $branchId : null;

        if ($branchId !== null && ! $branches->contains('id', $branchId)) {
            $branchId = null;
        }

        // A branch filter narrows the rows, not the columns.
        $rows = $branchId === null
            ? $branches
            : $branches->where('id', $branchId)->values();

        $cars = $this->companyCarsQuery($companyId)
            ->with(['brand', 'carModel', 'type'])
            ->when($status === 'active', fn ($q) => $q->where('is_active', true))
            ->when($status === 'inactive', fn ($q) => $q->where('is_active', false))
            ->tap(fn ($q) => $this->applyListFilters($q, $filters))
            ->orderByDesc('year')
            ->orderBy('id')
            ->get(['id', 'car_brand_id', 'car_type_id', 'car_model_id', 'year', 'is_active']);

        $stocks = [];
        $branchTotals = [];
        $carTotals = [];

        foreach ($rows as $branch) {
            $branchTotals[$branch['id']] = 0;
        }

        foreach ($cars as $car) {
            $carTotals[$car->id] = 0;
        }

        if ($rows->isNotEmpty() && $cars->isNotEmpty()) {
            $pivot = DB::table('car_branches')
                ->whereIn('branch_id', $rows->pluck('id'))
                ->whereIn('car_id', $cars->pluck('id'))
                ->get(['branch_id', 'car_id', 'stock']);

            foreach ($pivot as $line) {
                $stock = (int) $line->stock;
                $stocks[$line->branch_id.':'.$line->car_id] = $stock;
                $branchTotals[$line->branch_id] += $stock;
                $carTotals[$line->car_id] += $stock;
            }
        }

        return [
            'branches' => $branches,
            'rows' => $rows,
            'cars' => $cars,
            'stocks' => $stocks,
            'branch_totals' => $branchTotals,
            'car_totals' => $carTotals,
            'grand_total' => array_sum($branchTotals),
            'branch_id' => $branchId,
            'status' => $status,
            'brands' => $this->titles(Brand::query()->orderBy($this->localeColumn('title'))->get(['id', 'title_ar', 'title_en'])),
            'car_types' => $this->titles(CarType::query()->where('is_active', true)->orderBy($this->localeColumn('title'))->get(['id', 'title_ar', 'title_en'])),
            'car_models' => $this->titles(CarModel::query()->orderBy($this->localeColumn('title'))->get(['id', 'title_ar', 'title_en'])),
            'years' => $this->years(),
        ];
    }

    /**
     * One cell of the availability matrix. Creating the row on first write is
     * what lets a car that was never assigned to a branch still be stocked
     * from this screen.
     */
    public function setMatrixStock(Car $car, int $branchId, int $stock, int $companyId): int
    {
        abort_if(! $this->ownsCar($car, $companyId), 403);
        abort_if(! $this->companyBranches($companyId)->contains('id', $branchId), 403);

        $stock = max(0, $stock);

        DB::table('car_branches')->updateOrInsert(
            ['car_id' => $car->id, 'branch_id' => $branchId],
            ['stock' => $stock, 'updated_at' => now(), 'created_at' => now()]
        );

        return $stock;
    }

    /**
     * Flips the availability switch for a car. The flag lives on cars, so it
     * applies to every branch the car sits in — see the note in the view.
     */
    public function toggleActive(Car $car, int $companyId): bool
    {
        abort_if(! $this->ownsCar($car, $companyId), 403);

        $car->forceFill(['is_active' => ! $car->is_active])->save();

        return (bool) $car->fresh()->is_active;
    }

    /**
     * Saves the per-branch stock edited from the availability modal. The map is
     * keyed by branch id; branches the company does not own are rejected rather
     * than silently ignored, and a branch dropped to 0 is kept as a 0 so the
     * "available" state stays honest.
     */
    public function updateStocks(array $stocks, Car $car, int $companyId): Car
    {
        abort_if(! $this->ownsCar($car, $companyId), 403);

        $branchIds = array_map('intval', array_keys($stocks));
        $owned = $this->companyBranches($companyId)->pluck('id')->map(fn ($id) => (int) $id);

        abort_if($branchIds !== array_values(array_filter($branchIds, fn ($id) => $owned->contains($id))), 403);

        DB::transaction(function () use ($car, $stocks) {
            foreach ($stocks as $branchId => $stock) {
                $car->branches()->syncWithoutDetaching([
                    (int) $branchId => ['stock' => max(0, (int) $stock)],
                ]);
            }

            $car->count = (int) $car->branches()->sum('stock');
            $car->save();
        });

        return $car->refresh();
    }

    public function delete(Car $car, int $companyId): void
    {
        abort_if(! $this->ownsCar($car, $companyId), 403);

        DB::transaction(function () use ($car) {
            if ($car->image) {
                Storage::disk('public')->delete($car->image);
            }

            $car->carBranches()->delete();
            $car->carServices()->delete();
            $car->subscriptions()->delete();
            $car->pricing()->delete();
            $car->details()->delete();
            $car->delete();
        });
    }

    private function companyBranches(int $companyId): Collection
    {
        return Branch::query()
            ->where('company_id', $companyId)
            ->orderBy($this->localeColumn('name'))
            ->get(['id', 'name_ar', 'name_en']);
    }

    private function companyCarsQuery(int $companyId)
    {
        // Ownership travels car -> car_branches -> branch.company_id, because
        // `cars` deliberately has no company_id of its own. `branches` is a
        // belongsToMany through car_branches, so the company filter belongs on
        // the related Branch query itself.
        return Car::query()->whereHas(
            'branches',
            fn ($b) => $b->where('branches.company_id', $companyId)
        );
    }

    private function applyListFilters($query, array $filters): void
    {
        $query
            ->when(filled($filters['brand'] ?? null), fn ($q) => $q->where('car_brand_id', (int) $filters['brand']))
            ->when(filled($filters['car_type'] ?? null), fn ($q) => $q->where('car_type_id', (int) $filters['car_type']))
            ->when(filled($filters['car_model'] ?? null), fn ($q) => $q->where('car_model_id', (int) $filters['car_model']))
            ->when(filled($filters['year'] ?? null), fn ($q) => $q->where('year', (int) $filters['year']));

        if (filled($filters['q'] ?? null)) {
            $term = '%'.str_replace(['%', '_'], ['\%', '\_'], trim($filters['q'])).'%';
            $query->where(function ($q) use ($term) {
                $q->whereHas('brand', fn ($b) => $this->searchTitle($b, $term))
                    ->orWhereHas('carModel', fn ($m) => $this->searchTitle($m, $term))
                    ->orWhere('note_ar', 'like', $term)
                    ->orWhere('note_en', 'like', $term);
            });
        }
    }

    private function searchTitle($query, string $term)
    {
        $query->where(function ($q) use ($term) {
            $q->where('title_ar', 'like', $term)->orWhere('title_en', 'like', $term);
        });
    }

    private function perPage(array $filters): int
    {
        $size = (int) ($filters['per_page'] ?? 10);

        return in_array($size, [10, 25, 50, 100], true) ? $size : 10;
    }

    public function create(array $data, int $companyId, ?UploadedFile $image = null): Car
    {
        $this->guardBranches($data['branches'], $companyId);

        $car = DB::transaction(function () use ($data, $image) {
            $car = new Car;
            $car->fill($this->carData($data));
            $car->image = $this->storeImage($image);
            $car->save();

            $this->syncRelations($car, $data);

            return $car;
        });

        return $car->load(self::CAR_RELATIONS);
    }

    public function update(array $data, Car $car, int $companyId, ?UploadedFile $image = null): Car
    {
        abort_if(! $this->ownsCar($car, $companyId), 403);

        $this->guardBranches($data['branches'], $companyId);

        DB::transaction(function () use ($data, $car, $image) {
            $car->fill($this->carData($data));

            if ($image) {
                $this->deleteImage($car->image);
                $car->image = $this->storeImage($image);
            }

            $car->save();

            $this->syncRelations($car, $data);
        });

        return $car->load(self::CAR_RELATIONS);
    }

    /**
     * A car belongs to the company that owns any branch it is stocked in.
     */
    public function ownsCar(Car $car, int $companyId): bool
    {
        return $car->carBranches()
            ->whereHas('branch', fn ($query) => $query->where('company_id', $companyId))
            ->exists();
    }

    private function branches(int $companyId): Collection
    {
        return $this->titles(
            Branch::query()
                ->where('company_id', $companyId)
                ->orderBy($this->localeColumn('name'))
                ->get(['id', 'name_ar', 'name_en'])
        );
    }

    /**
     * Keeps both language columns and adds a locale-aware "title" so the
     * frontend can render either without duplicating the locale check.
     */
    private function titles(Collection $rows): Collection
    {
        $isArabic = app()->getLocale() === 'ar';

        return $rows->map(function (object $row) use ($isArabic) {
            $ar = $row->title_ar ?? $row->name_ar;
            $en = $row->title_en ?? $row->name_en;

            return [
                'id' => $row->id,
                'title_ar' => $ar,
                'title_en' => $en,
                'title' => ($isArabic ? $ar : $en) ?: $ar ?: $en,
            ];
        })->values();
    }

    /**
     * Sorts lookups by the column matching the active locale so the list reads
     * naturally in both languages.
     */
    private function localeColumn(string $base): string
    {
        return app()->getLocale() === 'ar' ? $base.'_ar' : $base.'_en';
    }

    private function powerLabels(): array
    {
        $labels = [];

        foreach (CarDetail::POWERS as $power) {
            $labels[$power] = __('company.cars.powers.'.$power);
        }

        return $labels;
    }

    private function years(): array
    {
        $current = (int) now()->year;

        return range($current, $current - self::YEAR_RANGE);
    }

    /**
     * Every submitted branch must belong to the authenticated company.
     */
    private function guardBranches(array $branches, int $companyId): void
    {
        $requested = array_unique(array_column($branches, 'branch_id'));

        $owned = Branch::query()
            ->where('company_id', $companyId)
            ->whereIn('id', $requested)
            ->count();

        abort_if($owned !== count($requested), 403);
    }

    private function carData(array $data): array
    {
        return [
            'car_brand_id' => $data['car_brand_id'],
            'car_type_id' => $data['car_type_id'],
            'car_model_id' => $data['car_model_id'],
            'year' => $data['year'] ?? null,
            'note_ar' => $data['note_ar'] ?? null,
            'note_en' => $data['note_en'] ?? null,
            'is_subscriber' => (bool) ($data['is_subscriber'] ?? false),
            'count' => array_sum(array_column($data['branches'], 'stock')),
        ];
    }

    private function syncRelations(Car $car, array $data): void
    {
        $car->pricing()->updateOrCreate([], $this->pricingData($data['pricing'] ?? []));
        $car->details()->updateOrCreate([], $this->detailData($data['details'] ?? []));

        $car->subscriptions()->delete();
        $car->subscriptions()->createMany($this->subscriptionRows($data['subscriptions'] ?? []));

        $car->carServices()->delete();
        $car->carServices()->createMany($this->serviceRows($data['services'] ?? []));

        $car->carBranches()->delete();
        $car->carBranches()->createMany($this->branchRows($data['branches']));
    }

    private function pricingData(array $pricing): array
    {
        return [
            'day_price' => $pricing['day_price'] ?? 0,
            'day_lowest_price' => $pricing['day_lowest_price'] ?? 0,
            'week_price' => $pricing['week_price'] ?? 0,
            'week_lowest_price' => $pricing['week_lowest_price'] ?? 0,
            'month_price' => $pricing['month_price'] ?? 0,
            'month_lowest_price' => $pricing['month_lowest_price'] ?? 0,
            'free_km' => $pricing['free_km'] ?? 0,
            'free_km_price' => $pricing['free_km_price'] ?? 0,
        ];
    }

    private function detailData(array $details): array
    {
        return [
            'power' => $details['power'] ?? null,
            'door_count' => $details['door_count'] ?? 4,
            'has_navigation' => (bool) ($details['has_navigation'] ?? false),
            'has_bluetooth' => (bool) ($details['has_bluetooth'] ?? false),
            'has_panorama' => (bool) ($details['has_panorama'] ?? false),
            'has_usp' => (bool) ($details['has_usp'] ?? false),
            'has_background_camera' => (bool) ($details['has_background_camera'] ?? false),
            'has_sensors' => (bool) ($details['has_sensors'] ?? false),
            'has_apple_play' => (bool) ($details['has_apple_play'] ?? false),
        ];
    }

    private function subscriptionRows(array $subscriptions): array
    {
        return array_map(fn (array $row) => [
            'month_count' => $row['month_count'],
            'price' => $row['price'] ?? 0,
            'lowest_price' => $row['lowest_price'] ?? 0,
        ], $subscriptions);
    }

    private function serviceRows(array $services): array
    {
        return array_map(fn (array $row) => [
            'car_additional_service_id' => $row['car_additional_service_id'],
            'price' => $row['price'] ?? 0,
        ], $services);
    }

    private function branchRows(array $branches): array
    {
        return array_map(fn (array $row) => [
            'branch_id' => $row['branch_id'],
            'stock' => $row['stock'] ?? 0,
        ], $branches);
    }

    private function storeImage(?UploadedFile $image): ?string
    {
        return $image ? $image->store('cars', 'public') : null;
    }

    private function deleteImage(?string $path): void
    {
        if ($path) {
            Storage::disk('public')->delete($path);
        }
    }
}
