<?php

namespace Database\Seeders;

use App\Models\Company;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class CompanySeeder extends Seeder
{
    public function run(): void
    {
        Company::updateOrCreate(
            ['email' => 'company@tcar.com'],
            [
                'name'     => 'T-Car Rental',
                'password' => Hash::make('12345678'),
                'phone'    => '0560000000',
                'is_active' => true,
            ]
        );
    }
}