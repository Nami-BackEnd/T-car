<?php

namespace Tests\Feature;

use App\Models\Admin;
use App\Models\ClientInstruction;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class ClientInstructionsTest extends TestCase
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

    public function test_index_and_update_flow(): void
    {
        $admin = $this->admin();
        ClientInstruction::query()->delete();

        $view = $this->actingAs($admin, 'admin')->get(route('admin.client-instructions.index'));
        $view->assertOk()
            ->assertSee('contentForm')
            ->assertDontSee('sections[user][title_ar]');

        $payload = [
            'sections' => [
                'user'   => ['content_ar' => 'محتوى المستخدم', 'content_en' => 'User content'],
                'driver' => ['content_ar' => 'محتوى الكابتن', 'content_en' => 'Driver content'],
            ],
        ];

        $updated = $this->actingAs($admin, 'admin')
            ->from(route('admin.client-instructions.index'))
            ->put(route('admin.client-instructions.update'), $payload);

        $updated->assertRedirect();

        foreach (['user' => 'User content', 'driver' => 'Driver content'] as $type => $content) {
            $this->assertDatabaseHas('client_instructions', ['type' => $type, 'content_en' => $content]);
        }

        // validation: empty content fails with 302 + session errors (web flow)
        $invalid = $this->actingAs($admin, 'admin')
            ->from(route('admin.client-instructions.index'))
            ->put(route('admin.client-instructions.update'), [
                'sections' => [
                    'user'   => ['content_ar' => '', 'content_en' => ''],
                    'driver' => ['content_ar' => 'x', 'content_en' => 'y'],
                ],
            ]);
        $invalid->assertSessionHasErrors(['sections.user.content_ar', 'sections.user.content_en']);
    }
}
