<?php

namespace Tests\Feature;

use App\Models\Admin;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class SettingsTest extends TestCase
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

    public function test_ajax_update_flow(): void
    {
        $admin = $this->admin();

        $payload = [
            'daily_booking_showing'           => '1',
            'monthly_booking_showing'         => '0',
            'station_booking_showing'         => '1',
            'airport_booking_showing'         => '0',
            'international_booking_showing'   => '1',
            'rewards_screen_showing'          => '1',
            'free_cancellation_time'          => 6,
            'partial_cancellation_time'       => 2,
            'partial_cancellation_percentage' => 12.5,
            'number_days_of_refund'           => 7,
            'tax_value'                       => 15,
            'riyal_to_points_conversion'      => 3.5,
            'driver_reword_value'             => 2.0,
        ];

        // update via AJAX succeeds
        $updated = $this->actingAs($admin, 'admin')
            ->putJson(route('admin.settings.update'), $payload);

        $updated->assertOk()
            ->assertJsonStructure(['data', 'message', 'code']);

        $setting = $updated->json('data.setting');
        $this->assertTrue($setting['daily_booking_showing']);
        $this->assertFalse($setting['monthly_booking_showing']);
        $this->assertTrue($setting['rewards_screen_showing']);
        $this->assertEquals(6, $setting['free_cancellation_time']);
        $this->assertEquals(12.5, $setting['partial_cancellation_percentage']);
        $this->assertEquals(15, $setting['tax_value']);

        $this->assertDatabaseHas('settings', [
            'free_cancellation_time'     => 6,
            'riyal_to_points_conversion' => 3.5,
        ]);

        // validation fails with 422 + errors object
        $invalid = $this->actingAs($admin, 'admin')->putJson(route('admin.settings.update'), array_merge($payload, [
            'free_cancellation_time' => null,
            'tax_value'              => 150,
        ]));
        $invalid->assertStatus(422);
        $errors = $invalid->json('errors');
        $this->assertTrue(isset($errors['free_cancellation_time'], $errors['tax_value']));

        // non-AJAX update still redirects (fallback)
        $redirect = $this->actingAs($admin, 'admin')
            ->from(route('admin.settings.index'))
            ->put(route('admin.settings.update'), $payload);
        $redirect->assertRedirect();

        // view renders form
        $view = $this->actingAs($admin, 'admin')->get(route('admin.settings.index'));
        $view->assertOk()
            ->assertSee('settingsForm')
            ->assertSee('settingsSaveBtn');
    }
}
