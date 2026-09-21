<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link } from '@inertiajs/vue3';
import { Card, CardHeader, CardTitle, CardContent } from '@/Components/ui/card';
import { Badge } from '@/Components/ui/badge';
import { Button } from '@/Components/ui/button';
import {
    Globe,
    Smartphone,
    Gamepad2,
    Scan,
    Glasses,
    Edit3,
    CheckCircle2,
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
        default:
            return Globe;
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
                        5 Layanan Utama
                    </h2>
                    <p class="text-sm text-slate-500 mt-1">
                        Sesuaikan harga awal, deskripsi, poin fitur, dan template pesan WhatsApp per layanan.
                    </p>
                </div>
            </div>
        </template>

        <div class="py-8">
            <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 space-y-6">
                <!-- Success Banner -->
                <div
                    v-if="$page.props.flash?.success"
                    class="flex items-center gap-3 rounded-2xl border border-green-200 bg-green-50 p-4 text-sm font-medium text-green-800 shadow-sm"
                >
                    <CheckCircle2 class="h-5 w-5 text-green-600 shrink-0" />
                    <span>{{ $page.props.flash.success }}</span>
                </div>

                <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-3">
                    <Card
                        v-for="service in services"
                        :key="service.id"
                        class="flex flex-col justify-between border-slate-200 hover:border-orange-300 transition-all duration-200 shadow-sm"
                    >
                        <CardHeader>
                            <div class="flex items-center justify-between">
                                <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-orange-100 text-orange-600">
                                    <component :is="getIcon(service.icon_name)" class="h-6 w-6" />
                                </div>
                                <Badge :variant="service.is_active ? 'greenSoft' : 'secondary'">
                                    {{ service.is_active ? 'Aktif' : 'Nonaktif' }}
                                </Badge>
                            </div>

                            <CardTitle class="mt-4 text-lg font-bold text-slate-900">
                                {{ service.name }}
                            </CardTitle>
                            <span class="text-xs font-semibold text-orange-600">
                                {{ service.tagline }}
                            </span>
                            <p class="text-xs text-slate-500 mt-2 line-clamp-2">
                                {{ service.description }}
                            </p>
                        </CardHeader>

                        <CardContent class="border-t border-slate-100 pt-4 flex items-center justify-between">
                            <div>
                                <span class="text-[11px] text-slate-400 block">Harga Mulai Dari:</span>
                                <span class="text-sm font-black text-slate-900">{{ service.starting_price }}</span>
                            </div>

                            <Button
                                as="a"
                                :href="route('admin.services.edit', service.id)"
                                variant="outline"
                                size="sm"
                                class="gap-1.5 text-xs font-semibold text-slate-700 hover:text-orange-600"
                            >
                                <Edit3 class="h-3.5 w-3.5" />
                                Edit Layanan
                            </Button>
                        </CardContent>
                    </Card>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
