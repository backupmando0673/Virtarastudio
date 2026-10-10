<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ServiceCategory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Inertia\Inertia;
use Inertia\Response;

class AdminServiceCategoryController extends Controller
{
    /**
     * Display a listing of service categories.
     */
    public function index(): Response
    {
        $categories = ServiceCategory::withCount(['services', 'portfolios'])
            ->orderBy('sort_order')
            ->get();

        return Inertia::render('Admin/ServiceCategories/Index', [
            'categories' => $categories,
        ]);
    }

    /**
     * Store a newly created category.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'slug' => ['nullable', 'string', 'max:255', 'unique:service_categories,slug'],
            'pillar' => ['required', 'string', 'in:tech,art'],
            'icon_name' => ['required', 'string', 'max:100'],
            'description' => ['nullable', 'string'],
            'sort_order' => ['integer'],
            'is_active' => ['boolean'],
        ]);

        if (empty($validated['slug'])) {
            $baseSlug = Str::slug($validated['name']);
            $slug = $baseSlug;
            $counter = 1;
            while (ServiceCategory::where('slug', $slug)->exists()) {
                $slug = $baseSlug.'-'.$counter;
                $counter++;
            }
            $validated['slug'] = $slug;
        } else {
            $validated['slug'] = Str::slug($validated['slug']);
        }

        $category = ServiceCategory::create($validated);

        return redirect()->route('admin.service-categories.index')->with('success', "Kategori Jasa \"{$category->name}\" berhasil ditambahkan!");
    }

    /**
     * Update the specified category.
     */
    public function update(Request $request, ServiceCategory $serviceCategory): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'slug' => ['nullable', 'string', 'max:255', 'unique:service_categories,slug,'.$serviceCategory->id],
            'pillar' => ['required', 'string', 'in:tech,art'],
            'icon_name' => ['required', 'string', 'max:100'],
            'description' => ['nullable', 'string'],
            'sort_order' => ['integer'],
            'is_active' => ['boolean'],
        ]);

        if (empty($validated['slug'])) {
            $baseSlug = Str::slug($validated['name']);
            $slug = $baseSlug;
            $counter = 1;
            while (ServiceCategory::where('slug', $slug)->where('id', '!=', $serviceCategory->id)->exists()) {
                $slug = $baseSlug.'-'.$counter;
                $counter++;
            }
            $validated['slug'] = $slug;
        } else {
            $validated['slug'] = Str::slug($validated['slug']);
        }

        $serviceCategory->update($validated);

        return redirect()->route('admin.service-categories.index')->with('success', "Kategori Jasa \"{$serviceCategory->name}\" berhasil diperbarui!");
    }

    /**
     * Remove the specified category.
     */
    public function destroy(ServiceCategory $serviceCategory): RedirectResponse
    {
        $serviceCategory->delete();

        return redirect()->route('admin.service-categories.index')->with('success', 'Kategori Jasa berhasil dihapus!');
    }
}
