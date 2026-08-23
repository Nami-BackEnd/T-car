<?php

namespace Tests\Feature;

use App\Models\Admin;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class UsersCrudTest extends TestCase
{
    use DatabaseTransactions;

    private function admin(): Admin
    {
        return Admin::first() ?? Admin::create([
            'name'     => 'Test Admin',
            'email'    => 'test-admin@tcar.com',
            'password' => Hash::make('12345678'),
        ]);
    }

    private function makeUser(array $attributes = []): User
    {
        static $sequence = 0;
        $sequence++;

        return User::create(array_merge([
            'name'       => "Sample User {$sequence}",
            'phone_code' => '+20',
            'phone'      => "10100000{$sequence}",
            'email'      => "sample{$sequence}@test.com",
            'balance'    => 0,
            'lang'       => 'en',
        ], $attributes));
    }

    public function test_ajax_crud_flow(): void
    {
        $admin = $this->admin();
        $headers = ['Accept' => 'application/json', 'X-Requested-With' => 'XMLHttpRequest'];

        // index returns paginated JSON
        for ($i = 0; $i < 13; $i++) {
            $this->makeUser();
        }
        $response = $this->actingAs($admin, 'admin')->getJson(route('admin.users.index'));
        $response->assertOk()
            ->assertJsonStructure(['data', 'pagination', 'message', 'code']);
        $this->assertCount(10, $response->json('data'));

        // search works
        $this->makeUser(['name' => 'Zyad Target']);
        $found = $this->actingAs($admin, 'admin')->getJson(route('admin.users.index', ['search' => 'Zyad']));
        $this->assertSame(1, count($found->json('data')));

        // store validation fails (missing phone)
        $invalid = $this->actingAs($admin, 'admin')->postJson(route('admin.users.store'), [
            'phone_code' => '+20',
        ]);
        $invalid->assertStatus(422);
        $this->assertTrue(isset($invalid->json('errors')['phone']));

        // store duplicate phone fails
        $existing = User::first();
        $dup = $this->actingAs($admin, 'admin')->postJson(route('admin.users.store'), [
            'phone_code' => '+20',
            'phone'      => $existing->phone,
        ]);
        $dup->assertStatus(422);

        // store succeeds
        $stored = $this->actingAs($admin, 'admin')->postJson(route('admin.users.store'), [
            'name'       => 'New User',
            'phone_code' => '+20',
            'phone'      => '1000000099',
            'email'      => 'new@test.com',
            'balance'    => 50,
            'lang'       => 'ar',
        ]);
        $stored->assertOk()->assertJsonPath('code', 200);
        $userId = $stored->json('data.user.id');
        $this->assertNotNull($userId);
        $this->assertEquals('New User', User::find($userId)->name);

        // update succeeds
        $updated = $this->actingAs($admin, 'admin')
            ->putJson(route('admin.users.update', $userId), [
                'name'       => 'Updated Name',
                'phone_code' => '+20',
                'phone'      => '1000000099',
            ]);
        $updated->assertOk();
        $fresh = User::find($userId);
        $this->assertEquals('Updated Name', $fresh->name);

        // destroy soft-deletes
        $deleted = $this->actingAs($admin, 'admin')->deleteJson(route('admin.users.destroy', $userId));
        $deleted->assertOk();
        $this->assertSoftDeleted('users', ['id' => $userId]);

        // view renders
        $view = $this->actingAs($admin, 'admin')->get(route('admin.users.index'));
        $view->assertOk()->assertSee(__('admin.nav.users'));
    }
}
