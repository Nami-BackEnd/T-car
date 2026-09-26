<?php

namespace Database\Seeders;

use App\Models\Brand;
use Illuminate\Database\Seeder;

class BrandSeeder extends Seeder
{
    public function run(): void
    {
        $brands = [
            ['title_ar' => 'تويوتا', 'title_en' => 'Toyota'],
            ['title_ar' => 'نيسان', 'title_en' => 'Nissan'],
            ['title_ar' => 'هيونداي', 'title_en' => 'Hyundai'],
            ['title_ar' => 'كيا', 'title_en' => 'Kia'],
            ['title_ar' => 'سوزوكي', 'title_en' => 'Suzuki'],
            ['title_ar' => 'هوندا', 'title_en' => 'Honda'],
            ['title_ar' => 'فورد', 'title_en' => 'Ford'],
            ['title_ar' => 'شيفروليه', 'title_en' => 'Chevrolet'],
            ['title_ar' => 'بي إم دبليو', 'title_en' => 'BMW'],
            ['title_ar' => 'مرسيدس', 'title_en' => 'Mercedes'],
            ['title_ar' => 'أودي', 'title_en' => 'Audi'],
            ['title_ar' => 'مازدا', 'title_en' => 'Mazda'],
            ['title_ar' => 'فولكس واجن', 'title_en' => 'Volkswagen'],
            ['title_ar' => 'ميتسوبيشي', 'title_en' => 'Mitsubishi'],
            ['title_ar' => 'لكزس', 'title_en' => 'Lexus'],
            ['title_ar' => 'لاند روفر', 'title_en' => 'Land Rover'],
        ];

        foreach ($brands as $brand) {
            Brand::updateOrCreate(
                ['title_en' => $brand['title_en']],
                ['title_ar' => $brand['title_ar']]
            );
        }
    }
}
