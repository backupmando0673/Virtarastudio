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

const props = defineProps({
    settings: {
        type: Object,
        default: () => ({}),
    },
    whatsappUrl: {
        type: String,
        default: '#',
    },
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
                                <!-- Service 1: Seni Desain Web (Solid) -->
                                <div
                                    class="group flex items-center justify-between rounded-xl border border-amber-200 bg-amber-50/50 p-3.5 transition-all hover:border-amber-400"
                                >
                                    <div class="flex items-center gap-3">
                                        <div class="flex h-10 w-10 items-center justify-center rounded-lg bg-amber-500 text-white shadow-xs">
                                            <Globe class="h-5 w-5" />
                                        </div>
                                        <div>
                                            <div class="flex items-center gap-1.5">
                                                <h4 class="text-sm font-bold text-slate-900">Website Murah</h4>
                                                <span class="rounded bg-amber-100 px-1.5 py-0.2 text-[9px] font-bold text-amber-700">SENI</span>
                                            </div>
                                            <p class="text-xs text-slate-500">Landing Page & Toko Online Estetik</p>
                                        </div>
                                    </div>
                                    <span class="text-xs font-bold text-amber-600">Mulai 499rb</span>
                                </div>

                                <!-- Service 2: Teknologi Mobile Android (Solid) -->
                                <div
                                    class="group flex items-center justify-between rounded-xl border border-blue-200 bg-blue-50/50 p-3.5 transition-all hover:border-blue-400"
                                >
                                    <div class="flex items-center gap-3">
                                        <div class="flex h-10 w-10 items-center justify-center rounded-lg bg-blue-600 text-white shadow-xs">
                                            <Smartphone class="h-5 w-5" />
                                        </div>
                                        <div>
                                            <div class="flex items-center gap-1.5">
                                                <h4 class="text-sm font-bold text-slate-900">App Android</h4>
                                                <span class="rounded bg-blue-100 px-1.5 py-0.2 text-[9px] font-bold text-blue-700">TEKNO</span>
                                            </div>
                                            <p class="text-xs text-slate-500">Aplikasi Bisnis, Kasir & Backend</p>
                                        </div>
                                    </div>
                                    <span class="text-xs font-bold text-blue-600">Mulai 1.4Jt</span>
                                </div>

                                <!-- Service 3: Seni Game & Gameplay (Solid) -->
                                <div
                                    class="group flex items-center justify-between rounded-xl border border-slate-200 bg-slate-50 p-3.5 transition-all hover:border-amber-300 hover:bg-amber-50/40"
                                >
                                    <div class="flex items-center gap-3">
                                        <div class="flex h-10 w-10 items-center justify-center rounded-lg bg-amber-500 text-white shadow-xs">
                                            <Gamepad2 class="h-5 w-5" />
                                        </div>
                                        <div>
                                            <div class="flex items-center gap-1.5">
                                                <h4 class="text-sm font-bold text-slate-900">Game Android</h4>
                                                <span class="rounded bg-amber-100 px-1.5 py-0.2 text-[9px] font-bold text-amber-700">SENI</span>
                                            </div>
                                            <p class="text-xs text-slate-500">Visual 2D/3D & Edukasi Seru</p>
                                        </div>
                                    </div>
                                    <span class="text-xs font-bold text-amber-600">Mulai 1.9Jt</span>
                                </div>

                                <!-- Service 4 & 5: AR & VR Immersive Tech (Solid) -->
                                <div
                                    class="group flex items-center justify-between rounded-xl border-2 border-blue-400 bg-blue-50/40 p-3.5 transition-all shadow-xs"
                                >
                                    <div class="flex items-center gap-3">
                                        <div class="flex h-10 w-10 items-center justify-center rounded-lg bg-blue-600 text-white shadow-xs">
                                            <Scan class="h-5 w-5" />
                                        </div>
                                        <div>
                                            <div class="flex items-center gap-1.5">
                                                <h4 class="text-sm font-bold text-slate-900">App AR & VR</h4>
                                                <span class="rounded bg-blue-100 px-1.5 py-0.2 text-[9px] font-bold text-blue-700">FUTURISTIK</span>
                                            </div>
                                            <p class="text-xs text-slate-600">3D Product Viewer & 360° Virtual Tour</p>
                                        </div>
                                    </div>
                                    <Badge class="bg-blue-600 text-white text-[10px]">Populer</Badge>
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
