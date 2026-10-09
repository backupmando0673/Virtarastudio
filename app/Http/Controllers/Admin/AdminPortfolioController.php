<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Portfolio;
use App\Models\Service;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Inertia\Inertia;
use Inertia\Response;

class AdminPortfolioController extends Controller
{
    /**
     * Display a listing of portfolio projects.
     */
    public function index(): Response
    {
        $portfolios = Portfolio::with('service')->orderBy('sort_order')->get();

        return Inertia::render('Admin/Portfolios/Index', [
            'portfolios' => $portfolios,
        ]);
    }

    /**
     * Show the form for creating a new portfolio.
     */
    public function create(): Response
    {
        $services = Service::select('id', 'name')->get();

        return Inertia::render('Admin/Portfolios/Form', [
            'portfolio' => null,
            'services' => $services,
        ]);
    }

    /**
     * Store a newly created portfolio in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'service_id' => ['nullable', 'exists:services,id'],
            'category' => ['required', 'string', 'in:website,android,game,ar,vr'],
            'title' => ['required', 'string', 'max:255'],
            'client_name' => ['nullable', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'image' => ['nullable', 'image', 'mimes:png,jpg,jpeg,webp,svg', 'max:5120'],
            'image_url' => ['nullable', 'string', 'max:1000'],
            'gallery_images' => ['nullable', 'array'],
            'gallery_images.*' => ['nullable', 'string', 'max:1000'],
            'new_gallery_images' => ['nullable', 'array'],
            'new_gallery_images.*' => ['file', 'image', 'mimes:png,jpg,jpeg,webp,svg', 'max:5120'],
            'demo_url' => ['nullable', 'string', 'max:1000'],
            'technologies' => ['nullable', 'array'],
            'is_featured' => ['boolean'],
            'sort_order' => ['integer'],
        ]);

        $gallery = $validated['gallery_images'] ?? [];

        // Upload single primary image if provided
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('portfolios', 'public');
            $mainUrl = Storage::url($path);
            $validated['image_url'] = $mainUrl;
            if (! in_array($mainUrl, $gallery)) {
                array_unshift($gallery, $mainUrl);
            }
        }

        // Upload new gallery images if provided
        if ($request->hasFile('new_gallery_images')) {
            foreach ($request->file('new_gallery_images') as $file) {
                $path = $file->store('portfolios', 'public');
                $gallery[] = Storage::url($path);
            }
        }

        // If no main image chosen yet but gallery has items, default first gallery item as main
        if (empty($validated['image_url']) && ! empty($gallery)) {
            $validated['image_url'] = $gallery[0];
        }

        // Ensure main image is in gallery if present
        if (! empty($validated['image_url']) && ! in_array($validated['image_url'], $gallery)) {
            array_unshift($gallery, $validated['image_url']);
        }

        $validated['gallery_images'] = array_values(array_unique(array_filter($gallery)));
        unset($validated['image'], $validated['new_gallery_images']);

        $validated['slug'] = Str::slug($validated['title']).'-'.time();

        Portfolio::create($validated);

        return redirect()->route('admin.portfolios.index')->with('success', 'Portofolio berhasil ditambahkan!');
    }

    /**
     * Show the form for editing the specified portfolio.
     */
    public function edit(Portfolio $portfolio): Response
    {
        $services = Service::select('id', 'name')->get();

        return Inertia::render('Admin/Portfolios/Form', [
            'portfolio' => $portfolio,
            'services' => $services,
        ]);
    }

    /**
     * Update the specified portfolio in storage.
     */
    public function update(Request $request, Portfolio $portfolio): RedirectResponse
    {
        $validated = $request->validate([
            'service_id' => ['nullable', 'exists:services,id'],
            'category' => ['required', 'string', 'in:website,android,game,ar,vr'],
            'title' => ['required', 'string', 'max:255'],
            'client_name' => ['nullable', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'image' => ['nullable', 'image', 'mimes:png,jpg,jpeg,webp,svg', 'max:5120'],
            'image_url' => ['nullable', 'string', 'max:1000'],
            'gallery_images' => ['nullable', 'array'],
            'gallery_images.*' => ['nullable', 'string', 'max:1000'],
            'new_gallery_images' => ['nullable', 'array'],
            'new_gallery_images.*' => ['file', 'image', 'mimes:png,jpg,jpeg,webp,svg', 'max:5120'],
            'demo_url' => ['nullable', 'string', 'max:1000'],
            'technologies' => ['nullable', 'array'],
            'is_featured' => ['boolean'],
            'sort_order' => ['integer'],
            'remove_image' => ['nullable', 'boolean'],
        ]);

        $oldImages = array_filter(array_merge(
            [$portfolio->image_url],
            $portfolio->gallery_images ?? []
        ));

        $gallery = $validated['gallery_images'] ?? [];

        // Upload single primary image if provided
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('portfolios', 'public');
            $mainUrl = Storage::url($path);
            $validated['image_url'] = $mainUrl;
            if (! in_array($mainUrl, $gallery)) {
                array_unshift($gallery, $mainUrl);
            }
        }

        // Upload new gallery images if provided
        if ($request->hasFile('new_gallery_images')) {
            foreach ($request->file('new_gallery_images') as $file) {
                $path = $file->store('portfolios', 'public');
                $gallery[] = Storage::url($path);
            }
        }

        if ($request->boolean('remove_image')) {
            $validated['image_url'] = null;
        }

        // If main image is empty but gallery exists, set first item as main
        if (empty($validated['image_url']) && ! empty($gallery)) {
            $validated['image_url'] = $gallery[0];
        }

        // Ensure main image is in gallery
        if (! empty($validated['image_url']) && ! in_array($validated['image_url'], $gallery)) {
            array_unshift($gallery, $validated['image_url']);
        }

        $finalGallery = array_values(array_unique(array_filter($gallery)));
        $validated['gallery_images'] = $finalGallery;

        // Cleanup any deleted storage files that are no longer in finalGallery or image_url
        $currentImages = array_filter(array_merge([$validated['image_url']], $finalGallery));
        foreach ($oldImages as $oldImg) {
            if ($oldImg && ! in_array($oldImg, $currentImages) && str_contains($oldImg, '/storage/')) {
                $oldPath = str_replace('/storage/', '', parse_url($oldImg, PHP_URL_PATH));
                Storage::disk('public')->delete($oldPath);
            }
        }

        unset($validated['image'], $validated['new_gallery_images'], $validated['remove_image']);

        $portfolio->update($validated);

        return redirect()->route('admin.portfolios.index')->with('success', 'Portofolio berhasil diperbarui!');
    }

    /**
     * Remove the specified portfolio from storage.
     */
    public function destroy(Portfolio $portfolio): RedirectResponse
    {
        $allImages = array_filter(array_merge(
            [$portfolio->image_url],
            $portfolio->gallery_images ?? []
        ));

        foreach ($allImages as $img) {
            if ($img && str_contains($img, '/storage/')) {
                $oldPath = str_replace('/storage/', '', parse_url($img, PHP_URL_PATH));
                Storage::disk('public')->delete($oldPath);
            }
        }

        $portfolio->delete();

        return redirect()->route('admin.portfolios.index')->with('success', 'Portofolio berhasil dihapus!');
    }
}
