<script setup>
import { Button } from '@/Components/ui/button';
import { Badge } from '@/Components/ui/badge';
import {
    MessageCircle,
    ArrowRight,
    CheckCircle2,
    Globe,
    Smartphone,
    Gamepad2,
    Scan,
    Glasses,
    ShieldCheck,
    Sparkles,
    Palette,
    Cpu,
} from '@lucide/vue';

import { computed } from 'vue';

const icons = {
    MessageCircle, ArrowRight, CheckCircle2, Globe, Smartphone, Gamepad2, Scan, Glasses, ShieldCheck, Sparkles, Palette, Cpu
};

const props = defineProps({
    settings: {
        type: Object,
        default: () => ({}),
    },
    whatsappUrl: {
        type: String,
        default: '#',
    },
    services: {
        type: Array,
        default: () => [],
    },
});

const getIcon = (name) => {
    return icons[name] || CheckCircle2;
};

const showcaseItems = computed(() => {
    const items = props.settings.hero_showcase_items || [];
    if (items.length > 0 && props.services && props.services.length > 0) {
        return items.map(item => {
            const service = props.services.find(s => s.id == item.service_id);
            return {
                ...item,
                title: item.title || service?.name || 'Layanan',
                subtitle: item.subtitle || service?.tagline || '',
                price: service?.starting_price || '',
                icon_name: service?.icon_name || 'CheckCircle2'
            };
        });
    }
    // Fallback if not configured
    return [
       { title: 'Website Murah', badge_text: 'SENI', subtitle: 'Landing Page & Toko Online Estetik', price: 'Mulai 499rb', theme: 'amber', icon_name: 'Globe' },
       { title: 'App Android', badge_text: 'TEKNO', subtitle: 'Aplikasi Bisnis, Kasir & Backend', price: 'Mulai 1.4Jt', theme: 'blue', icon_name: 'Smartphone' },
       { title: 'Game Android', badge_text: 'SENI', subtitle: 'Visual 2D/3D & Edukasi Seru', price: 'Mulai 1.9Jt', theme: 'amber', icon_name: 'Gamepad2' },
       { title: 'App AR & VR', badge_text: 'FUTURISTIK', subtitle: '3D Product Viewer & 360° Virtual Tour', price: 'Populer', theme: 'blue', icon_name: 'Scan' },
    ];
});

const heroBadge = props.settings.hero_badge || '✨ Harmoni Seni Desain & Rekayasa Teknologi';
const heroTitle = props.settings.hero_title || 'Harmoni Karya Seni & Kecanggihan';
const heroTitleHighlight = props.settings.hero_title_highlight !== undefined ? props.settings.hero_title_highlight : 'Teknologi Digital';
const heroSubtitle = props.settings.hero_subtitle || 'Jasa pembuatan website murah, aplikasi Android, game interaktif, serta teknologi masa depan Augmented Reality (AR) & Virtual Reality (VR) dengan konsultasi gratis.';
</script>

<template>
    <section class="relative bg-white pt-12 pb-20 md:pt-20 md:pb-32">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="grid items-center gap-12 lg:grid-cols-12 lg:gap-8">
                <!-- Left Column: Copy & CTAs -->
                <div class="flex flex-col items-center text-center lg:col-span-7 lg:items-start lg:text-left">
                    <!-- Dual Pillar Pill Badge (Solid) -->
                    <div
                        class="mb-6 inline-flex items-center gap-2.5 rounded-full border border-slate-200 bg-slate-50 px-4 py-1.5 text-xs font-semibold text-slate-700 shadow-2xs"
                    >
                        <span class="flex items-center gap-1 text-amber-600 font-bold">
                            <Palette class="h-3.5 w-3.5 text-amber-500" />
                            Seni
                        </span>
                        <span class="text-slate-300">&bull;</span>
                        <span class="flex items-center gap-1 text-blue-600 font-bold">
                            <Cpu class="h-3.5 w-3.5 text-blue-600" />
                            Teknologi
                        </span>
                        <span class="text-slate-300">|</span>
                        <span class="text-slate-600">{{ heroBadge }}</span>
                    </div>

                    <!-- Main Headline (Dynamic Solid Colors) -->
                    <h1 class="text-4xl font-extrabold tracking-tight text-slate-900 sm:text-5xl lg:text-6xl leading-[1.12]">
                        {{ heroTitle }}
                        <span v-if="heroTitleHighlight" class="text-blue-600 block sm:inline ml-0 sm:ml-2">
                            {{ heroTitleHighlight }}
                        </span>
                    </h1>

                    <!-- Subtitle -->
                    <p class="mt-6 max-w-2xl text-lg text-slate-600 sm:text-xl leading-relaxed">
                        {{ heroSubtitle }}
                    </p>

                    <!-- CTAs (Solid Colors) -->
                    <div class="mt-8 flex flex-col sm:flex-row items-center gap-4 w-full sm:w-auto">
                        <Button
                            as="a"
                            :href="whatsappUrl"
                            target="_blank"
                            rel="noopener noreferrer"
                            size="lg"
                            class="w-full sm:w-auto gap-2.5 font-bold bg-amber-500 hover:bg-amber-600 text-white shadow-md shadow-amber-500/20 border-0 hover:-translate-y-0.5 transition-all"
                        >
                            <MessageCircle class="h-5 w-5" />
                            Konsultasi Gratis via WhatsApp
                        </Button>

                        <Button
                            as="a"
                            href="#services"
                            size="lg"
                            variant="outline"
                            class="w-full sm:w-auto gap-2 font-semibold border-blue-200 bg-blue-50 text-blue-700 hover:bg-blue-100 hover:border-blue-300 transition-all"
                        >
                            Lihat Layanan Kami
                            <ArrowRight class="h-4 w-4" />
                        </Button>
                    </div>

                    <!-- Value Highlights Checklist -->
                    <div class="mt-10 grid grid-cols-2 sm:grid-cols-3 gap-3.5 pt-4 text-xs sm:text-sm font-medium text-slate-600 border-t border-slate-100 w-full">
                        <div class="flex items-center gap-2">
                            <CheckCircle2 class="h-4 w-4 text-amber-500 shrink-0" />
                            <span>100% Bebas Konsultasi</span>
                        </div>
                        <div class="flex items-center gap-2">
                            <CheckCircle2 class="h-4 w-4 text-blue-600 shrink-0" />
                            <span>Teknologi Andal & Cepat</span>
                        </div>
                        <div class="flex items-center gap-2">
                            <CheckCircle2 class="h-4 w-4 text-emerald-500 shrink-0" />
                            <span>Garansi Bebas Bug</span>
                        </div>
                    </div>
                </div>

                <!-- Right Column: Interactive Tech Card Mockup (Solid Clean) -->
                <div class="lg:col-span-5">
                    <div class="relative mx-auto max-w-md lg:max-w-none">
                        <!-- Main Showcase Card -->
                        <div
                            class="relative rounded-3xl border border-slate-200 bg-white p-6 sm:p-8 shadow-xl"
                        >
                            <div class="flex items-center justify-between border-b border-slate-100 pb-4">
                                <div class="flex items-center gap-2.5">
                                    <span class="flex h-3 w-3 rounded-full bg-amber-400" title="Seni"></span>
                                    <span class="flex h-3 w-3 rounded-full bg-blue-600" title="Teknologi"></span>
                                    <span class="text-xs font-bold text-slate-600 ml-1">Virtara Studio Ecosystem</span>
                                </div>
                                <span class="rounded-full bg-slate-100 px-2.5 py-0.5 text-[10px] font-bold text-slate-600 uppercase">
                                    Layanan Unggulan
                                </span>
                            </div>

                            <!-- Showcase Grid Items -->
                            <div class="mt-6 space-y-3.5">
                                <div
                                    v-for="(item, index) in showcaseItems"
                                    :key="index"
                                    class="group flex items-center justify-between rounded-xl p-3.5 transition-all shadow-xs"
                                    :class="
                                        item.theme === 'amber'
                                            ? 'border border-amber-200 bg-amber-50/50 hover:border-amber-400'
                                            : 'border border-blue-200 bg-blue-50/50 hover:border-blue-400'
                                    "
                                >
                                    <div class="flex items-center gap-3">
                                        <div
                                            class="flex h-10 w-10 items-center justify-center rounded-lg text-white shadow-xs"
                                            :class="item.theme === 'amber' ? 'bg-amber-500' : 'bg-blue-600'"
                                        >
                                            <component :is="getIcon(item.icon_name)" class="h-5 w-5" />
                                        </div>
                                        <div>
                                            <div class="flex items-center gap-1.5">
                                                <h4 class="text-sm font-bold text-slate-900">{{ item.title }}</h4>
                                                <span
                                                    class="rounded px-1.5 py-0.2 text-[9px] font-bold"
                                                    :class="item.theme === 'amber' ? 'bg-amber-100 text-amber-700' : 'bg-blue-100 text-blue-700'"
                                                >
                                                    {{ item.badge_text }}
                                                </span>
                                            </div>
                                            <p class="text-xs" :class="item.theme === 'amber' ? 'text-slate-500' : 'text-slate-600'">{{ item.subtitle }}</p>
                                        </div>
                                    </div>
                                    <span v-if="item.price" class="text-xs font-bold" :class="item.theme === 'amber' ? 'text-amber-600' : 'text-blue-600'">
                                        {{ item.price }}
                                    </span>
                                </div>
                            </div>

                            <!-- Bottom Guarantee Note -->
                            <div class="mt-6 flex items-center justify-center gap-2 rounded-xl bg-slate-50 py-2.5 px-3 text-center text-xs font-medium text-slate-600">
                                <ShieldCheck class="h-4 w-4 text-emerald-500" />
                                <span>Kombinasi Estetika Visual & Kode Perangkat Lunak Mutakhir</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>
