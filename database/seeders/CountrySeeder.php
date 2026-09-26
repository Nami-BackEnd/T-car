<?php

namespace Database\Seeders;

use App\Models\Country;
use Illuminate\Database\Seeder;

class CountrySeeder extends Seeder
{
    public function run(): void
    {
        foreach ($this->countries() as $country) {
            Country::updateOrCreate(
                ['title_en' => $country['title_en']],
                ['title_ar' => $country['title_ar'], 'phone_code' => $country['phone_code']]
            );
        }
    }

    private function countries(): array
    {
        return [
            ['title_ar' => 'المملكة العربية السعودية', 'title_en' => 'Saudi Arabia', 'phone_code' => '+966'],
            ['title_ar' => 'الإمارات العربية المتحدة', 'title_en' => 'United Arab Emirates', 'phone_code' => '+971'],
            ['title_ar' => 'الكويت', 'title_en' => 'Kuwait', 'phone_code' => '+965'],
            ['title_ar' => 'قطر', 'title_en' => 'Qatar', 'phone_code' => '+974'],
            ['title_ar' => 'البحرين', 'title_en' => 'Bahrain', 'phone_code' => '+973'],
            ['title_ar' => 'عُمان', 'title_en' => 'Oman', 'phone_code' => '+968'],
            ['title_ar' => 'مصر', 'title_en' => 'Egypt', 'phone_code' => '+20'],
            ['title_ar' => 'الأردن', 'title_en' => 'Jordan', 'phone_code' => '+962'],
            ['title_ar' => 'لبنان', 'title_en' => 'Lebanon', 'phone_code' => '+961'],
        ];
    }
}
