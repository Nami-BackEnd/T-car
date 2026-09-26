<?php

namespace Database\Seeders;

use App\Models\CarType;
use Illuminate\Database\Seeder;

class CarTypeSeeder extends Seeder
{
    public function run(): void
    {
        $types = [
            ['title_ar' => 'سيدان', 'title_en' => 'Sedan'],
            ['title_ar' => 'هاتش باك', 'title_en' => 'Hatchback'],
            ['title_ar' => 'دفع رباعي', 'title_en' => 'SUV'],
            ['title_ar' => 'بيك أب', 'title_en' => 'Pickup'],
            ['title_ar' => 'فان', 'title_en' => 'Van'],
            ['title_ar' => 'كابينة مزدوجة', 'title_en' => 'Double Cab'],
            ['title_ar' => 'ميني باص', 'title_en' => 'Minibus'],
            ['title_ar' => 'كوبيه رياضية', 'title_en' => 'Coupe'],
        ];

        foreach ($types as $type) {
            CarType::updateOrCreate(
                ['title_en' => $type['title_en']],
                ['title_ar' => $type['title_ar'], 'is_active' => true]
            );
        }
    }
}
