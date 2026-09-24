<?php

namespace App\Services\Company;

use App\Models\Branch;
use App\Models\CompanyVacation;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

class BranchService
{
    public const STATUS_PENDING = 'pending';

    public function paginate(Request $request, int $companyId): LengthAwarePaginator
    {
        return Branch::query()
            ->where('company_id', $companyId)
            ->with([
                'airports',
                'trainStations',
                'workingHours',
                'deliveryHours',
                'driverService',
                'childSeatService',
                'airportFastDelivery',
                'specialDeliveryService',
                'deliveryOnlyPrices',
                'branchVacations',
            ])
            ->when($request->filled('search'), function ($query) use ($request) {
                $search = $request->string('search')->trim();

                $query->where(function ($inner) use ($search) {
                    $inner->where('name_ar', 'like', "%{$search}%")
                        ->orWhere('name_en', 'like', "%{$search}%")
                        ->orWhere('person_name', 'like', "%{$search}%")
                        ->orWhere('phone_number', 'like', "%{$search}%");
                });
            })
            ->when($request->filled('status'), fn ($query) => $query->where('status', $request->string('status')))
            ->orderByDesc('id')
            ->paginate($request->integer('per_page', 10))
            ->withQueryString();
    }

    public function create(array $data, int $companyId): Branch
    {
        $branch = Branch::create(
            $this->branchData($data, $companyId)
        );

        $this->syncRelations($branch, $data);

        return $branch->fresh([
            'airports',
            'trainStations',
            'workingHours',
            'deliveryHours',
            'driverService',
            'childSeatService',
            'airportFastDelivery',
            'specialDeliveryService',
            'deliveryOnlyPrices',
            'branchVacations',
        ]);
    }

    public function update(array $data, Branch $branch): Branch
    {
        abort_if($branch->company_id !== (int) auth('company')->id(), 403);

        $branch->update($this->branchData($data, $branch->company_id));

        $this->syncRelations($branch, $data);

        return $branch->fresh([
            'airports',
            'trainStations',
            'workingHours',
            'deliveryHours',
            'driverService',
            'childSeatService',
            'airportFastDelivery',
            'specialDeliveryService',
            'deliveryOnlyPrices',
            'branchVacations',
        ]);
    }

    public function destroy(Branch $branch): void
    {
        abort_if($branch->company_id !== (int) auth('company')->id(), 403);

        $branch->delete();
    }

    public function activeHolidays(int $companyId): Collection
    {
        return CompanyVacation::query()
            ->where('company_id', $companyId)
            ->with('vacation:id,name_ar,name_en,date')
            ->orderByDesc('id')
            ->get()
            ->map(fn (CompanyVacation $cv) => [
                'id' => $cv->id,
                'name_ar' => $cv->vacation?->name_ar,
                'name_en' => $cv->vacation?->name_en,
                'date' => $cv->vacation?->date?->toDateString(),
                'day_count' => (int) $cv->day_count,
                'end_date' => $cv->vacation?->date?->addDays((int) $cv->day_count)->toDateString(),
            ]);
    }

    public function exportRows(int $companyId): Collection
    {
        return Branch::query()
            ->where('company_id', $companyId)
            ->with([
                'airports',
                'trainStations',
                'workingHours',
                'deliveryHours',
                'driverService',
                'childSeatService',
                'airportFastDelivery',
                'specialDeliveryService',
                'deliveryOnlyPrices',
                'branchVacations',
            ])
            ->orderByDesc('id')
            ->get()
            ->map(fn (Branch $branch) => [
                'name_ar' => $branch->name_ar,
                'name_en' => $branch->name_en,
                'branch_type' => $branch->branch_type,
                'person_name' => $branch->person_name,
                'person_email' => $branch->person_email,
                'phone' => ($branch->phone_code ?? '').($branch->phone_number ?? ''),
                'general_phone' => ($branch->general_phone_code ?? '').($branch->general_phone_number ?? ''),
                'address' => $branch->address,
                'latitude' => $branch->latitude,
                'longitude' => $branch->longitude,
                'airports' => $branch->airports->map(fn ($a) => $a->title_en)->implode(', '),
                'train_stations' => $branch->trainStations->map(fn ($t) => $t->title_en)->implode(', '),
                'working_hours' => $this->hoursText($branch->workingHours),
                'delivery_hours' => $this->hoursText($branch->deliveryHours),
                'driver_day' => $branch->driverService?->day_price,
                'driver_week' => $branch->driverService?->week_price,
                'driver_month' => $branch->driverService?->month_price,
                'child_day' => $branch->childSeatService?->day_price,
                'child_week' => $branch->childSeatService?->week_price,
                'child_month' => $branch->childSeatService?->month_price,
                'airport_delivery' => $branch->airportFastDelivery?->price,
                'special_price' => $branch->specialDeliveryService?->price,
                'special_distance' => $branch->specialDeliveryService?->distance,
                'status' => $branch->status,
                'created_at' => $branch->created_at?->toDateString(),
            ]);
    }

    private function branchData(array $data, int $companyId): array
    {
        return [
            'company_id' => $companyId,
            'branch_type' => $data['branch_type'],
            'name_ar' => $data['name_ar'],
            'name_en' => $data['name_en'],
            'person_name' => $data['person_name'] ?? null,
            'person_email' => $data['person_email'] ?? null,
            'phone_code' => $data['phone_code'] ?? null,
            'phone_number' => $data['phone_number'] ?? null,
            'general_phone_code' => $data['general_phone_code'] ?? null,
            'general_phone_number' => $data['general_phone_number'] ?? null,
            'address' => $data['address'] ?? null,
            'latitude' => $data['latitude'] ?? null,
            'longitude' => $data['longitude'] ?? null,
            'is_airport_branch' => (bool) ($data['is_airport_branch'] ?? false),
            'is_train_station_branch' => (bool) ($data['is_train_station_branch'] ?? false),
            'notes_ar' => $data['notes_ar'] ?? null,
            'notes_en' => $data['notes_en'] ?? null,
            'status' => self::STATUS_PENDING,
        ];
    }

    private function syncRelations(Branch $branch, array $data): void
    {
        $branch->airports()->sync($data['airports'] ?? []);
        $branch->trainStations()->sync($data['train_stations'] ?? []);

        $this->syncHours($branch, 'workingHours', $data['working_hours'] ?? []);
        $this->syncHours($branch, 'deliveryHours', $data['delivery_hours'] ?? []);

        $singleServices = [
            'driverService' => 'driver_service',
            'childSeatService' => 'child_seat_service',
            'airportFastDelivery' => 'airport_fast_delivery',
            'specialDeliveryService' => 'special_delivery_service',
        ];

        foreach ($singleServices as $relation => $key) {
            $branch->$relation()->delete();

            if (! empty($data[$key])) {
                $branch->$relation()->create($this->serviceData($relation, $data));
            }
        }

        $branch->deliveryOnlyPrices()->delete();
        foreach ($data['delivery_only_prices'] ?? [] as $row) {
            $branch->deliveryOnlyPrices()->create([
                'distance' => $row['distance'],
                'price' => $row['price'],
            ]);
        }

        $this->syncVacations($branch, $data['vacations'] ?? []);
    }

    private function syncHours(Branch $branch, string $relation, array $hours): void
    {
        $branch->$relation()->delete();

        foreach ($hours as $hour) {
            $branch->$relation()->create([
                'day' => $hour['day'],
                'is_open' => (bool) ($hour['is_open'] ?? true),
                'from' => $this->nullableTime($hour['from'] ?? null),
                'to' => $this->nullableTime($hour['to'] ?? null),
            ]);
        }
    }

    private function serviceData(string $relation, array $data): array
    {
        $key = match ($relation) {
            'driverService' => 'driver_service',
            'childSeatService' => 'child_seat_service',
            'airportFastDelivery' => 'airport_fast_delivery',
            'specialDeliveryService' => 'special_delivery_service',
        };

        $input = $data[$key] ?? [];

        return match ($relation) {
            'driverService',
            'childSeatService' => [
                'day_price' => $input['day_price'] ?? null,
                'week_price' => $input['week_price'] ?? null,
                'month_price' => $input['month_price'] ?? null,
            ],
            'airportFastDelivery' => [
                'price' => $input['price'] ?? null,
            ],
            'specialDeliveryService' => [
                'price' => $input['price'] ?? null,
                'distance' => $input['distance'] ?? null,
            ],
        };
    }

    private function syncVacations(Branch $branch, array $ids): void
    {
        $valid = CompanyVacation::query()
            ->where('company_id', $branch->company_id)
            ->whereIn('id', $ids)
            ->pluck('id');

        $branch->branchVacations()->delete();
        $branch->branchVacations()->createMany(
            $valid->map(fn (int $id) => ['company_vacation_id' => $id])
        );
    }

    private function nullableTime(mixed $value): ?string
    {
        return $value !== null && $value !== '' ? $value : null;
    }

    private function hoursText(Collection $hours): string
    {
        return $hours->map(function ($hour) {
            $days = [
                'saturday' => 'Sat',
                'sunday' => 'Sun',
                'monday' => 'Mon',
                'tuesday' => 'Tue',
                'wednesday' => 'Wed',
                'thursday' => 'Thu',
                'friday' => 'Fri',
            ];

            $day = $days[$hour->day] ?? $hour->day;

            if (! (bool) $hour->is_open) {
                return "{$day}: off";
            }

            return "{$day}: {$hour->from}-{$hour->to}";
        })->implode('; ');
    }
}
