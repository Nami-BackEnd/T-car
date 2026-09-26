<?php

namespace Database\Seeders;

use App\Models\City;
use App\Models\Country;
use Illuminate\Database\Seeder;

class CitySeeder extends Seeder
{
    public function run(): void
    {
        $countries = Country::query()->pluck('id', 'title_en');

        foreach ($this->cities() as $city) {
            City::updateOrCreate(
                ['title_en' => $city['title_en']],
                [
                    'title_ar' => $city['title_ar'],
                    'country_id' => $countries[$city['country']] ?? null,
                    'latitude' => $city['lat'],
                    'longitude' => $city['lng'],
                ]
            );
        }
    }

    private function cities(): array
    {
        return [
            ['country' => 'Saudi Arabia', 'title_ar' => 'الرياض', 'title_en' => 'Riyadh', 'lat' => 24.7136, 'lng' => 46.6753],
            ['country' => 'Saudi Arabia', 'title_ar' => 'جدة', 'title_en' => 'Jeddah', 'lat' => 21.4858, 'lng' => 39.1925],
            ['country' => 'Saudi Arabia', 'title_ar' => 'مكة المكرمة', 'title_en' => 'Makkah', 'lat' => 21.3891, 'lng' => 39.8579],
            ['country' => 'Saudi Arabia', 'title_ar' => 'المدينة المنورة', 'title_en' => 'Madinah', 'lat' => 24.5247, 'lng' => 39.5692],
            ['country' => 'Saudi Arabia', 'title_ar' => 'الدمام', 'title_en' => 'Dammam', 'lat' => 26.4207, 'lng' => 50.0888],
            ['country' => 'Saudi Arabia', 'title_ar' => 'الخبر', 'title_en' => 'Khobar', 'lat' => 26.2794, 'lng' => 50.2083],
            ['country' => 'Saudi Arabia', 'title_ar' => 'الطائف', 'title_en' => 'Taif', 'lat' => 21.2703, 'lng' => 40.4158],
            ['country' => 'Saudi Arabia', 'title_ar' => 'أبها', 'title_en' => 'Abha', 'lat' => 18.2164, 'lng' => 42.5053],
            ['country' => 'Saudi Arabia', 'title_ar' => 'تبوك', 'title_en' => 'Tabuk', 'lat' => 28.3838, 'lng' => 36.5550],
            ['country' => 'Saudi Arabia', 'title_ar' => 'بريدة', 'title_en' => 'Buraidah', 'lat' => 26.3592, 'lng' => 43.9818],
            ['country' => 'United Arab Emirates', 'title_ar' => 'دبي', 'title_en' => 'Dubai', 'lat' => 25.2048, 'lng' => 55.2708],
            ['country' => 'United Arab Emirates', 'title_ar' => 'أبوظبي', 'title_en' => 'Abu Dhabi', 'lat' => 24.4539, 'lng' => 54.3773],
            ['country' => 'United Arab Emirates', 'title_ar' => 'الشارقة', 'title_en' => 'Sharjah', 'lat' => 25.3463, 'lng' => 55.4209],
            ['country' => 'Kuwait', 'title_ar' => 'مدينة الكويت', 'title_en' => 'Kuwait City', 'lat' => 29.3759, 'lng' => 47.9774],
            ['country' => 'Qatar', 'title_ar' => 'الدوحة', 'title_en' => 'Doha', 'lat' => 25.2854, 'lng' => 51.5310],
            ['country' => 'Bahrain', 'title_ar' => 'المنامة', 'title_en' => 'Manama', 'lat' => 26.2285, 'lng' => 50.5860],
            ['country' => 'Oman', 'title_ar' => 'مسقط', 'title_en' => 'Muscat', 'lat' => 23.5880, 'lng' => 58.3829],
            ['country' => 'Egypt', 'title_ar' => 'القاهرة', 'title_en' => 'Cairo', 'lat' => 30.0444, 'lng' => 31.2357],
            ['country' => 'Egypt', 'title_ar' => 'الإسكندرية', 'title_en' => 'Alexandria', 'lat' => 31.2001, 'lng' => 29.9187],
            ['country' => 'Jordan', 'title_ar' => 'عمّان', 'title_en' => 'Amman', 'lat' => 31.9539, 'lng' => 35.9106],
            ['country' => 'Lebanon', 'title_ar' => 'بيروت', 'title_en' => 'Beirut', 'lat' => 33.8938, 'lng' => 35.5018],
        ];
    }
}
