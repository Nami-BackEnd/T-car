<?php

namespace App\Http\Controllers\Company;

use App\Http\Requests\Company\HolidayDurationRequest;
use App\Http\Requests\Company\HolidayToggleRequest;
use App\Models\Vacation;
use App\Services\Company\HolidayService;
use App\Traits\ApiResponse;
use Illuminate\Http\JsonResponse;

class HolidayController extends Controller
{
    use ApiResponse;

    public function __construct(private readonly HolidayService $service) {}

    public function index(): JsonResponse
    {
        return $this->success($this->service->holidays(auth('company')->id()));
    }

    public function toggle(HolidayToggleRequest $request, Vacation $vacation): JsonResponse
    {
        $this->service->toggle(
            auth('company')->id(),
            $vacation,
            $request->boolean('active'),
            $request->integer('day_count', 1)
        );

        return $this->success(
            ['vacation' => $vacation->id],
            __('company.holidays.toggled')
        );
    }

    public function updateDuration(HolidayDurationRequest $request, Vacation $vacation): JsonResponse
    {
        $this->service->updateDuration(
            auth('company')->id(),
            $vacation,
            $request->integer('day_count')
        );

        return $this->success(
            ['vacation' => $vacation->id],
            __('company.holidays.duration_updated')
        );
    }
}
