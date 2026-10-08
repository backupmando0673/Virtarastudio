<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Testimonial;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;
use Inertia\Response;

class AdminTestimonialController extends Controller
{
    /**
     * Display a listing of client testimonials.
     */
    public function index(): Response
    {
        $testimonials = Testimonial::orderBy('sort_order')->orderBy('id', 'desc')->get();

        return Inertia::render('Admin/Testimonials/Index', [
            'testimonials' => $testimonials,
        ]);
    }

    /**
     * Store a newly created testimonial in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'client_name' => ['required', 'string', 'max:255'],
            'client_role' => ['nullable', 'string', 'max:255'],
            'company' => ['nullable', 'string', 'max:255'],
            'avatar' => ['nullable', 'image', 'mimes:png,jpg,jpeg,webp', 'max:2048'],
            'avatar_url' => ['nullable', 'string', 'max:1000'],
            'rating' => ['required', 'integer', 'min:1', 'max:5'],
            'content' => ['required', 'string'],
            'is_featured' => ['boolean'],
            'sort_order' => ['integer'],
        ]);

        if ($request->hasFile('avatar')) {
            $path = $request->file('avatar')->store('testimonials', 'public');
            $validated['avatar_url'] = Storage::url($path);
        }

        unset($validated['avatar']);

        Testimonial::create($validated);

        return redirect()->route('admin.testimonials.index')->with('success', 'Testimoni klien berhasil ditambahkan!');
    }

    /**
     * Update the specified testimonial in storage.
     */
    public function update(Request $request, Testimonial $testimonial): RedirectResponse
    {
        $validated = $request->validate([
            'client_name' => ['required', 'string', 'max:255'],
            'client_role' => ['nullable', 'string', 'max:255'],
            'company' => ['nullable', 'string', 'max:255'],
            'avatar' => ['nullable', 'image', 'mimes:png,jpg,jpeg,webp', 'max:2048'],
            'avatar_url' => ['nullable', 'string', 'max:1000'],
            'rating' => ['required', 'integer', 'min:1', 'max:5'],
            'content' => ['required', 'string'],
            'is_featured' => ['boolean'],
            'sort_order' => ['integer'],
            'remove_avatar' => ['nullable', 'boolean'],
        ]);

        if ($request->boolean('remove_avatar')) {
            if ($testimonial->avatar_url && str_contains($testimonial->avatar_url, '/storage/')) {
                $oldPath = str_replace('/storage/', '', parse_url($testimonial->avatar_url, PHP_URL_PATH));
                Storage::disk('public')->delete($oldPath);
            }
            $validated['avatar_url'] = null;
        } elseif ($request->hasFile('avatar')) {
            if ($testimonial->avatar_url && str_contains($testimonial->avatar_url, '/storage/')) {
                $oldPath = str_replace('/storage/', '', parse_url($testimonial->avatar_url, PHP_URL_PATH));
                Storage::disk('public')->delete($oldPath);
            }
            $path = $request->file('avatar')->store('testimonials', 'public');
            $validated['avatar_url'] = Storage::url($path);
        }

        unset($validated['avatar'], $validated['remove_avatar']);

        $testimonial->update($validated);

        return redirect()->route('admin.testimonials.index')->with('success', 'Testimoni klien berhasil diperbarui!');
    }

    /**
     * Remove the specified testimonial from storage.
     */
    public function destroy(Testimonial $testimonial): RedirectResponse
    {
        if ($testimonial->avatar_url && str_contains($testimonial->avatar_url, '/storage/')) {
            $oldPath = str_replace('/storage/', '', parse_url($testimonial->avatar_url, PHP_URL_PATH));
            Storage::disk('public')->delete($oldPath);
        }

        $testimonial->delete();

        return redirect()->route('admin.testimonials.index')->with('success', 'Testimoni klien berhasil dihapus!');
    }
}
