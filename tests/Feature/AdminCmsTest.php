<?php

namespace Tests\Feature;

use App\Models\Faq;
use App\Models\Service;
use App\Models\SiteSetting;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AdminCmsTest extends TestCase
{
    use RefreshDatabase;

    public function test_guest_cannot_access_admin_dashboard(): void
    {
        $response = $this->get('/admin/dashboard');

        $response->assertRedirect('/login');
    }

    public function test_admin_can_view_dashboard(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get('/admin/dashboard');

        $response->assertStatus(200);
    }

    public function test_admin_can_update_settings(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->put('/admin/settings', [
            'site_name' => 'Virtarastudio Baru',
            'site_tagline' => 'Solusi Digital Nomor 1',
            'whatsapp_number' => '628999888777',
            'email' => 'halo@virtarastudio.com',
            'address' => 'Jakarta, Indonesia',
            'hero_badge' => '✨ Studio Digital',
            'hero_title' => 'Judul Hero Baru',
            'hero_title_highlight' => 'Highlight Biru Baru',
            'hero_subtitle' => 'Subjudul hero baru untuk landing page.',
            'instagram_url' => 'https://instagram.com/virtara',
            'tiktok_url' => 'https://tiktok.com/@virtara',
            'linkedin_url' => 'https://linkedin.com/company/virtara',
        ]);

        $response->assertRedirect();
        $this->assertEquals('Virtarastudio Baru', SiteSetting::get('site_name'));
        $this->assertEquals('Highlight Biru Baru', SiteSetting::get('hero_title_highlight'));
        $this->assertEquals('628999888777', SiteSetting::get('whatsapp_number'));
    }

    public function test_admin_can_create_service(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->post('/admin/services', [
            'name' => 'Pembuatan AI Chatbot',
            'tagline' => 'Cerdas & Otomatis',
            'description' => 'Layanan pembuatan chatbot pintar dengan AI terkini.',
            'icon_name' => 'Globe',
            'features' => ['Integrasi WhatsApp', 'Terkoneksi API OpenAI'],
            'starting_price' => 'Rp 1.500.000',
            'whatsapp_template' => 'Halo, saya ingin konsultasi chatbot AI.',
            'is_active' => 1,
            'sort_order' => 6,
        ]);

        $response->assertRedirect('/admin/services');
        $this->assertDatabaseHas('services', [
            'name' => 'Pembuatan AI Chatbot',
            'slug' => 'pembuatan-ai-chatbot',
            'starting_price' => 'Rp 1.500.000',
        ]);
    }

    public function test_admin_can_delete_service(): void
    {
        $user = User::factory()->create();

        $service = Service::create([
            'name' => 'Layanan Sementara',
            'slug' => 'layanan-sementara',
            'description' => 'Layanan yang akan dihapus',
            'icon_name' => 'Globe',
            'starting_price' => 'Rp 100.000',
            'sort_order' => 99,
            'is_active' => true,
        ]);

        $response = $this->actingAs($user)->delete("/admin/services/{$service->id}");

        $response->assertRedirect('/admin/services');
        $this->assertDatabaseMissing('services', [
            'id' => $service->id,
        ]);
    }

    public function test_admin_can_update_service(): void
    {
        $user = User::factory()->create();

        $service = Service::create([
            'name' => 'Website Murah',
            'slug' => 'website-murah',
            'description' => 'Deskripsi lama',
            'icon_name' => 'Globe',
            'features' => ['Fitur 1'],
            'starting_price' => 'Rp 500.000',
            'sort_order' => 1,
            'is_active' => true,
        ]);

        $response = $this->actingAs($user)->put("/admin/services/{$service->id}", [
            'name' => 'Website Murah & Cepat',
            'tagline' => 'Paling Cepat',
            'description' => 'Deskripsi baru',
            'icon_name' => 'Globe',
            'features' => ['Fitur Baru 1', 'Fitur Baru 2'],
            'starting_price' => 'Rp 650.000',
            'whatsapp_template' => 'Pesan baru',
            'is_active' => 1,
            'sort_order' => 1,
        ]);

        $response->assertRedirect('/admin/services');
        $this->assertDatabaseHas('services', [
            'id' => $service->id,
            'name' => 'Website Murah & Cepat',
            'starting_price' => 'Rp 650.000',
        ]);
    }

    public function test_admin_can_create_and_delete_faq(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->post('/admin/faqs', [
            'question' => 'Apakah ada garansi?',
            'answer' => 'Ya, ada garansi 30 hari.',
            'category' => 'Garansi',
            'sort_order' => 1,
            'is_active' => 1,
        ]);

        $response->assertRedirect('/admin/faqs');
        $this->assertDatabaseHas('faqs', [
            'question' => 'Apakah ada garansi?',
        ]);

        $faq = Faq::where('question', 'Apakah ada garansi?')->first();
        $delResponse = $this->actingAs($user)->delete("/admin/faqs/{$faq->id}");
        $delResponse->assertRedirect('/admin/faqs');
        $this->assertDatabaseMissing('faqs', [
            'id' => $faq->id,
        ]);
    }
}
