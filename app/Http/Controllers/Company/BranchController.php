<?php

namespace App\Http\Controllers\Company;

use App\Http\Requests\Company\BranchRequest;
use App\Models\Airport;
use App\Models\Branch;
use App\Models\TrainStation;
use App\Services\Company\BranchService;
use App\Support\XlsxExporter;
use App\Traits\ApiResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class BranchController extends Controller
{
    use ApiResponse;

    public function __construct(private readonly BranchService $service) {}

    public function index(Request $request): JsonResponse
    {
        return $this->success($this->service->paginate($request, auth('company')->id()));
    }

    public function options(): JsonResponse
    {
        return $this->success($this->optionsData());
    }

    public function show(Branch $branch): JsonResponse
    {
        abort_if($branch->company_id !== (int) auth('company')->id(), 403);

        return $this->success([
            'branch' => $this->expose($branch),
            'options' => $this->optionsData(),
        ]);
    }

    private function optionsData(): array
    {
        return [
            'airports' => Airport::orderBy('title_ar')->get(['id', 'title_ar', 'title_en']),
            'train_stations' => TrainStation::orderBy('title_ar')->get(['id', 'title_ar', 'title_en']),
            'vacations' => $this->service->activeHolidays(auth('company')->id()),
        ];
    }

    public function store(BranchRequest $request): JsonResponse
    {
        $branch = $this->service->create($request->validated(), auth('company')->id());

        return $this->success(
            ['branch' => $this->expose($branch)],
            __('company.branches.created')
        );
    }

    public function update(BranchRequest $request, Branch $branch): JsonResponse
    {
        $branch = $this->service->update($request->validated(), $branch);

        return $this->success(
            ['branch' => $this->expose($branch)],
            __('company.branches.updated')
        );
    }

    public function destroy(Branch $branch): JsonResponse
    {
        $this->service->destroy($branch);

        return $this->success(message: __('company.branches.deleted'));
    }

    public function export(Request $request)
    {
        $rows = $this->service->exportRows(auth('company')->id());
        $headers = array_keys($rows->first() ?? []);

        $filename = 'branches-'.now()->format('Y-m-d').'.xlsx';

        return response(XlsxExporter::build($headers, $rows), 200, [
            'Content-Type' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
            'Content-Disposition' => 'attachment; filename="'.$filename.'"',
        ]);
    }

    private function expose(Branch $branch): array
    {
        return [
            'id' => $branch->id,
            'company_id' => $branch->company_id,
            'branch_type' => $branch->branch_type,
            'name_ar' => $branch->name_ar,
            'name_en' => $branch->name_en,
            'person_name' => $branch->person_name,
            'person_email' => $branch->person_email,
            'phone_code' => $branch->phone_code,
            'phone_number' => $branch->phone_number,
            'general_phone_code' => $branch->general_phone_code,
            'general_phone_number' => $branch->general_phone_number,
            'address' => $branch->address,
            'latitude' => $branch->latitude !== null ? (float) $branch->latitude : null,
            'longitude' => $branch->longitude !== null ? (float) $branch->longitude : null,
            'is_airport_branch' => (bool) $branch->is_airport_branch,
            'is_train_station_branch' => (bool) $branch->is_train_station_branch,
            'notes_ar' => $branch->notes_ar,
            'notes_en' => $branch->notes_en,
            'status' => $branch->status,
            'airports' => $branch->airports->map(fn ($a) => $a->id)->values(),
            'train_stations' => $branch->trainStations->map(fn ($t) => $t->id)->values(),
            'working_hours' => $branch->workingHours,
            'delivery_hours' => $branch->deliveryHours,
            'driver_service' => $branch->driverService,
            'child_seat_service' => $branch->childSeatService,
            'airport_fast_delivery' => $branch->airportFastDelivery,
            'special_delivery_service' => $branch->specialDeliveryService,
            'delivery_only_prices' => $branch->deliveryOnlyPrices,
            'vacations' => $branch->branchVacations->map(fn ($v) => $v->company_vacation_id)->values(),
            'created_at' => $branch->created_at?->toISOString(),
        ];
    }
}
