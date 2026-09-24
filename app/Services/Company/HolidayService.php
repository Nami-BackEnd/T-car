<?php

namespace App\Services\Company;

use App\Models\CompanyVacation;
use App\Models\Vacation;
use Illuminate\Support\Collection;

class HolidayService
{
    public function holidays(int $companyId): Collection
    {
        $active = CompanyVacation::query()
            ->where('company_id', $companyId)
            ->pluck('day_count', 'vacation_id');

        return Vacation::query()
            ->orderBy('date')
            ->get()
            ->map(function (Vacation $vacation) use ($active) {
                return [
                    'id' => $vacation->id,
                    'name_ar' => $vacation->name_ar,
                    'name_en' => $vacation->name_en,
                    'date' => $vacation->date?->toDateString(),
                    'active' => $active->has($vacation->id),
                    'day_count' => $day = (int) ($active[$vacation->id] ?? 1),
                    'end_date' => $this->endDate($vacation->date, $day),
                ];
            })
            ->values();
    }

    public function toggle(int $companyId, Vacation $vacation, bool $active, int $days): void
    {
        if (! $active) {
            CompanyVacation::query()
                ->where('company_id', $companyId)
                ->where('vacation_id', $vacation->id)
                ->delete();

            return;
        }

        CompanyVacation::updateOrCreate(
            ['company_id' => $companyId, 'vacation_id' => $vacation->id],
            ['day_count' => $days]
        );
    }

    public function updateDuration(int $companyId, Vacation $vacation, int $days): void
    {
        CompanyVacation::updateOrCreate(
            ['company_id' => $companyId, 'vacation_id' => $vacation->id],
            ['day_count' => $days]
        );
    }

    private function endDate(?\DateTimeInterface $date, int $days): ?string
    {
        if ($date === null) {
            return null;
        }

        return $date->modify("+{$days} days")->format('Y-m-d');
    }
}
