<script setup>
import { Card, CardHeader, CardTitle, CardDescription, CardContent, CardFooter } from '@/Components/ui/card';
import { Button } from '@/Components/ui/button';
import { Badge } from '@/Components/ui/badge';
import {
    Globe,
    Smartphone,
    Gamepad2,
    Scan,
    Glasses,
    Check,
    MessageCircle,
    Sparkles,
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
    <section id="services" class="relative bg-slate-50/70 py-20 md:py-28 border-y border-slate-200/70">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <!-- Section Header -->
            <div class="mx-auto max-w-3xl text-center">
                <div class="inline-flex items-center gap-2 rounded-full bg-orange-100/80 px-3.5 py-1 text-xs font-semibold text-orange-700">
                    <Sparkles class="h-3.5 w-3.5 text-orange-500" />
                    <span>Layanan Kami</span>
                </div>
                <h2 class="mt-4 text-3xl font-extrabold tracking-tight text-slate-900 sm:text-4xl">
                    Solusi Lengkap untuk Kebutuhan Digital Anda
                </h2>
                <p class="mt-4 text-base text-slate-600 sm:text-lg leading-relaxed">
                    Mulai dari pembuatan website murah, aplikasi Android, game interaktif, hingga teknologi imersif AR & VR. Semua dapat dikonsultasikan secara gratis!
                </p>
            </div>

            <!-- Services Grid -->
            <div class="mt-14 grid gap-8 md:grid-cols-2 lg:grid-cols-3">
                <Card
                    v-for="service in services"
                    :key="service.id"
                    class="group relative flex flex-col justify-between overflow-hidden rounded-2xl bg-white border border-slate-200/90 shadow-sm transition-all duration-300 hover:-translate-y-1.5 hover:border-orange-300 hover:shadow-xl hover:shadow-orange-500/10"
                    :class="{
                        'ring-2 ring-orange-500/80 border-orange-300': service.slug === 'website-murah' || service.slug === 'app-ar',
                    }"
                >
                    <!-- Highlight Badge if featured -->
                    <div
                        v-if="service.slug === 'website-murah'"
                        class="absolute top-0 right-0 rounded-bl-xl bg-orange-500 px-3 py-1 text-[11px] font-bold text-white uppercase tracking-wider"
                    >
                        Paling Hemat
                    </div>
                    <div
                        v-else-if="service.slug === 'app-ar'"
                        class="absolute top-0 right-0 rounded-bl-xl bg-gradient-to-r from-orange-500 to-amber-500 px-3 py-1 text-[11px] font-bold text-white uppercase tracking-wider"
                    >
                        Trending Tech
                    </div>

                    <CardHeader class="p-6 sm:p-8 pb-4">
                        <!-- Icon Box -->
                        <div
                            class="flex h-14 w-14 items-center justify-center rounded-2xl bg-orange-100/80 text-orange-600 transition-colors duration-300 group-hover:bg-orange-500 group-hover:text-white shadow-sm"
                        >
                            <component :is="getIcon(service.icon_name)" class="h-7 w-7" />
                        </div>

                        <CardTitle class="mt-5 text-xl font-bold text-slate-900 group-hover:text-orange-600 transition-colors">
                            {{ service.name }}
                        </CardTitle>
                        <span class="text-xs font-semibold text-orange-600">
                            {{ service.tagline }}
                        </span>
                        <CardDescription class="mt-2 text-sm text-slate-600 leading-relaxed">
                            {{ service.description }}
                        </CardDescription>
                    </CardHeader>

                    <CardContent class="p-6 sm:p-8 pt-0 flex-1">
                        <!-- Price Badge -->
                        <div class="my-4 rounded-xl bg-slate-50 p-3.5 border border-slate-100 flex items-center justify-between">
                            <span class="text-xs font-medium text-slate-500">Estimasi Biaya:</span>
                            <span class="text-base font-extrabold text-slate-900">
                                Mulai <span class="text-orange-600">{{ service.starting_price }}</span>
                            </span>
                        </div>

                        <!-- Features Checklist -->
                        <ul class="mt-4 space-y-2.5">
                            <li
                                v-for="(feat, idx) in service.features"
                                :key="idx"
                                class="flex items-start gap-2.5 text-xs sm:text-sm text-slate-600"
                            >
                                <div class="mt-0.5 flex h-4 w-4 shrink-0 items-center justify-center rounded-full bg-orange-100 text-orange-600">
                                    <Check class="h-2.5 w-2.5 stroke-[3]" />
                                </div>
                                <span>{{ feat }}</span>
                            </li>
                        </ul>
                    </CardContent>

                    <CardFooter class="p-6 sm:p-8 pt-0">
                        <Button
                            as="a"
                            :href="service.whatsapp_url"
                            target="_blank"
                            rel="noopener noreferrer"
                            variant="default"
                            class="w-full gap-2 font-bold shadow-md shadow-orange-500/20"
                        >
                            <MessageCircle class="h-4 w-4" />
                            Konsultasi Layanan Ini
                        </Button>
                    </CardFooter>
                </Card>
            </div>
        </div>
    </section>
</template>
