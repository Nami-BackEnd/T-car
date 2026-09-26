<?php

namespace Database\Seeders;

use App\Models\Bank;
use Illuminate\Database\Seeder;

class BankSeeder extends Seeder
{
    public function run(): void
    {
        foreach ($this->banks() as $bank) {
            Bank::updateOrCreate(
                ['title_en' => $bank['title_en']],
                ['title_ar' => $bank['title_ar']]
            );
        }
    }

    private function banks(): array
    {
        return [
            ['title_ar' => 'البنك الأهلي السعودي', 'title_en' => 'Al Rajhi Bank'],
            ['title_ar' => 'بنك البلاد', 'title_en' => 'Bank Albilad'],
            ['title_ar' => 'بنك الرياض', 'title_en' => 'Riyad Bank'],
            ['title_ar' => 'البنك السعودي الأول', 'title_en' => 'Saudi First Bank'],
            ['title_ar' => 'البنك السعودي الفرنسي', 'title_en' => 'Banque Saudi Fransi'],
            ['title_ar' => 'بنك 종료', 'title_en' => 'Alinma Bank'],
            ['title_ar' => 'مصرف الراجحي', 'title_en' => 'Rajhi Bank'],
        ];
    }
}
