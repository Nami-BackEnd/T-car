<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        $this->call(AdminSeeder::class);
        $this->call(CountrySeeder::class);
        $this->call(CitySeeder::class);
        $this->call(BankSeeder::class);
        $this->call(PaymentMethodSeeder::class);
        $this->call(CompanyAdditionalServiceSeeder::class);
        $this->call(CompanySeeder::class);
        $this->call(BrandSeeder::class);
        $this->call(CarTypeSeeder::class);
        $this->call(CarModelSeeder::class);
        $this->call(CarAdditionalServiceSeeder::class);
        $this->call(BranchSeeder::class);
        $this->call(CompanyCarSeeder::class);
    }
}
