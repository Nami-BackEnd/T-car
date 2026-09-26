<?php

namespace App\Http\Controllers\Company;

use App\Http\Requests\Company\SettingsRequest;
use App\Models\CompanyUser;
use App\Services\Company\SettingsService;
use App\Traits\ApiResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class SettingsController extends Controller
{
    use ApiResponse;

    public function __construct(private readonly SettingsService $service)
    {
    }

    public function edit(): View
    {
        return view('company.pages.settings', [
            ...$this->service->payload($this->user()),
            'title'      => __('company.pages.settings.0'),
            'extraClass' => '',
        ]);
    }

    public function update(SettingsRequest $request): RedirectResponse|JsonResponse
    {
        $this->service->update($this->user(), $request->validated());

        if ($request->expectsJson() || $request->ajax()) {
            return $this->success(message: __('company.settings.saved'));
        }

        return redirect()
            ->route('company.settings')
            ->with('success', __('company.settings.saved'));
    }

    private function user(): CompanyUser
    {
        return auth('company')->user();
    }
}
