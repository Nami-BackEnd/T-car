<?php

namespace Tests\Feature;

use App\Models\Admin;
use App\Models\Faq;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class FaqsCrudTest extends TestCase
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

    public function test_ajax_crud_flow(): void
    {
        $admin = $this->admin();
        $headers = ['Accept' => 'application/json', 'X-Requested-With' => 'XMLHttpRequest'];

        // index returns paginated JSON
        for ($i = 1; $i <= 12; $i++) {
            Faq::create([
                'type'        => $i % 2 ? 'user' : 'driver',
                'question_ar' => "سؤال تجريبي {$i}",
                'question_en' => "Sample question {$i}",
                'answer_ar'   => "إجابة تجريبية {$i}",
                'answer_en'   => "Sample answer {$i}",
            ]);
        }
        $response = $this->actingAs($admin, 'admin')->getJson(route('admin.faqs.index'));
        $response->assertOk()->assertJsonStructure(['data', 'pagination', 'message', 'code']);
        $this->assertCount(10, $response->json('data'));

        // type filter works
        $users = $this->actingAs($admin, 'admin')->getJson(route('admin.faqs.index', ['type' => 'user']));
        $this->assertTrue(collect($users->json('data'))->every(fn ($faq) => $faq['type'] === 'user'));

        // search works
        Faq::create([
            'type'        => 'user',
            'question_ar' => 'سؤال زيك',
            'question_en' => 'How to book Zyad ride?',
            'answer_ar'   => 'إجابة.',
            'answer_en'   => 'Answer.',
        ]);
        $found = $this->actingAs($admin, 'admin')->getJson(route('admin.faqs.index', ['search' => 'Zyad']));
        $this->assertGreaterThanOrEqual(1, count($found->json('data')));

        // store validation fails
        $invalid = $this->actingAs($admin, 'admin')->postJson(route('admin.faqs.store'), [
            'question_ar' => 'سؤال',
        ]);
        $invalid->assertStatus(422);
        $errors = $invalid->json('errors');
        $this->assertTrue(isset($errors['type'], $errors['question_en'], $errors['answer_ar'], $errors['answer_en']));

        // store succeeds
        $stored = $this->actingAs($admin, 'admin')->postJson(route('admin.faqs.store'), [
            'type'        => 'user',
            'question_ar' => 'كيف أحجز رحلة؟',
            'question_en' => 'How do I book a trip?',
            'answer_ar'   => 'من شاشة الحجز الرئيسية.',
            'answer_en'   => 'From the main booking screen.',
        ]);
        $stored->assertOk();
        $faqId = $stored->json('data.faq.id');
        $this->assertNotNull($faqId);
        $this->assertEquals('How do I book a trip?', Faq::find($faqId)->question_en);

        // update succeeds
        $updated = $this->actingAs($admin, 'admin')
            ->putJson(route('admin.faqs.update', $faqId), [
                'type'        => 'driver',
                'question_ar' => 'كيف أقبل الرحلات؟',
                'question_en' => 'How do I accept trips?',
                'answer_ar'   => 'من قائمة الطلبات.',
                'answer_en'   => 'From the requests list.',
            ]);
        $updated->assertOk();
        $fresh = Faq::find($faqId);
        $this->assertEquals('driver', $fresh->type);
        $this->assertEquals('How do I accept trips?', $fresh->question_en);

        // destroy works
        $deleted = $this->actingAs($admin, 'admin')->deleteJson(route('admin.faqs.destroy', $faqId));
        $deleted->assertOk();
        $this->assertDatabaseMissing('faqs', ['id' => $faqId]);

        // view renders with editor-free table + modal
        $view = $this->actingAs($admin, 'admin')->get(route('admin.faqs.index'));
        $view->assertOk()
            ->assertSee(__('admin.nav.faqs'))
            ->assertSee('faqsTableBody')
            ->assertSee('faqsPagination');
    }
}
