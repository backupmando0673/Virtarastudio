<?php

namespace Tests\Feature;

use App\Models\Portfolio;
use App\Models\Service;
use App\Models\SiteSetting;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Inertia\Testing\AssertableInertia as Assert;
use Tests\TestCase;

class LandingPageTest extends TestCase
{
    use RefreshDatabase;

    public function test_landing_page_can_be_rendered(): void
    {
        SiteSetting::set('site_name', 'Virtarastudio');
        SiteSetting::set('whatsapp_number', '6281234567890');
        SiteSetting::set('hero_title', 'Harmoni Karya Seni & Kecanggihan');
        SiteSetting::set('hero_title_highlight', 'Teknologi Digital');

        Service::create([
            'name' => 'Pembuatan Website Murah',
            'slug' => 'website-murah',
            'tagline' => 'Hemat',
            'description' => 'Website profesional terjangkau',
            'icon_name' => 'Globe',
            'features' => ['Gratis Domain'],
            'starting_price' => 'Rp 499.000',
            'whatsapp_template' => 'Halo Virtarastudio',
            'sort_order' => 1,
            'is_featured' => true,
            'is_active' => true,
        ]);

        $response = $this->get('/');

        $response->assertStatus(200);
        $response->assertInertia(fn (Assert $page) => $page
            ->component('Welcome')
            ->has('services', 1)
            ->where('settings.site_name', 'Virtarastudio')
            ->where('settings.hero_title', 'Harmoni Karya Seni & Kecanggihan')
            ->where('settings.hero_title_highlight', 'Teknologi Digital')
            ->has('whatsappUrl')
        );
    }

    public function test_portfolio_detail_page_can_be_rendered(): void
    {
        SiteSetting::set('site_name', 'Virtarastudio');
        SiteSetting::set('whatsapp_number', '6281234567890');

        $portfolio = Portfolio::create([
            'category' => 'website',
            'title' => 'Toko Kopi Artisan',
            'slug' => 'toko-kopi-artisan',
            'client_name' => 'Artisan Roastery',
            'description' => 'Website toko kopi modern',
            'image_url' => 'https://example.com/cover.jpg',
            'gallery_images' => ['https://example.com/cover.jpg', 'https://example.com/slide2.jpg'],
            'demo_url' => null,
            'technologies' => ['Laravel', 'Vue.js'],
            'is_featured' => true,
            'sort_order' => 1,
        ]);

        $response = $this->get('/portofolio/'.$portfolio->slug);

        $response->assertStatus(200);
        $response->assertInertia(fn (Assert $page) => $page
            ->component('Portfolio/Show')
            ->where('portfolio.title', 'Toko Kopi Artisan')
            ->where('portfolio.slug', 'toko-kopi-artisan')
            ->has('portfolio.gallery_images', 2)
            ->has('whatsappUrl')
        );
    }
}
