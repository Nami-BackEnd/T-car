<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\SettingRequest;
use App\Models\Setting;
use App\Services\Admin\SettingService;
use App\Traits\ApiResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;

class SettingController extends Controller
{
    use ApiResponse;

    public function __construct(private readonly SettingService $service)
    {
    }

    public static function config(): array
    {
        return [
            'routeBase' => 'admin.settings',
            'entity'    => __('admin.nav.settings'),
            'icon'      => 'ti-settings',
        ];
    }

    public function index()
    {
        return view('admin.pages.settings.index', [
            'config'  => self::config(),
            'setting' => $this->service->get(),
        ]);
    }

    public function update(SettingRequest $request): RedirectResponse|JsonResponse
    {
        $setting = $this->service->update($request->validated());

        if ($request->expectsJson() || $request->ajax()) {
            return $this->success(
                ['setting' => $this->exposed($setting)],
                __('admin.messages.updated_success', ['entity' => self::config()['entity']])
            );
        }

        return redirect()
            ->back()
            ->withInput()
            ->with('success', __('admin.messages.updated_success', ['entity' => self::config()['entity']]));
    }

    private function exposed(Setting $setting): array
    {
        return [
            'daily_booking_showing'           => (bool) $setting->daily_booking_showing,
            'monthly_booking_showing'         => (bool) $setting->monthly_booking_showing,
            'station_booking_showing'         => (bool) $setting->station_booking_showing,
            'airport_booking_showing'         => (bool) $setting->airport_booking_showing,
            'international_booking_showing'   => (bool) $setting->international_booking_showing,
            'rewards_screen_showing'          => (bool) $setting->rewards_screen_showing,
            'free_cancellation_time'          => (int) $setting->free_cancellation_time,
            'partial_cancellation_time'       => (int) $setting->partial_cancellation_time,
            'partial_cancellation_percentage' => (float) $setting->partial_cancellation_percentage,
            'number_days_of_refund'           => (int) $setting->number_days_of_refund,
            'tax_value'                       => (float) $setting->tax_value,
            'riyal_to_points_conversion'      => (float) $setting->riyal_to_points_conversion,
            'driver_reword_value'             => (float) $setting->driver_reword_value,
            'logo_url'                        => $setting->logo_url,
        ];
    }
}
