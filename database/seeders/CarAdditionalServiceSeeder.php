<?php

namespace Database\Seeders;

use App\Models\CarAdditionalService;
use Illuminate\Database\Seeder;

class CarAdditionalServiceSeeder extends Seeder
{
    public function run(): void
    {
        $services = [
            [
                'title_ar' => 'اضافة سائق',
                'title_en' => 'Additional Driver',
            ],
            [
                'title_ar' => 'كم لا محدود',
                'title_en' => 'Unlimited Mileage',
            ],
            [
                'title_ar' => 'CDW',
                'title_en' => 'CDW',
            ],
            [
                'title_ar' => 'سيارة غير مدخنين',
                'title_en' => 'Non-Smoker Car',
            ],
        ];

        foreach ($services as $service) {
            CarAdditionalService::updateOrCreate(
                ['title_en' => $service['title_en']],
                ['title_ar' => $service['title_ar']]
            );
        }
    }
}
