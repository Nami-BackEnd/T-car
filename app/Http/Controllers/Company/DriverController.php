<?php

namespace App\Http\Controllers\Company;

use App\Http\Requests\Company\DriverRequest;
use App\Models\Branch;
use App\Models\Country;
use App\Models\Driver;
use App\Services\Company\DriverService;
use App\Support\XlsxExporter;
use App\Traits\ApiResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class DriverController extends Controller
{
    use ApiResponse;

    public function __construct(private readonly DriverService $service) {}

    public function index(Request $request): JsonResponse
    {
        return $this->success($this->service->paginate($request, auth('company')->id()));
    }

    public function options(): JsonResponse
    {
        return $this->success($this->optionsData());
    }

    public function show(Driver $driver): JsonResponse
    {
        abort_if($driver->company_id !== (int) auth('company')->id(), 403);

        return $this->success([
            'driver' => $this->expose($driver),
            'options' => $this->optionsData(),
        ]);
    }

    public function store(DriverRequest $request): JsonResponse
    {
        $driver = $this->service->create($request->validated(), auth('company')->id());

        return $this->success(
            ['driver' => $this->expose($driver)],
            __('company.drivers.created')
        );
    }

    public function update(DriverRequest $request, Driver $driver): JsonResponse
    {
        $driver = $this->service->update($request->validated(), $driver);

        return $this->success(
            ['driver' => $this->expose($driver)],
            __('company.drivers.updated')
        );
    }

    public function destroy(Driver $driver): JsonResponse
    {
        $this->service->destroy($driver);

        return $this->success(message: __('company.drivers.deleted'));
    }

    public function toggleStatus(Request $request, Driver $driver): JsonResponse
    {
        $validated = $request->validate([
            'is_active' => ['required', 'boolean'],
        ]);

        $driver = $this->service->toggleStatus($driver, $validated['is_active']);

        return $this->success(
            ['driver' => $this->expose($driver)],
            __('company.drivers.status_updated')
        );
    }

    public function export(Request $request)
    {
        $rows = $this->service->exportRows(auth('company')->id());
        $headers = array_keys($rows->first() ?? []);

        $filename = 'drivers-'.now()->format('Y-m-d').'.xlsx';

        return response(XlsxExporter::build($headers, $rows), 200, [
            'Content-Type' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
            'Content-Disposition' => 'attachment; filename="'.$filename.'"',
        ]);
    }

    private function optionsData(): array
    {
        return [
            'branches' => $this->service->branchOptions(auth('company')->id()),
            'phone_codes' => Country::query()
                ->whereNotNull('phone_code')
                ->orderBy('title_ar')
                ->get(['id', 'title_ar', 'title_en', 'phone_code']),
            'languages' => [
                ['value' => 'ar', 'label' => __('company.drivers.language_arabic')],
                ['value' => 'en', 'label' => __('company.drivers.language_english')],
            ],
        ];
    }

    private function expose(Driver $driver): array
    {
        return [
            'id' => $driver->id,
            'company_id' => $driver->company_id,
            'name' => $driver->name,
            'assigned_to_all_branches' => (bool) $driver->assigned_to_all_branches,
            'phone_code' => $driver->phone_code,
            'phone' => $driver->phone,
            'email' => $driver->email,
            'identity_number' => $driver->identity_number,
            'lang' => $driver->lang,
            'license_expiration_date' => $driver->license_expiration_date?->toDateString(),
            'is_verified' => (bool) $driver->is_verified,
            'is_active' => (bool) $driver->is_active,
            'branches' => $driver->branches->map(fn (Branch $branch) => [
                'id' => $branch->id,
                'name_ar' => $branch->name_ar,
                'name_en' => $branch->name_en,
            ])->values(),
            'branch_ids' => $driver->branches->map(fn (Branch $branch) => (int) $branch->id)->values(),
            'created_at' => $driver->created_at?->toISOString(),
        ];
    }
}
