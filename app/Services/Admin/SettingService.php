<?php

namespace App\Services\Admin;

use App\Models\Setting;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class SettingService extends Service
{
    public function get(): Setting
    {
        return Setting::query()->firstOrCreate([], $this->defaults());
    }

    public function update(array $data): Setting
    {
        if ($data['logo'] ?? null) {
            $data['logo'] = $this->uploadLogo($data['logo']);
        } else {
            unset($data['logo']);
        }

        $setting = $this->get();
        $oldLogo = $setting->logo;
        $setting->update($data);

        if ($oldLogo && $oldLogo !== $setting->refresh()->logo) {
            $this->deleteLogo($oldLogo);
        }

        return $setting->refresh();
    }

    private function defaults(): array
    {
        return [
            'daily_booking_showing'           => true,
            'monthly_booking_showing'         => true,
            'station_booking_showing'         => true,
            'airport_booking_showing'         => true,
            'international_booking_showing'   => true,
            'rewards_screen_showing'          => true,
            'free_cancellation_time'          => 0,
            'partial_cancellation_time'       => 0,
            'partial_cancellation_percentage' => 0,
            'number_days_of_refund'           => 0,
            'tax_value'                       => 0,
            'riyal_to_points_conversion'      => 0,
            'driver_reword_value'             => 0,
        ];
    }

    private function uploadLogo(UploadedFile $logo): string
    {
        return Storage::disk('public')->putFile('settings', $logo);
    }

    private function deleteLogo(?string $path): void
    {
        if ($path && Storage::disk('public')->exists($path)) {
            Storage::disk('public')->delete($path);
        }
    }
}
