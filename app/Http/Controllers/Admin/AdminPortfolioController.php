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
            'image' => ['nullable', 'image', 'mimes:png,jpg,jpeg,webp,svg', 'max:3072'],
            'image_url' => ['nullable', 'string', 'max:1000'],
            'demo_url' => ['nullable', 'string', 'max:1000'],
            'technologies' => ['nullable', 'array'],
            'is_featured' => ['boolean'],
            'sort_order' => ['integer'],
        ]);

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('portfolios', 'public');
            $validated['image_url'] = Storage::url($path);
        }

        unset($validated['image']);

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
            'image' => ['nullable', 'image', 'mimes:png,jpg,jpeg,webp,svg', 'max:3072'],
            'image_url' => ['nullable', 'string', 'max:1000'],
            'demo_url' => ['nullable', 'string', 'max:1000'],
            'technologies' => ['nullable', 'array'],
            'is_featured' => ['boolean'],
            'sort_order' => ['integer'],
            'remove_image' => ['nullable', 'boolean'],
        ]);

        if ($request->boolean('remove_image')) {
            if ($portfolio->image_url && str_contains($portfolio->image_url, '/storage/')) {
                $oldPath = str_replace('/storage/', '', parse_url($portfolio->image_url, PHP_URL_PATH));
                Storage::disk('public')->delete($oldPath);
            }
            $validated['image_url'] = null;
        } elseif ($request->hasFile('image')) {
            if ($portfolio->image_url && str_contains($portfolio->image_url, '/storage/')) {
                $oldPath = str_replace('/storage/', '', parse_url($portfolio->image_url, PHP_URL_PATH));
                Storage::disk('public')->delete($oldPath);
            }
            $path = $request->file('image')->store('portfolios', 'public');
            $validated['image_url'] = Storage::url($path);
        }

        unset($validated['image'], $validated['remove_image']);

        $portfolio->update($validated);

        return redirect()->route('admin.portfolios.index')->with('success', 'Portofolio berhasil diperbarui!');
    }

    /**
     * Remove the specified portfolio from storage.
     */
    public function destroy(Portfolio $portfolio): RedirectResponse
    {
        if ($portfolio->image_url && str_contains($portfolio->image_url, '/storage/')) {
            $oldPath = str_replace('/storage/', '', parse_url($portfolio->image_url, PHP_URL_PATH));
            Storage::disk('public')->delete($oldPath);
        }

        $portfolio->delete();

        return redirect()->route('admin.portfolios.index')->with('success', 'Portofolio berhasil dihapus!');
    }
}
