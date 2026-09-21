<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Faq;
use App\Models\Portfolio;
use App\Models\Service;
use App\Models\SiteSetting;
use Inertia\Inertia;
use Inertia\Response;

class AdminDashboardController extends Controller
{
    /**
     * Display the admin dashboard summary.
     */
    public function index(): Response
    {
        $stats = [
            'total_services' => Service::count(),
            'active_services' => Service::where('is_active', true)->count(),
            'total_portfolios' => Portfolio::count(),
            'total_faqs' => Faq::count(),
            'whatsapp_number' => SiteSetting::get('whatsapp_number', '-'),
            'site_name' => SiteSetting::get('site_name', 'Virtarastudio'),
        ];

        $services = Service::orderBy('sort_order')->take(5)->get();
        $recentPortfolios = Portfolio::orderBy('id', 'desc')->take(4)->get();

        return Inertia::render('Admin/Dashboard', [
            'stats' => $stats,
            'services' => $services,
            'recentPortfolios' => $recentPortfolios,
        ]);
    }
}
