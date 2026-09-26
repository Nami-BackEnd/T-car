<?php

namespace Database\Seeders;

use App\Models\Branch;
use Illuminate\Database\Seeder;

class BranchSeeder extends Seeder
{
    use ResolvesCompanyOwner;

    /**
     * The company these demo branches belong to. Branches hang off
     * company_users.id, so this is a company *user*, not a company.
     */
    public const COMPANY_EMAIL = 'company@tcar.com';

    public const BRANCHES = [
        ['name_ar' => 'فرع الرياض', 'name_en' => 'Riyadh Branch', 'phone_number' => '0112345678'],
        ['name_ar' => 'فرع جدة', 'name_en' => 'Jeddah Branch', 'phone_number' => '0123456789'],
        ['name_ar' => 'فرع الدمام', 'name_en' => 'Dammam Branch', 'phone_number' => '0134567890'],
        ['name_ar' => 'فرع المدينة المنورة', 'name_en' => 'Madinah Branch', 'phone_number' => '0145678901'],
        ['name_ar' => 'فرع أبها', 'name_en' => 'Abha Branch', 'phone_number' => '0156789012'],
    ];

    public function run(): void
    {
        $owner = $this->owner();

        if (! $owner) {
            $this->command?->warn('BranchSeeder: no company user found, skipping.');

            return;
        }

        foreach (self::BRANCHES as $branch) {
            // Keyed on the arabic name, which is what the screens show. A
            // database that already has "فرع الرياض" from earlier work gets that
            // row reused instead of a second branch with the same visible name.
            $existing = Branch::query()
                ->where('company_id', $owner->id)
                ->where('name_ar', $branch['name_ar'])
                ->first();

            if ($existing) {
                $existing->fill([
                    'name_en' => $branch['name_en'],
                    'phone_number' => $branch['phone_number'],
                    'status' => 'approved',
                ])->save();

                continue;
            }

            Branch::create([
                'company_id' => $owner->id,
                'branch_type' => 'office',
                'name_ar' => $branch['name_ar'],
                'name_en' => $branch['name_en'],
                'phone_number' => $branch['phone_number'],
                'status' => 'approved',
            ]);
        }
    }
}
