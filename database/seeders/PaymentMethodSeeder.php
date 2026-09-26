<?php

namespace Database\Seeders;

use App\Models\PaymentMethod;
use Illuminate\Database\Seeder;

class PaymentMethodSeeder extends Seeder
{
    public function run(): void
    {
        foreach ($this->methods() as $method) {
            PaymentMethod::updateOrCreate(
                ['title_en' => $method['title_en']],
                ['title_ar' => $method['title_ar'], 'icon' => $method['icon']]
            );
        }
    }

    private function methods(): array
    {
        return [
            ['title_ar' => 'تمارا', 'title_en' => 'Tamara', 'icon' => 'bi-credit-card-2-front'],
            ['title_ar' => 'تابي', 'title_en' => 'Tabby', 'icon' => 'bi-cash-stack'],
            ['title_ar' => 'Apple Pay', 'title_en' => 'Apple Pay', 'icon' => 'bi-apple'],
            ['title_ar' => 'مدى', 'title_en' => 'Mada', 'icon' => 'bi-credit-card'],
            ['title_ar' => 'الدفع عند الاستلام', 'title_en' => 'Cash on Delivery', 'icon' => 'bi-wallet2'],
        ];
    }
}
