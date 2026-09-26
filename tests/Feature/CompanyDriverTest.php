<?php

namespace Tests\Feature;

use App\Models\Branch;
use App\Models\Company;
use App\Models\CompanyUser;
use App\Models\Driver;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class CompanyDriverTest extends TestCase
{
    use DatabaseTransactions;

    private function actingCompanyUser(): CompanyUser
    {
        $company = Company::create([
            'company_name_ar' => 'شركة اختبار',
            'company_name_en' => 'Test Company',
            'admin_name' => 'Admin',
            'email' => 'drivers-'.uniqid().'@tcar.test',
        ]);

        return CompanyUser::create([
            'company_id' => $company->id,
            'name' => 'Manager',
            'email' => 'manager-'.uniqid().'@tcar.test',
            'password' => Hash::make('12345678'),
            'phone' => '0500000000',
            'is_active' => true,
        ]);
    }

    private function makeBranch(CompanyUser $user, array $overrides = []): Branch
    {
        return Branch::create(array_merge([
            'company_id' => $user->id,
            'branch_type' => 'branch',
            'name_ar' => 'فرع '.uniqid(),
            'name_en' => 'Branch '.uniqid(),
            'status' => 'pending',
        ], $overrides));
    }

    private function payload(CompanyUser $user, array $overrides = []): array
    {
        return array_merge([
            'name' => 'سعود احمد',
            'phone_code' => '+966',
            'phone' => '0501234567',
            'license_expiration_date' => '2030-01-01',
            'identity_number' => '10'.random_int(10000000, 99999999),
            'email' => 'driver-'.uniqid().'@tcar.test',
            'password' => 'secret1234',
            'password_confirmation' => 'secret1234',
            'assigned_to_all_branches' => false,
            'branches' => [$this->makeBranch($user)->id],
        ], $overrides);
    }

    public function test_options_endpoint_returns_branches_and_phone_codes(): void
    {
        $user = $this->actingCompanyUser();
        $branch = $this->makeBranch($user);

        $response = $this->actingAs($user, 'company')->getJson(route('company.add-driver.options'));

        $response->assertOk();
        $this->assertSame(
            [$branch->id],
            collect($response->json('data.branches'))->pluck('id')->all()
        );
        $this->assertNotEmpty($response->json('data.phone_codes'));
        $this->assertSame('ar', $response->json('data.languages.0.value'));
    }

    public function test_options_endpoint_hides_other_companies_branches(): void
    {
        $user = $this->actingCompanyUser();
        $other = $this->actingCompanyUser();
        $otherBranch = $this->makeBranch($other);

        $response = $this->actingAs($user, 'company')->getJson(route('company.add-driver.options'));

        $response->assertOk();
        $this->assertNotContains(
            $otherBranch->id,
            collect($response->json('data.branches'))->pluck('id')->all()
        );
    }

    public function test_store_creates_driver_with_hashed_password_and_branches(): void
    {
        $user = $this->actingCompanyUser();
        $branch = $this->makeBranch($user);

        $response = $this->actingAs($user, 'company')->postJson(
            route('company.drivers.store'),
            $this->payload($user, ['branches' => [$branch->id]])
        );

        $response->assertOk();

        $driver = Driver::firstOrFail();
        $this->assertSame($user->id, $driver->company_id);
        $this->assertNotSame('secret1234', $driver->password);
        $this->assertTrue(Hash::check('secret1234', $driver->password));
        $this->assertTrue($driver->is_active);
        $this->assertEquals([$branch->id], $driver->branches->pluck('id')->all());
    }

    public function test_store_allows_assigning_to_all_branches_without_branch_list(): void
    {
        $user = $this->actingCompanyUser();

        $response = $this->actingAs($user, 'company')->postJson(
            route('company.drivers.store'),
            $this->payload($user, [
                'assigned_to_all_branches' => true,
                'branches' => [],
            ])
        );

        $response->assertOk();
        $this->assertTrue(Driver::firstOrFail()->assigned_to_all_branches);
    }

    public function test_store_requires_a_branch_when_not_assigned_to_all(): void
    {
        $user = $this->actingCompanyUser();

        $this->actingAs($user, 'company')->postJson(
            route('company.drivers.store'),
            $this->payload($user, ['branches' => []])
        )->assertStatus(422)->assertJsonValidationErrors('branches');

        $this->assertSame(0, Driver::count());
    }

    public function test_store_rejects_a_branch_belonging_to_another_company(): void
    {
        $user = $this->actingCompanyUser();
        $otherBranch = $this->makeBranch($this->actingCompanyUser());

        $this->actingAs($user, 'company')->postJson(
            route('company.drivers.store'),
            $this->payload($user, ['branches' => [$otherBranch->id]])
        )->assertStatus(422)->assertJsonValidationErrors('branches.0');

        $this->assertSame(0, Driver::count());
    }

    public function test_store_rejects_duplicate_identity_number_for_same_company(): void
    {
        $user = $this->actingCompanyUser();
        $branch = $this->makeBranch($user);
        $identity = '20'.random_int(10000000, 99999999);

        $this->actingAs($user, 'company')->postJson(
            route('company.drivers.store'),
            $this->payload($user, ['identity_number' => $identity, 'branches' => [$branch->id]])
        )->assertOk();

        $this->actingAs($user, 'company')->postJson(
            route('company.drivers.store'),
            $this->payload($user, ['identity_number' => $identity, 'branches' => [$branch->id]])
        )->assertStatus(422)->assertJsonValidationErrors('identity_number');

        $this->assertSame(1, Driver::count());
    }

    public function test_update_changes_fields_and_resyncs_branches(): void
    {
        $user = $this->actingCompanyUser();
        $oldBranch = $this->makeBranch($user);
        $newBranch = $this->makeBranch($user);

        $this->actingAs($user, 'company')->postJson(
            route('company.drivers.store'),
            $this->payload($user, ['branches' => [$oldBranch->id]])
        )->assertOk();

        $driver = Driver::firstOrFail();

        $this->actingAs($user, 'company')->putJson(
            route('company.edit-driver.update', $driver),
            $this->payload($user, [
                'name' => 'اسم جديد',
                'branches' => [$newBranch->id],
                'password' => '',
                'password_confirmation' => '',
            ])
        )->assertOk();

        $driver->refresh();
        $this->assertSame('اسم جديد', $driver->name);
        $this->assertEquals([$newBranch->id], $driver->branches->pluck('id')->all());
    }

    public function test_update_keeps_existing_password_when_left_blank(): void
    {
        $user = $this->actingCompanyUser();

        $this->actingAs($user, 'company')->postJson(
            route('company.drivers.store'),
            $this->payload($user)
        )->assertOk();

        $driver = Driver::firstOrFail();
        $hash = $driver->password;

        $this->actingAs($user, 'company')->putJson(
            route('company.edit-driver.update', $driver),
            $this->payload($user, ['password' => '', 'password_confirmation' => ''])
        )->assertOk();

        $this->assertSame($hash, $driver->fresh()->password);
    }

    public function test_update_does_not_reactivate_a_deactivated_driver(): void
    {
        $user = $this->actingCompanyUser();

        $this->actingAs($user, 'company')->postJson(
            route('company.drivers.store'),
            $this->payload($user)
        )->assertOk();

        $driver = Driver::firstOrFail();
        $this->actingAs($user, 'company')->patchJson(
            route('company.drivers.status', $driver),
            ['is_active' => false]
        )->assertOk();

        // The edit form does not post a status field.
        $this->actingAs($user, 'company')->putJson(
            route('company.edit-driver.update', $driver),
            $this->payload($user, ['name' => 'معدّل'])
        )->assertOk();

        $this->assertFalse($driver->fresh()->is_active);
    }

    public function test_create_and_update_work_without_a_lang_field(): void
    {
        $user = $this->actingCompanyUser();

        $this->actingAs($user, 'company')->postJson(
            route('company.drivers.store'),
            $this->payload($user)
        )->assertOk();

        $driver = Driver::firstOrFail();
        $this->assertSame('ar', $driver->lang);

        $driver->update(['lang' => 'en']);

        $this->actingAs($user, 'company')->putJson(
            route('company.edit-driver.update', $driver),
            $this->payload($user, ['name' => 'بدون لغة'])
        )->assertOk();

        $this->assertSame('en', $driver->fresh()->lang);
    }

    public function test_phone_code_must_exist_in_countries(): void
    {
        $user = $this->actingCompanyUser();

        $response = $this->actingAs($user, 'company')->postJson(
            route('company.drivers.store'),
            $this->payload($user, ['phone_code' => '+999'])
        );

        $response->assertStatus(422);
        $this->assertArrayHasKey('phone_code', $response->json('errors'));
    }

    public function test_update_preserves_all_branches_flag_when_not_submitted(): void
    {
        $user = $this->actingCompanyUser();

        $this->actingAs($user, 'company')->postJson(
            route('company.drivers.store'),
            $this->payload($user, [
                'assigned_to_all_branches' => true,
                'branches' => [],
            ])
        )->assertOk();

        $driver = Driver::firstOrFail();
        $this->assertTrue($driver->assigned_to_all_branches);

        // The edit form posts branch ids but not the flag, so it must survive.
        $this->actingAs($user, 'company')->putJson(
            route('company.edit-driver.update', $driver),
            $this->payload($user, [
                'name' => 'اسم معدّل',
                'branches' => [$this->makeBranch($user)->id],
                'assigned_to_all_branches' => null,
            ])
        )->assertOk();

        $this->assertTrue($driver->fresh()->assigned_to_all_branches);
    }

    public function test_all_branches_driver_does_not_require_branch_selection(): void
    {
        $user = $this->actingCompanyUser();

        $this->actingAs($user, 'company')->postJson(
            route('company.drivers.store'),
            $this->payload($user, [
                'assigned_to_all_branches' => true,
                'branches' => [],
            ])
        )->assertOk();

        $this->assertDatabaseHas('drivers', [
            'id' => Driver::firstOrFail()->id,
            'assigned_to_all_branches' => true,
        ]);
    }

    public function test_show_returns_driver_with_options(): void
    {
        $user = $this->actingCompanyUser();
        $branch = $this->makeBranch($user);

        $this->actingAs($user, 'company')->postJson(
            route('company.drivers.store'),
            $this->payload($user, ['branches' => [$branch->id]])
        )->assertOk();

        $driver = Driver::firstOrFail();

        $response = $this->actingAs($user, 'company')
            ->getJson(route('company.drivers.show', $driver));

        $response->assertOk();
        $this->assertSame($driver->name, $response->json('data.driver.name'));
        $this->assertSame([$branch->id], $response->json('data.driver.branch_ids'));
        $this->assertNotEmpty($response->json('data.options.branches'));
    }

    public function test_index_lists_only_own_drivers_and_supports_search(): void
    {
        $user = $this->actingCompanyUser();
        $other = $this->actingCompanyUser();

        $this->actingAs($user, 'company')->postJson(
            route('company.drivers.store'),
            $this->payload($user, ['name' => 'سائق خاص'])
        )->assertOk();

        $this->actingAs($other, 'company')->postJson(
            route('company.drivers.store'),
            $this->payload($other, ['name' => 'سائق آخر'])
        )->assertOk();

        $all = $this->actingAs($user, 'company')->getJson(route('company.drivers.data'));
        $this->assertCount(1, $all->json('data'));
        $this->assertSame('سائق خاص', $all->json('data.0.name'));

        $search = $this->actingAs($user, 'company')
            ->getJson(route('company.drivers.data', ['search' => 'سائق خاص']));
        $this->assertCount(1, $search->json('data'));

        $missing = $this->actingAs($user, 'company')
            ->getJson(route('company.drivers.data', ['search' => 'لا يوجد']));
        $this->assertCount(0, $missing->json('data'));
    }

    public function test_index_can_filter_by_status(): void
    {
        $user = $this->actingCompanyUser();

        $this->actingAs($user, 'company')->postJson(
            route('company.drivers.store'),
            $this->payload($user)
        )->assertOk();

        $driver = Driver::firstOrFail();
        $driver->update(['is_active' => false]);

        $active = $this->actingAs($user, 'company')
            ->getJson(route('company.drivers.data', ['status' => 'active']));
        $inactive = $this->actingAs($user, 'company')
            ->getJson(route('company.drivers.data', ['status' => 'inactive']));

        $this->assertCount(0, $active->json('data'));
        $this->assertCount(1, $inactive->json('data'));
    }

    public function test_status_toggle_flips_is_active(): void
    {
        $user = $this->actingCompanyUser();

        $this->actingAs($user, 'company')->postJson(
            route('company.drivers.store'),
            $this->payload($user)
        )->assertOk();

        $driver = Driver::firstOrFail();

        $this->actingAs($user, 'company')->patchJson(
            route('company.drivers.status', $driver),
            ['is_active' => false]
        )->assertOk();

        $this->assertFalse($driver->fresh()->is_active);
    }

    public function test_destroy_soft_deletes_driver_and_detaches_branches(): void
    {
        $user = $this->actingCompanyUser();
        $branch = $this->makeBranch($user);

        $this->actingAs($user, 'company')->postJson(
            route('company.drivers.store'),
            $this->payload($user, ['branches' => [$branch->id]])
        )->assertOk();

        $driver = Driver::firstOrFail();

        $this->actingAs($user, 'company')
            ->deleteJson(route('company.drivers.destroy', $driver))
            ->assertOk();

        $this->assertSoftDeleted('drivers', ['id' => $driver->id]);
        $this->assertDatabaseMissing('driver_branches', [
            'driver_id' => $driver->id,
            'branch_id' => $branch->id,
        ]);
    }

    public function test_destroy_is_forbidden_for_another_companys_driver(): void
    {
        $other = $this->actingCompanyUser();
        $user = $this->actingCompanyUser();

        $this->actingAs($other, 'company')->postJson(
            route('company.drivers.store'),
            $this->payload($other)
        )->assertOk();

        $driver = Driver::firstOrFail();

        $this->actingAs($user, 'company')
            ->deleteJson(route('company.drivers.destroy', $driver))
            ->assertForbidden();

        $this->assertDatabaseHas('drivers', ['id' => $driver->id, 'deleted_at' => null]);
    }

    public function test_show_is_forbidden_for_another_companys_driver(): void
    {
        $other = $this->actingCompanyUser();
        $user = $this->actingCompanyUser();

        $this->actingAs($other, 'company')->postJson(
            route('company.drivers.store'),
            $this->payload($other)
        )->assertOk();

        $this->actingAs($user, 'company')
            ->getJson(route('company.drivers.show', Driver::firstOrFail()))
            ->assertForbidden();
    }

    public function test_export_returns_xlsx_attachment(): void
    {
        $user = $this->actingCompanyUser();
        $branch = $this->makeBranch($user);

        $this->actingAs($user, 'company')->postJson(
            route('company.drivers.store'),
            $this->payload($user, ['branches' => [$branch->id]])
        )->assertOk();

        $response = $this->actingAs($user, 'company')->get(route('company.drivers.export'));

        $response->assertOk();
        $response->assertHeader(
            'content-disposition',
            'attachment; filename="drivers-'.now()->format('Y-m-d').'.xlsx"'
        );

        $path = tempnam(sys_get_temp_dir(), 'driver-export-');
        file_put_contents($path, $response->getContent());
        $this->assertSame('PK', substr((string) file_get_contents($path), 0, 2));
        unlink($path);
    }

    public function test_guest_cannot_reach_driver_endpoints(): void
    {
        // The panel's JSON error envelope answers 200 with an internal 401 code.
        $this->getJson(route('company.drivers.data'))
            ->assertOk()
            ->assertJsonPath('code', 401);
    }
}
