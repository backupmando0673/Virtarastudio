<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link, router } from '@inertiajs/vue3';
import { Card, CardHeader, CardTitle, CardContent } from '@/Components/ui/card';
import { Badge } from '@/Components/ui/badge';
import { Button } from '@/Components/ui/button';
import {
    Globe,
    Smartphone,
    Gamepad2,
    Scan,
    Glasses,
    Layers,
    Edit3,
    Trash2,
    Plus,
    CheckCircle2,
    Briefcase,
} from '@lucide/vue';

const props = defineProps({
    services: {
        type: Array,
        default: () => [],
    },
});

const getIcon = (iconName) => {
    switch (iconName) {
        case 'Smartphone':
            return Smartphone;
        case 'Gamepad2':
            return Gamepad2;
        case 'Scan':
            return Scan;
        case 'Glasses':
            return Glasses;
        case 'Layers':
            return Layers;
        default:
            return Globe;
    }
};

const deleteService = (service) => {
    if (confirm(`Apakah Anda yakin ingin menghapus layanan "${service.name}"?`)) {
        router.delete(route('admin.services.destroy', service.id), {
            preserveScroll: true,
        });
    }
};
</script>

<template>
    <Head title="Kelola Layanan - Virtarastudio" />

    <AuthenticatedLayout>
        <template #header>
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                <div>
                    <h2 class="text-2xl font-bold text-slate-900 tracking-tight">
                        Kelola Layanan (Services)
                    </h2>
                    <p class="text-sm text-slate-500 mt-1">
                        Tambah, edit, atau hapus layanan yang ditawarkan beserta harga awal, poin fitur, dan template WhatsApp.
                    </p>
                </div>
                <Link :href="route('admin.services.create')">
                    <Button class="gap-2 bg-amber-500 hover:bg-amber-600 text-slate-950 font-bold shadow-sm">
                        <Plus class="h-4 w-4" />
                        Tambah Layanan Baru
                    </Button>
                </Link>
            </div>
        </template>

        <div class="py-8">
            <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 space-y-6">
                <!-- Success Flash Banner -->
                <div
                    v-if="$page.props.flash?.success"
                    class="flex items-center gap-3 rounded-2xl border border-green-200 bg-green-50 p-4 text-sm font-medium text-green-800 shadow-sm"
                >
                    <CheckCircle2 class="h-5 w-5 text-green-600 shrink-0" />
                    <span>{{ $page.props.flash.success }}</span>
                </div>

                <!-- Empty State -->
                <div
                    v-if="services.length === 0"
                    class="rounded-3xl border border-dashed border-slate-300 bg-white p-12 text-center shadow-sm"
                >
                    <div class="mx-auto flex h-14 w-14 items-center justify-center rounded-2xl bg-orange-100 text-orange-600 mb-4">
                        <Briefcase class="h-7 w-7" />
                    </div>
                    <h3 class="text-lg font-bold text-slate-900">Belum ada layanan</h3>
                    <p class="text-sm text-slate-500 max-w-md mx-auto mt-1 mb-6">
                        Silakan buat penawaran layanan pertama Anda untuk ditampilkan di landing page.
                    </p>
                    <Link :href="route('admin.services.create')">
                        <Button class="gap-2 bg-amber-500 hover:bg-amber-600 text-slate-950 font-bold">
                            <Plus class="h-4 w-4" />
                            Tambah Layanan Sekarang
                        </Button>
                    </Link>
                </div>

                <!-- Services Grid -->
                <div v-else class="grid gap-6 md:grid-cols-2 lg:grid-cols-3">
                    <Card
                        v-for="service in services"
                        :key="service.id"
                        class="flex flex-col justify-between border-slate-200 hover:border-amber-400 transition-all duration-200 shadow-sm bg-white"
                    >
                        <CardHeader>
                            <div class="flex items-center justify-between">
                                <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-orange-100 text-orange-600">
                                    <component :is="getIcon(service.icon_name)" class="h-6 w-6" />
                                </div>
                                <div class="flex items-center gap-2">
                                    <span class="text-[11px] font-semibold text-slate-400">Urutan #{{ service.sort_order }}</span>
                                    <span v-if="service.is_featured" class="rounded-md bg-amber-100 px-2 py-0.5 text-[10px] font-bold text-amber-800">
                                        Unggulan
                                    </span>
                                    <Badge :variant="service.is_active ? 'greenSoft' : 'secondary'">
                                        {{ service.is_active ? 'Aktif' : 'Nonaktif' }}
                                    </Badge>
                                </div>
                            </div>

                            <CardTitle class="mt-4 text-lg font-bold text-slate-900">
                                {{ service.name }}
                            </CardTitle>
                            <span v-if="service.tagline" class="text-xs font-semibold text-orange-600">
                                {{ service.tagline }}
                            </span>
                            <p class="text-xs text-slate-500 mt-2 line-clamp-3">
                                {{ service.description }}
                            </p>
                        </CardHeader>

                        <CardContent class="border-t border-slate-100 pt-4 flex items-center justify-between">
                            <div>
                                <span class="text-[11px] text-slate-400 block">Harga Mulai:</span>
                                <span class="text-sm font-black text-slate-900">{{ service.starting_price }}</span>
                            </div>

                            <div class="flex items-center gap-1.5">
                                <Button
                                    as="a"
                                    :href="route('admin.services.edit', service.id)"
                                    variant="outline"
                                    size="sm"
                                    class="gap-1.5 text-xs font-semibold text-slate-700 hover:text-blue-600 hover:border-blue-300"
                                >
                                    <Edit3 class="h-3.5 w-3.5" />
                                    Edit
                                </Button>
                                <Button
                                    type="button"
                                    variant="ghost"
                                    size="sm"
                                    @click="deleteService(service)"
                                    class="h-8 w-8 p-0 text-slate-400 hover:text-red-600 hover:bg-red-50"
                                    title="Hapus Layanan"
                                >
                                    <Trash2 class="h-4 w-4" />
                                </Button>
                            </div>
                        </CardContent>
                    </Card>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
