<?php

namespace App\Services\Company;

use App\Models\Branch;
use App\Models\Driver;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class DriverService
{
    public function paginate(Request $request, int $companyId): LengthAwarePaginator
    {
        return Driver::query()
            ->forCompany($companyId)
            ->with('branches')
            ->when($request->filled('search'), function ($query) use ($request) {
                $search = $request->string('search')->trim();

                $query->where(function ($inner) use ($search) {
                    $inner->where('name', 'like', "%{$search}%")
                        ->orWhere('phone', 'like', "%{$search}%")
                        ->orWhere('identity_number', 'like', "%{$search}%")
                        ->orWhere('email', 'like', "%{$search}%");
                });
            })
            ->when($request->filled('status'), function ($query) use ($request) {
                $status = mb_strtolower(trim((string) $request->string('status')));

                if (in_array($status, ['active', 'inactive'], true)) {
                    $query->where('is_active', $status === 'active');
                }
            })
            ->orderByDesc('id')
            ->paginate($request->integer('per_page', 10))
            ->withQueryString();
    }

    public function create(array $data, int $companyId): Driver
    {
        return DB::transaction(function () use ($data, $companyId) {
            $driver = Driver::create($this->driverData($data, $companyId));

            $this->syncBranches($driver, $data);

            return $driver->fresh(['branches']);
        });
    }

    public function update(array $data, Driver $driver): Driver
    {
        abort_if($driver->company_id !== (int) auth('company')->id(), 403);

        return DB::transaction(function () use ($data, $driver) {
            $driver->update($this->driverData($data, $driver->company_id, $driver->lang));

            $this->syncBranches($driver, $data);

            return $driver->fresh(['branches']);
        });
    }

    public function destroy(Driver $driver): void
    {
        abort_if($driver->company_id !== (int) auth('company')->id(), 403);

        $driver->branches()->detach();
        $driver->delete();
    }

    public function toggleStatus(Driver $driver, bool $isActive): Driver
    {
        abort_if($driver->company_id !== (int) auth('company')->id(), 403);

        $driver->update(['is_active' => $isActive]);

        return $driver->fresh(['branches']);
    }

    public function branchOptions(int $companyId): Collection
    {
        return Branch::query()
            ->where('company_id', $companyId)
            ->orderBy('name_ar')
            ->get(['id', 'name_ar', 'name_en']);
    }

    public function exportRows(int $companyId): Collection
    {
        return Driver::query()
            ->forCompany($companyId)
            ->with('branches')
            ->orderByDesc('id')
            ->get()
            ->map(fn (Driver $driver) => [
                'name' => $driver->name,
                'phone' => ($driver->phone_code ?? '').($driver->phone ?? ''),
                'email' => $driver->email,
                'identity_number' => $driver->identity_number,
                'lang' => $driver->lang,
                'license_expiration_date' => $driver->license_expiration_date?->toDateString(),
                'branches' => $driver->branches
                    ->map(fn (Branch $branch) => app()->getLocale() === 'ar' ? $branch->name_ar : $branch->name_en)
                    ->implode(', '),
                'assigned_to_all_branches' => $driver->assigned_to_all_branches ? 'yes' : 'no',
                'is_verified' => $driver->is_verified ? 'yes' : 'no',
                'is_active' => $driver->is_active ? 'yes' : 'no',
                'created_at' => $driver->created_at?->toDateString(),
            ]);
    }

    private function driverData(array $data, int $companyId, ?string $currentLang = null): array
    {
        $attributes = [
            'company_id' => $companyId,
            'name' => $data['name'],
            'assigned_to_all_branches' => (bool) ($data['assigned_to_all_branches'] ?? false),
            'phone_code' => $data['phone_code'],
            'phone' => $data['phone'],
            'license_expiration_date' => $data['license_expiration_date'],
            'identity_number' => $data['identity_number'],
            'email' => $data['email'] ?? null,
            // The driver form does not expose a language field, so keep the
            // stored value on update and fall back to Arabic on create.
            'lang' => $data['lang'] ?? $currentLang ?? 'ar',
            'is_active' => (bool) ($data['is_active'] ?? true),
        ];

        // On create the password is required; on update a blank field means
        // "keep the current password" rather than "clear it".
        if (! empty($data['password'])) {
            $attributes['password'] = $data['password'];
        }

        return $attributes;
    }

    private function syncBranches(Driver $driver, array $data): void
    {
        $driver->branches()->sync($this->validBranchIds($driver->company_id, $data['branches'] ?? []));
    }

    /**
     * Branch ids are already ownership-checked by the form request; this second
     * pass guarantees the pivot can never reference another company's branch.
     *
     * @param  array<int, mixed>  $ids
     * @return array<int, int>
     */
    private function validBranchIds(int $companyId, array $ids): array
    {
        return Branch::query()
            ->where('company_id', $companyId)
            ->whereIn('id', $ids)
            ->pluck('id')
            ->map(fn ($id) => (int) $id)
            ->all();
    }
}
