<?php

namespace Database\Seeders;

use App\Models\CompanyAdditionalService;
use Illuminate\Database\Seeder;

class CompanyAdditionalServiceSeeder extends Seeder
{
    public function run(): void
    {
        foreach ($this->services() as $service) {
            CompanyAdditionalService::updateOrCreate(
                ['title_en' => $service['title_en']],
                ['title_ar' => $service['title_ar'], 'icon' => $service['icon']]
            );
        }
    }

    private function services(): array
    {
        return [
            [
                'title_ar' => 'تم (تسليم فوري)',
                'title_en' => 'Tam (Instant Delivery)',
                'icon' => 'bi-check2-square',
            ],
            [
                'title_ar' => 'إضافة سائق',
                'title_en' => 'Additional Driver',
                'icon' => 'bi-person-plus',
            ],
            [
                'title_ar' => 'السماح بالسفر خارج المملكة',
                'title_en' => 'Travel Outside KSA',
                'icon' => 'bi-airplane',
            ],
        ];
    }
}
