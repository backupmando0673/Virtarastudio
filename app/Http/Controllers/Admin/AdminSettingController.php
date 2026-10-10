<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SiteSetting;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;
use Inertia\Response;

class AdminSettingController extends Controller
{
    /**
     * Display the settings edit form.
     */
    public function index(): Response
    {
        $settings = SiteSetting::allKeyValues();
        if (isset($settings['hero_showcase_items'])) {
            $settings['hero_showcase_items'] = json_decode($settings['hero_showcase_items'], true);
        } else {
            $defaultServices = \App\Models\Service::whereIn('slug', ['website-murah', 'app-android', 'game-android', 'app-ar'])->get()->keyBy('slug');
            
            $settings['hero_showcase_items'] = [
                [
                    'service_id' => $defaultServices->get('website-murah')?->id,
                    'title' => 'Website Murah',
                    'badge_text' => 'SENI',
                    'subtitle' => 'Landing Page & Toko Online Estetik',
                    'theme' => 'amber'
                ],
                [
                    'service_id' => $defaultServices->get('app-android')?->id,
                    'title' => 'App Android',
                    'badge_text' => 'TEKNO',
                    'subtitle' => 'Aplikasi Bisnis, Kasir & Backend',
                    'theme' => 'blue'
                ],
                [
                    'service_id' => $defaultServices->get('game-android')?->id,
                    'title' => 'Game Android',
                    'badge_text' => 'SENI',
                    'subtitle' => 'Visual 2D/3D & Edukasi Seru',
                    'theme' => 'amber'
                ],
                [
                    'service_id' => $defaultServices->get('app-ar')?->id,
                    'title' => 'App AR & VR',
                    'badge_text' => 'FUTURISTIK',
                    'subtitle' => '3D Product Viewer & 360° Virtual Tour',
                    'theme' => 'blue'
                ]
            ];
        }

        $services = \App\Models\Service::select('id', 'name', 'starting_price', 'icon_name')->where('is_active', true)->get();

        return Inertia::render('Admin/Settings/Index', [
            'settings' => $settings,
            'services' => $services,
        ]);
    }

    /**
     * Update the site settings.
     */
    public function update(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'site_name' => ['required', 'string', 'max:255'],
            'site_tagline' => ['nullable', 'string', 'max:500'],
            'whatsapp_number' => ['required', 'string', 'max:50'],
            'email' => ['nullable', 'email', 'max:255'],
            'address' => ['nullable', 'string', 'max:255'],
            'hero_badge' => ['nullable', 'string', 'max:255'],
            'hero_title' => ['required', 'string', 'max:500'],
            'hero_title_highlight' => ['nullable', 'string', 'max:500'],
            'hero_subtitle' => ['required', 'string'],
            'instagram_url' => ['nullable', 'url', 'max:255'],
            'tiktok_url' => ['nullable', 'url', 'max:255'],
            'linkedin_url' => ['nullable', 'url', 'max:255'],
            'site_logo' => ['nullable', 'image', 'mimes:png,jpg,jpeg,svg,webp', 'max:2048'],
            'site_favicon' => ['nullable', 'file', 'mimes:png,jpg,jpeg,ico,svg,webp', 'max:1024'],
            'remove_site_logo' => ['nullable', 'boolean'],
            'remove_site_favicon' => ['nullable', 'boolean'],
            'hero_showcase_items' => ['nullable', 'array'],
        ]);

        // Handle site_logo deletion
        if ($request->boolean('remove_site_logo')) {
            $oldLogo = SiteSetting::get('site_logo');
            if ($oldLogo) {
                $path = str_replace('/storage/', '', parse_url($oldLogo, PHP_URL_PATH));
                Storage::disk('public')->delete($path);
                SiteSetting::set('site_logo', null);
            }
        } elseif ($request->hasFile('site_logo')) {
            $oldLogo = SiteSetting::get('site_logo');
            if ($oldLogo) {
                $path = str_replace('/storage/', '', parse_url($oldLogo, PHP_URL_PATH));
                Storage::disk('public')->delete($path);
            }
            $logoPath = $request->file('site_logo')->store('settings', 'public');
            SiteSetting::set('site_logo', Storage::url($logoPath));
        }

        // Handle site_favicon deletion
        if ($request->boolean('remove_site_favicon')) {
            $oldFavicon = SiteSetting::get('site_favicon');
            if ($oldFavicon) {
                $path = str_replace('/storage/', '', parse_url($oldFavicon, PHP_URL_PATH));
                Storage::disk('public')->delete($path);
                SiteSetting::set('site_favicon', null);
            }
        } elseif ($request->hasFile('site_favicon')) {
            $oldFavicon = SiteSetting::get('site_favicon');
            if ($oldFavicon) {
                $path = str_replace('/storage/', '', parse_url($oldFavicon, PHP_URL_PATH));
                Storage::disk('public')->delete($path);
            }
            $faviconPath = $request->file('site_favicon')->store('settings', 'public');
            SiteSetting::set('site_favicon', Storage::url($faviconPath));
        }

        // Save text settings
        $textFields = [
            'site_name', 'site_tagline', 'whatsapp_number', 'email', 'address',
            'hero_badge', 'hero_title', 'hero_title_highlight', 'hero_subtitle',
            'instagram_url', 'tiktok_url', 'linkedin_url',
        ];

        foreach ($textFields as $field) {
            if (array_key_exists($field, $validated)) {
                SiteSetting::set($field, $validated[$field]);
            }
        }

        if ($request->has('hero_showcase_items')) {
            SiteSetting::set('hero_showcase_items', json_encode($request->input('hero_showcase_items')));
        }

        return redirect()->back()->with('success', 'Pengaturan website, logo, dan favicon berhasil diperbarui!');
    }
}
