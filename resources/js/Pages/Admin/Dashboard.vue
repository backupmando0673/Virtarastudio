<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link } from '@inertiajs/vue3';
import { Card, CardHeader, CardTitle, CardContent } from '@/Components/ui/card';
import { Button } from '@/Components/ui/button';
import { Badge } from '@/Components/ui/badge';
import {
    LayoutDashboard,
    Layers,
    FolderKanban,
    HelpCircle,
    MessageCircle,
    ExternalLink,
    Settings,
    ArrowRight,
    Edit3,
} from '@lucide/vue';

const props = defineProps({
    stats: {
        type: Object,
        default: () => ({}),
    },
    services: {
        type: Array,
        default: () => [],
    },
    recentPortfolios: {
        type: Array,
        default: () => [],
    },
});
</script>

<template>
    <Head title="Admin Dashboard - Virtarastudio" />

    <AuthenticatedLayout>
        <template #header>
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                <div>
                    <h2 class="text-2xl font-bold text-slate-900 tracking-tight">
                        Dashboard Manajemen Konten
                    </h2>
                    <p class="text-sm text-slate-500 mt-1">
                        Kelola konten, nomor WhatsApp, harga, dan portofolio landing page Virtarastudio.
                    </p>
                </div>
                <div class="flex items-center gap-3">
                    <a
                        href="/"
                        target="_blank"
                        class="inline-flex items-center gap-2 rounded-xl bg-slate-900 px-4 py-2.5 text-xs font-semibold text-white hover:bg-slate-800 transition"
                    >
                        <span>Lihat Website</span>
                        <ExternalLink class="h-4 w-4" />
                    </a>
                </div>
            </div>
        </template>

        <div class="py-8">
            <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 space-y-8">
                <!-- Stats Row -->
                <div class="grid gap-5 sm:grid-cols-2 lg:grid-cols-5">
                    <Card class="border-slate-200">
                        <CardHeader class="flex flex-row items-center justify-between pb-2">
                            <CardTitle class="text-xs font-semibold text-slate-500 uppercase tracking-wider">
                                Kategori Jasa
                            </CardTitle>
                            <FolderKanban class="h-4 w-4 text-amber-500" />
                        </CardHeader>
                        <CardContent>
                            <div class="text-2xl font-black text-slate-900">
                                {{ stats.total_service_categories || 0 }}
                            </div>
                            <p class="text-xs text-slate-500 mt-1">Kategori aktif</p>
                        </CardContent>
                    </Card>

                    <Card class="border-slate-200">
                        <CardHeader class="flex flex-row items-center justify-between pb-2">
                            <CardTitle class="text-xs font-semibold text-slate-500 uppercase tracking-wider">
                                Layanan Aktif
                            </CardTitle>
                            <Layers class="h-4 w-4 text-orange-500" />
                        </CardHeader>
                        <CardContent>
                            <div class="text-2xl font-black text-slate-900">
                                {{ stats.active_services }} / {{ stats.total_services }}
                            </div>
                            <p class="text-xs text-slate-500 mt-1">Website, App, Game, dll</p>
                        </CardContent>
                    </Card>

                    <Card class="border-slate-200">
                        <CardHeader class="flex flex-row items-center justify-between pb-2">
                            <CardTitle class="text-xs font-semibold text-slate-500 uppercase tracking-wider">
                                Total Portofolio
                            </CardTitle>
                            <FolderKanban class="h-4 w-4 text-orange-500" />
                        </CardHeader>
                        <CardContent>
                            <div class="text-2xl font-black text-slate-900">
                                {{ stats.total_portfolios }}
                            </div>
                            <p class="text-xs text-slate-500 mt-1">Projek showcase klien</p>
                        </CardContent>
                    </Card>

                    <Card class="border-slate-200">
                        <CardHeader class="flex flex-row items-center justify-between pb-2">
                            <CardTitle class="text-xs font-semibold text-slate-500 uppercase tracking-wider">
                                Total FAQ
                            </CardTitle>
                            <HelpCircle class="h-4 w-4 text-orange-500" />
                        </CardHeader>
                        <CardContent>
                            <div class="text-2xl font-black text-slate-900">
                                {{ stats.total_faqs }}
                            </div>
                            <p class="text-xs text-slate-500 mt-1">Tanya jawab umum</p>
                        </CardContent>
                    </Card>

                    <Card class="border-slate-200 bg-orange-50/50 border-orange-200">
                        <CardHeader class="flex flex-row items-center justify-between pb-2">
                            <CardTitle class="text-xs font-semibold text-orange-700 uppercase tracking-wider">
                                Kontak WhatsApp
                            </CardTitle>
                            <MessageCircle class="h-4 w-4 text-[#25D366]" />
                        </CardHeader>
                        <CardContent>
                            <div class="text-xl font-bold text-slate-900 truncate">
                                +{{ stats.whatsapp_number }}
                            </div>
                            <Link
                                :href="route('admin.settings.index')"
                                class="text-xs font-semibold text-orange-600 hover:underline mt-1 inline-block"
                            >
                                Ubah nomor &rarr;
                            </Link>
                        </CardContent>
                    </Card>
                </div>

                <!-- 2-Columns Grid -->
                <div class="grid gap-8 lg:grid-cols-12">
                    <!-- Left: Services Management Quick List -->
                    <div class="lg:col-span-7">
                        <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
                            <div class="flex items-center justify-between border-b border-slate-100 pb-4 mb-5">
                                <div>
                                    <h3 class="text-base font-bold text-slate-900">Layanan Ditawarkan</h3>
                                    <p class="text-xs text-slate-500">Edit harga, fitur, atau pesan WhatsApp per layanan</p>
                                </div>
                                <Link
                                    :href="route('admin.services.index')"
                                    class="text-xs font-semibold text-orange-600 hover:underline"
                                >
                                    Kelola Semua
                                </Link>
                            </div>

                            <div class="divide-y divide-slate-100">
                                <div
                                    v-for="service in services"
                                    :key="service.id"
                                    class="py-3.5 flex items-center justify-between gap-4"
                                >
                                    <div>
                                        <h4 class="text-sm font-bold text-slate-900">{{ service.name }}</h4>
                                        <p class="text-xs text-slate-500">Mulai: <span class="font-semibold text-orange-600">{{ service.starting_price }}</span></p>
                                    </div>
                                    <div class="flex items-center gap-2">
                                        <Badge :variant="service.is_active ? 'greenSoft' : 'secondary'">
                                            {{ service.is_active ? 'Aktif' : 'Nonaktif' }}
                                        </Badge>
                                        <Link
                                            :href="route('admin.services.edit', service.id)"
                                            class="inline-flex items-center justify-center h-8 w-8 rounded-lg bg-slate-100 text-slate-600 hover:bg-orange-50 hover:text-orange-600 transition"
                                        >
                                            <Edit3 class="h-3.5 w-3.5" />
                                        </Link>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Right: Quick Links & Actions -->
                    <div class="lg:col-span-5 space-y-6">
                        <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
                            <h3 class="text-base font-bold text-slate-900 border-b border-slate-100 pb-3 mb-4">
                                Navigasi Cepat Pengelolaan
                            </h3>
                            <div class="space-y-3">
                                <Link
                                    :href="route('admin.settings.index')"
                                    class="group flex items-center justify-between p-3.5 rounded-xl border border-slate-100 bg-slate-50 hover:bg-orange-50 hover:border-orange-200 transition"
                                >
                                    <div class="flex items-center gap-3">
                                        <div class="flex h-9 w-9 items-center justify-center rounded-lg bg-white border border-slate-200 text-orange-500 group-hover:border-orange-300">
                                            <Settings class="h-4 w-4" />
                                        </div>
                                        <div>
                                            <h4 class="text-sm font-bold text-slate-900">Pengaturan Landing Page</h4>
                                            <p class="text-xs text-slate-500">WhatsApp, Headline, Kontak, & Sosmed</p>
                                        </div>
                                    </div>
                                    <ArrowRight class="h-4 w-4 text-slate-400 group-hover:text-orange-500" />
                                </Link>

                                <Link
                                    :href="route('admin.portfolios.index')"
                                    class="group flex items-center justify-between p-3.5 rounded-xl border border-slate-100 bg-slate-50 hover:bg-orange-50 hover:border-orange-200 transition"
                                >
                                    <div class="flex items-center gap-3">
                                        <div class="flex h-9 w-9 items-center justify-center rounded-lg bg-white border border-slate-200 text-orange-500 group-hover:border-orange-300">
                                            <FolderKanban class="h-4 w-4" />
                                        </div>
                                        <div>
                                            <h4 class="text-sm font-bold text-slate-900">Kelola Portofolio</h4>
                                            <p class="text-xs text-slate-500">Tambah dan perbarui karya showcase</p>
                                        </div>
                                    </div>
                                    <ArrowRight class="h-4 w-4 text-slate-400 group-hover:text-orange-500" />
                                </Link>

                                <Link
                                    :href="route('admin.faqs.index')"
                                    class="group flex items-center justify-between p-3.5 rounded-xl border border-slate-100 bg-slate-50 hover:bg-orange-50 hover:border-orange-200 transition"
                                >
                                    <div class="flex items-center gap-3">
                                        <div class="flex h-9 w-9 items-center justify-center rounded-lg bg-white border border-slate-200 text-orange-500 group-hover:border-orange-300">
                                            <HelpCircle class="h-4 w-4" />
                                        </div>
                                        <div>
                                            <h4 class="text-sm font-bold text-slate-900">Kelola Tanya Jawab (FAQ)</h4>
                                            <p class="text-xs text-slate-500">Pertanyaan umum pengunjung</p>
                                        </div>
                                    </div>
                                    <ArrowRight class="h-4 w-4 text-slate-400 group-hover:text-orange-500" />
                                </Link>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
