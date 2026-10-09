<?php

namespace App\Http\Controllers;

use App\Models\Faq;
use App\Models\Portfolio;
use App\Models\Service;
use App\Models\SiteSetting;
use App\Models\Testimonial;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Inertia\Response;

class HomeController extends Controller
{
    /**
     * Display the public landing page.
     */
    public function index(): Response
    {
        $settings = SiteSetting::allKeyValues();
        $whatsappNumber = $settings['whatsapp_number'] ?? '6281234567890';

        $services = Service::where('is_active', true)
            ->where('is_featured', true)
            ->orderBy('sort_order')
            ->get()
            ->map(function (Service $service) use ($whatsappNumber) {
                return [
                    'id' => $service->id,
                    'name' => $service->name,
                    'slug' => $service->slug,
                    'tagline' => $service->tagline,
                    'description' => $service->description,
                    'icon_name' => $service->icon_name,
                    'features' => $service->features ?? [],
                    'starting_price' => $service->starting_price,
                    'whatsapp_url' => $service->getWhatsAppUrl($whatsappNumber),
                    'is_featured' => $service->is_featured,
                ];
            });

        $portfolios = Portfolio::orderBy('sort_order')
            ->get()
            ->map(function (Portfolio $portfolio) {
                return [
                    'id' => $portfolio->id,
                    'title' => $portfolio->title,
                    'slug' => $portfolio->slug,
                    'category' => $portfolio->category,
                    'client_name' => $portfolio->client_name,
                    'description' => $portfolio->description,
                    'image_url' => $portfolio->image_url,
                    'demo_url' => $portfolio->demo_url,
                    'technologies' => $portfolio->technologies ?? [],
                    'is_featured' => $portfolio->is_featured,
                ];
            });

        $testimonials = Testimonial::where('is_featured', true)
            ->orderBy('sort_order')
            ->get();

        $faqs = Faq::where('is_active', true)
            ->orderBy('sort_order')
            ->get();

        $defaultWaUrl = 'https://wa.me/'.preg_replace('/[^0-9]/', '', $whatsappNumber).'?text='.rawurlencode('Halo Virtarastudio, saya ingin konsultasi gratis untuk proyek digital saya.');

        return Inertia::render('Welcome', [
            'canLogin' => Route::has('login'),
            'settings' => $settings,
            'services' => $services,
            'portfolios' => $portfolios,
            'testimonials' => $testimonials,
            'faqs' => $faqs,
            'whatsappUrl' => $defaultWaUrl,
        ]);
    }
}
