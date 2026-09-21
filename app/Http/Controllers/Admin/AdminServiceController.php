<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Service;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class AdminServiceController extends Controller
{
    /**
     * Display a listing of services.
     */
    public function index(): Response
    {
        $services = Service::orderBy('sort_order')->get();

        return Inertia::render('Admin/Services/Index', [
            'services' => $services,
        ]);
    }

    /**
     * Show the form for editing the specified service.
     */
    public function edit(Service $service): Response
    {
        return Inertia::render('Admin/Services/Edit', [
            'service' => $service,
        ]);
    }

    /**
     * Update the specified service in storage.
     */
    public function update(Request $request, Service $service): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'tagline' => ['nullable', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'icon_name' => ['required', 'string', 'max:100'],
            'features' => ['nullable', 'array'],
            'features.*' => ['string', 'max:255'],
            'starting_price' => ['required', 'string', 'max:100'],
            'whatsapp_template' => ['nullable', 'string'],
            'is_active' => ['boolean'],
            'sort_order' => ['integer'],
        ]);

        $service->update($validated);

        return redirect()->route('admin.services.index')->with('success', "Layanan {$service->name} berhasil diperbarui!");
    }
}
