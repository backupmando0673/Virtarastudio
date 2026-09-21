<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Faq;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class AdminFaqController extends Controller
{
    /**
     * Display a listing of FAQs.
     */
    public function index(): Response
    {
        $faqs = Faq::orderBy('sort_order')->get();

        return Inertia::render('Admin/Faqs/Index', [
            'faqs' => $faqs,
        ]);
    }

    /**
     * Store a newly created FAQ in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'question' => ['required', 'string', 'max:500'],
            'answer' => ['required', 'string'],
            'category' => ['required', 'string', 'max:100'],
            'sort_order' => ['integer'],
            'is_active' => ['boolean'],
        ]);

        Faq::create($validated);

        return redirect()->route('admin.faqs.index')->with('success', 'Pertanyaan FAQ berhasil ditambahkan!');
    }

    /**
     * Update the specified FAQ in storage.
     */
    public function update(Request $request, Faq $faq): RedirectResponse
    {
        $validated = $request->validate([
            'question' => ['required', 'string', 'max:500'],
            'answer' => ['required', 'string'],
            'category' => ['required', 'string', 'max:100'],
            'sort_order' => ['integer'],
            'is_active' => ['boolean'],
        ]);

        $faq->update($validated);

        return redirect()->route('admin.faqs.index')->with('success', 'Pertanyaan FAQ berhasil diperbarui!');
    }

    /**
     * Remove the specified FAQ from storage.
     */
    public function destroy(Faq $faq): RedirectResponse
    {
        $faq->delete();

        return redirect()->route('admin.faqs.index')->with('success', 'Pertanyaan FAQ berhasil dihapus!');
    }
}
