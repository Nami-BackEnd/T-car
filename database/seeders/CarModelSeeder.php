<?php

namespace Database\Seeders;

use App\Models\CarModel;
use Illuminate\Database\Seeder;

class CarModelSeeder extends Seeder
{
    public function run(): void
    {
        $models = [
            ['title_ar' => 'كامري', 'title_en' => 'Camry'],
            ['title_ar' => 'كورولا', 'title_en' => 'Corolla'],
            ['title_ar' => 'ياريس', 'title_en' => 'Yaris'],
            ['title_ar' => 'راف فور', 'title_en' => 'RAV4'],
            ['title_ar' => 'هايلاندر', 'title_en' => 'Highlander'],
            ['title_ar' => 'لاندكروزر', 'title_en' => 'Land Cruiser'],
            ['title_ar' => 'بريوس', 'title_en' => 'Prius'],
            ['title_ar' => 'أفالون', 'title_en' => 'Avalon'],
            ['title_ar' => 'سوناتا', 'title_en' => 'Sonata'],
            ['title_ar' => 'توسان', 'title_en' => 'Tucson'],
            ['title_ar' => 'سيراتو', 'title_en' => 'Cerato'],
            ['title_ar' => 'سبورتاج', 'title_en' => 'Sportage'],
            ['title_ar' => 'باترول', 'title_en' => 'Patrol'],
            ['title_ar' => 'إكسبلورر', 'title_en' => 'Explorer'],
        ];

        foreach ($models as $model) {
            CarModel::updateOrCreate(
                ['title_en' => $model['title_en']],
                ['title_ar' => $model['title_ar']]
            );
        }
    }
}
