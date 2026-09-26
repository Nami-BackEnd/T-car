<?php

namespace Tests\Feature;

use App\Models\Branch;
use App\Models\Car;
use App\Models\CompanyUser;
use Database\Seeders\BranchSeeder;
use Database\Seeders\BrandSeeder;
use Database\Seeders\CarAdditionalServiceSeeder;
use Database\Seeders\CarModelSeeder;
use Database\Seeders\CarTypeSeeder;
use Database\Seeders\CompanyCarSeeder;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class CompanyFleetSeederTest extends TestCase
{
    use DatabaseTransactions;

    /**
     * The demo company user, matching the email the seeders default to. Created
     * here because DatabaseTransactions rolls the seeded one back.
     */
    private function company(): CompanyUser
    {
        // firstOrCreate, not create: the test database can already hold the
        // account from a previous seeding run, and DatabaseTransactions only
        // rolls back what this test wrote.
        return CompanyUser::firstOrCreate(
            ['email' => BranchSeeder::COMPANY_EMAIL],
            [
                'company_id' => null,
                'name' => 'Seeded Fleet',
                'password' => Hash::make('12345678'),
                'phone' => '0500000000',
                'is_active' => true,
            ]
        );
    }

    private function seedFleet(): void
    {
        $this->seed(BrandSeeder::class);
        $this->seed(CarTypeSeeder::class);
        $this->seed(CarModelSeeder::class);
        $this->seed(CarAdditionalServiceSeeder::class);
        $this->seed(BranchSeeder::class);
        $this->seed(CompanyCarSeeder::class);
    }

    public function test_it_seeds_branches_for_the_company(): void
    {
        $company = $this->company();
        $this->seed(BranchSeeder::class);

        $this->assertSame(count(BranchSeeder::BRANCHES), Branch::query()->where('company_id', $company->id)->count());

        foreach (BranchSeeder::BRANCHES as $expected) {
            $this->assertDatabaseHas('branches', [
                'company_id' => $company->id,
                'name_ar' => $expected['name_ar'],
                'status' => 'approved',
            ]);
        }
    }

    public function test_it_seeds_cars_with_every_relation_the_add_car_screen_creates(): void
    {
        $this->company();
        $this->seedFleet();

        $this->assertSame(count(CompanyCarSeeder::FLEET), Car::query()->count());

        foreach (Car::query()->get() as $car) {
            // A raw Car::create() would leave all of these empty, which is
            // exactly what the seeder must avoid.
            $this->assertTrue($car->pricing()->exists(), "car {$car->id} has no pricing");
            $this->assertTrue($car->details()->exists(), "car {$car->id} has no details");
            $this->assertGreaterThan(0, $car->subscriptions()->count(), "car {$car->id} has no subscriptions");
            $this->assertGreaterThan(0, $car->carServices()->count(), "car {$car->id} has no services");
            $this->assertGreaterThan(0, $car->branches()->count(), "car {$car->id} is not stocked anywhere");
        }
    }

    public function test_seeded_stock_lands_in_the_branches_the_fleet_asked_for(): void
    {
        $this->company();
        $this->seedFleet();

        foreach (CompanyCarSeeder::FLEET as $entry) {
            $car = Car::query()
                ->whereHas('carModel', fn ($q) => $q->where('title_en', $entry['model']))
                ->where('year', $entry['year'])
                ->firstOrFail();

            $stocks = [];

            foreach ($car->branches as $branch) {
                $stocks[$branch->name_en] = (int) $branch->pivot->stock;
            }

            foreach ($entry['stock'] as $name => $units) {
                $this->assertSame(
                    $units,
                    $stocks[$name] ?? 0,
                    "{$entry['model']} should hold {$units} in {$name}"
                );
            }

            // The denormalised count has to agree with the pivot rows, since
            // the car list reads count and the matrix reads the pivots.
            $this->assertSame(array_sum($entry['stock']), (int) $car->count);
        }
    }

    public function test_running_it_twice_does_not_duplicate_anything(): void
    {
        $this->company();

        $this->seedFleet();
        $branches = Branch::query()->count();
        $cars = Car::query()->count();
        $stock = $this->carBranches();

        $this->seedFleet();

        $this->assertSame($branches, Branch::query()->count(), 're-running added branches');
        $this->assertSame($cars, Car::query()->count(), 're-running added cars');
        $this->assertSame($stock, $this->carBranches(), 're-running changed the stock rows');
    }

    public function test_it_reuses_a_branch_that_already_has_the_same_arabic_name(): void
    {
        $company = $this->company();

        // Start from an empty slate: a previous seeding run may already have
        // left a "فرع الرياض" behind, which would be a second row with the same
        // name for reasons that have nothing to do with the seeder.
        $this->clearBranches($company);

        $existing = Branch::create([
            'company_id' => $company->id,
            'branch_type' => 'office',
            'name_ar' => 'فرع الرياض',
            'name_en' => 'Riyadh',
            'status' => 'approved',
        ]);

        $this->seed(BranchSeeder::class);

        $this->assertSame(1, Branch::query()
            ->where('company_id', $company->id)
            ->where('name_ar', 'فرع الرياض')
            ->count(), 'the seeder created a second branch with the same visible name');

        $this->assertSame('Riyadh Branch', $existing->fresh()->name_en);
    }

    public function test_it_attaches_the_fleet_to_the_company_asked_for(): void
    {
        $default = $this->company();

        $other = CompanyUser::create([
            'company_id' => $default->company_id,
            'name' => 'Other',
            'email' => 'other-'.uniqid().'@tcar.test',
            'password' => Hash::make('12345678'),
            'phone' => '0500000001',
            'is_active' => true,
        ]);

        $defaultBranches = Branch::query()->where('company_id', $default->id)->count();

        // SEED_COMPANY_EMAIL is the only knob db:seed exposes, so drive it the
        // same way a caller would.
        putenv('SEED_COMPANY_EMAIL='.$other->email);
        $_ENV['SEED_COMPANY_EMAIL'] = $other->email;
        $_SERVER['SEED_COMPANY_EMAIL'] = $other->email;

        try {
            $this->seed(BranchSeeder::class);
            $this->seed(CompanyCarSeeder::class);
        } finally {
            putenv('SEED_COMPANY_EMAIL');
            unset($_ENV['SEED_COMPANY_EMAIL'], $_SERVER['SEED_COMPANY_EMAIL']);
        }

        $this->assertSame(
            $defaultBranches,
            Branch::query()->where('company_id', $default->id)->count(),
            'the fleet leaked onto the default account'
        );
        $this->assertGreaterThan(0, Branch::query()->where('company_id', $other->id)->count());
        $this->assertGreaterThan(0, Car::query()
            ->whereHas('branches', fn ($q) => $q->where('branches.company_id', $other->id))
            ->count());
    }

    private function carBranches(): int
    {
        return DB::table('car_branches')->count();
    }

    private function clearBranches(CompanyUser $company): void
    {
        $ids = Branch::query()->where('company_id', $company->id)->pluck('id');

        DB::table('car_branches')->whereIn('branch_id', $ids)->delete();
        Branch::query()->whereIn('id', $ids)->delete();
    }
}
