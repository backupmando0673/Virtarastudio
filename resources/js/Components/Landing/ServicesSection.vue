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
    Palette,
    Cpu,
} from '@lucide/vue';

const props = defineProps({
    services: {
        type: Array,
        default: () => [],
    },
});

const getServiceMeta = (slug) => {
    switch (slug) {
        case 'website-murah':
            return {
                icon: Globe,
                pillar: 'SENI & DESAIN',
                pillarType: 'art',
                iconBg: 'bg-amber-500 text-white',
                borderHover: 'hover:border-amber-400',
                badgeBg: 'bg-amber-50 text-amber-700 border-amber-200',
                btnClass: 'bg-amber-500 hover:bg-amber-600 text-white shadow-amber-500/20',
                highlightBadge: 'Paling Hemat',
            };
        case 'app-android':
            return {
                icon: Smartphone,
                pillar: 'TEKNOLOGI',
                pillarType: 'tech',
                iconBg: 'bg-blue-600 text-white',
                borderHover: 'hover:border-blue-400',
                badgeBg: 'bg-blue-50 text-blue-700 border-blue-200',
                btnClass: 'bg-blue-600 hover:bg-blue-700 text-white shadow-blue-500/20',
                highlightBadge: null,
            };
        case 'game-android':
            return {
                icon: Gamepad2,
                pillar: 'SENI & GAMEPLAY',
                pillarType: 'art',
                iconBg: 'bg-amber-500 text-white',
                borderHover: 'hover:border-amber-400',
                badgeBg: 'bg-amber-50 text-amber-700 border-amber-200',
                btnClass: 'bg-amber-500 hover:bg-amber-600 text-white shadow-amber-500/20',
                highlightBadge: null,
            };
        case 'app-ar':
            return {
                icon: Scan,
                pillar: 'TEKNOLOGI 3D',
                pillarType: 'tech',
                iconBg: 'bg-blue-600 text-white',
                borderHover: 'hover:border-blue-400',
                badgeBg: 'bg-blue-50 text-blue-700 border-blue-200',
                btnClass: 'bg-blue-600 hover:bg-blue-700 text-white shadow-blue-500/20',
                highlightBadge: 'Trending AR',
            };
        case 'app-vr':
            return {
                icon: Glasses,
                pillar: 'TEKNOLOGI IMERSIF',
                pillarType: 'tech',
                iconBg: 'bg-indigo-600 text-white',
                borderHover: 'hover:border-indigo-400',
                badgeBg: 'bg-indigo-50 text-indigo-700 border-indigo-200',
                btnClass: 'bg-indigo-600 hover:bg-indigo-700 text-white shadow-indigo-500/20',
                highlightBadge: 'Futuristik',
            };
        default:
            return {
                icon: Globe,
                pillar: 'DIGITAL',
                pillarType: 'art',
                iconBg: 'bg-amber-500 text-white',
                borderHover: 'hover:border-amber-400',
                badgeBg: 'bg-slate-50 text-slate-700 border-slate-200',
                btnClass: 'bg-amber-500 hover:bg-amber-600 text-white',
                highlightBadge: null,
            };
    }
};
</script>

<template>
    <section id="services" class="relative bg-slate-50/70 py-20 md:py-28 border-y border-slate-200/70">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <!-- Section Header -->
            <div class="mx-auto max-w-3xl text-center">
                <div class="inline-flex items-center gap-2 rounded-full border border-slate-200 bg-white px-4 py-1 text-xs font-semibold text-slate-700 shadow-xs">
                    <span class="text-amber-500 font-bold">Seni Visual</span>
                    <span>&bull;</span>
                    <span class="text-blue-600 font-bold">Teknologi Modern</span>
                </div>
                <h2 class="mt-4 text-3xl font-extrabold tracking-tight text-slate-900 sm:text-4xl">
                    5 Layanan Unggulan Virtarastudio
                </h2>
                <p class="mt-4 text-base text-slate-600 sm:text-lg leading-relaxed">
                    Setiap produk menggabungkan estetika desain visual kreatif dengan kestabilan teknologi rekayasa software.
                </p>
            </div>

            <!-- Services Grid -->
            <div class="mt-14 grid gap-8 md:grid-cols-2 lg:grid-cols-3">
                <Card
                    v-for="service in services"
                    :key="service.id"
                    class="group relative flex flex-col justify-between overflow-hidden rounded-2xl bg-white border border-slate-200/90 shadow-sm transition-all duration-300 hover:-translate-y-1.5 hover:shadow-xl"
                    :class="getServiceMeta(service.slug).borderHover"
                >
                    <!-- Highlight Badge -->
                    <div
                        v-if="getServiceMeta(service.slug).highlightBadge"
                        class="absolute top-0 right-0 rounded-bl-xl px-3 py-1 text-[11px] font-bold text-white uppercase tracking-wider shadow-xs"
                        :class="getServiceMeta(service.slug).pillarType === 'art' ? 'bg-amber-500' : 'bg-blue-600'"
                    >
                        {{ getServiceMeta(service.slug).highlightBadge }}
                    </div>

                    <CardHeader class="p-6 sm:p-8 pb-4">
                        <div class="flex items-center justify-between">
                            <!-- Icon Box -->
                            <div
                                class="flex h-14 w-14 items-center justify-center rounded-2xl shadow-sm transition-transform duration-300 group-hover:scale-105"
                                :class="getServiceMeta(service.slug).iconBg"
                            >
                                <component :is="getServiceMeta(service.slug).icon" class="h-7 w-7" />
                            </div>

                            <!-- Pillar Tag (Seni vs Teknologi) -->
                            <span
                                class="rounded-full border px-2.5 py-0.5 text-[10px] font-bold tracking-wider"
                                :class="getServiceMeta(service.slug).badgeBg"
                            >
                                {{ getServiceMeta(service.slug).pillar }}
                            </span>
                        </div>

                        <CardTitle class="mt-5 text-xl font-bold text-slate-900 group-hover:text-blue-600 transition-colors">
                            {{ service.name }}
                        </CardTitle>
                        <span class="text-xs font-semibold text-amber-600">
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
                                Mulai <span class="text-amber-600">{{ service.starting_price }}</span>
                            </span>
                        </div>

                        <!-- Features Checklist -->
                        <ul class="mt-4 space-y-2.5">
                            <li
                                v-for="(feat, idx) in service.features"
                                :key="idx"
                                class="flex items-start gap-2.5 text-xs sm:text-sm text-slate-600"
                            >
                                <div
                                    class="mt-0.5 flex h-4 w-4 shrink-0 items-center justify-center rounded-full"
                                    :class="getServiceMeta(service.slug).pillarType === 'art' ? 'bg-amber-100 text-amber-600' : 'bg-blue-100 text-blue-600'"
                                >
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
                            class="w-full gap-2 font-bold shadow-md border-0 transition-all hover:-translate-y-0.5"
                            :class="getServiceMeta(service.slug).btnClass"
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
