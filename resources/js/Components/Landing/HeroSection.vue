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

const heroBadge = props.settings.hero_badge || '✨ Solusi Digital Kreatif & Terjangkau';
const heroTitle = props.settings.hero_title || 'Wujudkan Ide Digital Anda Bersama Virtarastudio';
const heroSubtitle = props.settings.hero_subtitle || 'Jasa pembuatan website murah, aplikasi Android, game interaktif, hingga teknologi masa depan Augmented Reality (AR) & Virtual Reality (VR) dengan konsultasi gratis.';
</script>

<template>
    <section class="relative overflow-hidden bg-white pt-12 pb-20 md:pt-20 md:pb-32">
        <!-- Ambient Decorative Gradient -->
        <div
            class="pointer-events-none absolute -top-40 left-1/2 -z-10 h-[550px] w-[900px] -translate-x-1/2 rounded-full bg-gradient-to-tr from-orange-200/40 via-amber-100/30 to-transparent blur-3xl"
        />

        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="grid items-center gap-12 lg:grid-cols-12 lg:gap-8">
                <!-- Left Column: Copy & CTAs -->
                <div class="flex flex-col items-center text-center lg:col-span-7 lg:items-start lg:text-left">
                    <!-- Pill Badge -->
                    <div
                        class="mb-6 inline-flex items-center gap-2 rounded-full border border-orange-200/80 bg-orange-50/80 px-4 py-1.5 text-xs font-semibold text-orange-700 shadow-sm transition-all hover:bg-orange-100/80"
                    >
                        <Sparkles class="h-3.5 w-3.5 text-orange-500" />
                        <span>{{ heroBadge }}</span>
                    </div>

                    <!-- Main Headline -->
                    <h1 class="text-4xl font-extrabold tracking-tight text-slate-900 sm:text-5xl lg:text-6xl leading-[1.12]">
                        Bangun Solusi Digital Impian Bersama
                        <span class="text-transparent bg-clip-text bg-gradient-to-r from-orange-500 via-orange-600 to-amber-500">
                            Virtarastudio
                        </span>
                    </h1>

                    <!-- Subtitle -->
                    <p class="mt-6 max-w-2xl text-lg text-slate-600 sm:text-xl leading-relaxed">
                        {{ heroSubtitle }}
                    </p>

                    <!-- CTAs -->
                    <div class="mt-8 flex flex-col sm:flex-row items-center gap-4 w-full sm:w-auto">
                        <Button
                            as="a"
                            :href="whatsappUrl"
                            target="_blank"
                            rel="noopener noreferrer"
                            size="lg"
                            variant="default"
                            class="w-full sm:w-auto gap-2.5 font-bold shadow-lg shadow-orange-500/25 hover:shadow-xl hover:shadow-orange-500/30"
                        >
                            <MessageCircle class="h-5 w-5" />
                            Konsultasi Gratis via WhatsApp
                        </Button>

                        <Button
                            as="a"
                            href="#services"
                            size="lg"
                            variant="outline"
                            class="w-full sm:w-auto gap-2 font-semibold text-slate-700 hover:text-orange-600"
                        >
                            Lihat 5 Layanan Kami
                            <ArrowRight class="h-4 w-4" />
                        </Button>
                    </div>

                    <!-- Value Highlights Checklist -->
                    <div class="mt-10 grid grid-cols-2 sm:grid-cols-3 gap-3.5 pt-4 text-xs sm:text-sm font-medium text-slate-600 border-t border-slate-100 w-full">
                        <div class="flex items-center gap-2">
                            <CheckCircle2 class="h-4 w-4 text-orange-500 shrink-0" />
                            <span>100% Konsultasi Gratis</span>
                        </div>
                        <div class="flex items-center gap-2">
                            <CheckCircle2 class="h-4 w-4 text-orange-500 shrink-0" />
                            <span>Pengerjaan Cepat & Rapi</span>
                        </div>
                        <div class="flex items-center gap-2">
                            <CheckCircle2 class="h-4 w-4 text-orange-500 shrink-0" />
                            <span>Garansi Bebas Bug</span>
                        </div>
                    </div>
                </div>

                <!-- Right Column: Interactive Tech Card Mockup -->
                <div class="lg:col-span-5">
                    <div class="relative mx-auto max-w-md lg:max-w-none">
                        <!-- Glow behind card -->
                        <div
                            class="absolute -inset-1 rounded-3xl bg-gradient-to-r from-orange-400/20 to-amber-300/20 blur-xl opacity-70"
                        />

                        <!-- Main Showcase Card -->
                        <div
                            class="relative rounded-3xl border border-slate-200/90 bg-white/95 p-6 sm:p-8 shadow-2xl backdrop-blur-sm"
                        >
                            <div class="flex items-center justify-between border-b border-slate-100 pb-4">
                                <div class="flex items-center gap-3">
                                    <div class="h-3 w-3 rounded-full bg-red-400"></div>
                                    <div class="h-3 w-3 rounded-full bg-amber-400"></div>
                                    <div class="h-3 w-3 rounded-full bg-green-400"></div>
                                    <span class="text-xs font-semibold text-slate-400">Virtara Tech Hub</span>
                                </div>
                                <Badge variant="orangeSoft" class="text-[11px]">5 Lini Layanan</Badge>
                            </div>

                            <!-- Showcase Grid Items -->
                            <div class="mt-6 space-y-3.5">
                                <!-- Service 1 -->
                                <div
                                    class="group flex items-center justify-between rounded-xl border border-slate-100 bg-slate-50/70 p-3.5 transition-all hover:border-orange-200 hover:bg-orange-50/40"
                                >
                                    <div class="flex items-center gap-3">
                                        <div class="flex h-10 w-10 items-center justify-center rounded-lg bg-orange-100 text-orange-600">
                                            <Globe class="h-5 w-5" />
                                        </div>
                                        <div>
                                            <h4 class="text-sm font-bold text-slate-900">Website Murah</h4>
                                            <p class="text-xs text-slate-500">Landing Page, Toko Online & Web App</p>
                                        </div>
                                    </div>
                                    <span class="text-xs font-bold text-orange-600">Mulai 499rb</span>
                                </div>

                                <!-- Service 2 -->
                                <div
                                    class="group flex items-center justify-between rounded-xl border border-slate-100 bg-slate-50/70 p-3.5 transition-all hover:border-orange-200 hover:bg-orange-50/40"
                                >
                                    <div class="flex items-center gap-3">
                                        <div class="flex h-10 w-10 items-center justify-center rounded-lg bg-orange-100 text-orange-600">
                                            <Smartphone class="h-5 w-5" />
                                        </div>
                                        <div>
                                            <h4 class="text-sm font-bold text-slate-900">App Android</h4>
                                            <p class="text-xs text-slate-500">Aplikasi Bisnis, Kasir & Startup</p>
                                        </div>
                                    </div>
                                    <span class="text-xs font-bold text-orange-600">Mulai 1.4Jt</span>
                                </div>

                                <!-- Service 3 -->
                                <div
                                    class="group flex items-center justify-between rounded-xl border border-slate-100 bg-slate-50/70 p-3.5 transition-all hover:border-orange-200 hover:bg-orange-50/40"
                                >
                                    <div class="flex items-center gap-3">
                                        <div class="flex h-10 w-10 items-center justify-center rounded-lg bg-orange-100 text-orange-600">
                                            <Gamepad2 class="h-5 w-5" />
                                        </div>
                                        <div>
                                            <h4 class="text-sm font-bold text-slate-900">Game Android</h4>
                                            <p class="text-xs text-slate-500">Game Edukasi & Promosi 2D/3D</p>
                                        </div>
                                    </div>
                                    <span class="text-xs font-bold text-orange-600">Mulai 1.9Jt</span>
                                </div>

                                <!-- Service 4 & 5 (Immersive AR & VR) -->
                                <div
                                    class="group flex items-center justify-between rounded-xl border border-orange-200 bg-gradient-to-r from-orange-50/70 to-amber-50/40 p-3.5 transition-all shadow-sm"
                                >
                                    <div class="flex items-center gap-3">
                                        <div class="flex h-10 w-10 items-center justify-center rounded-lg bg-orange-500 text-white">
                                            <Scan class="h-5 w-5" />
                                        </div>
                                        <div>
                                            <h4 class="text-sm font-bold text-slate-900">App AR & VR</h4>
                                            <p class="text-xs text-slate-600">3D Product Viewer & 360° Virtual Tour</p>
                                        </div>
                                    </div>
                                    <Badge variant="default" class="bg-orange-500 text-white text-[10px]">Populer</Badge>
                                </div>
                            </div>

                            <!-- Bottom Guarantee Note -->
                            <div class="mt-6 flex items-center justify-center gap-2 rounded-xl bg-slate-50 py-2.5 px-3 text-center text-xs font-medium text-slate-600">
                                <ShieldCheck class="h-4 w-4 text-orange-500" />
                                <span>Pengerjaan Resmi, Transparan & Bergaransi</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>
