<script setup>
import { ref, computed } from 'vue';
import { Head, Link } from '@inertiajs/vue3';
import { Button } from '@/Components/ui/button';
import { Badge } from '@/Components/ui/badge';
import { Card, CardContent } from '@/Components/ui/card';
import {
    ArrowLeft,
    ExternalLink,
    MessageCircle,
    ChevronLeft,
    ChevronRight,
    Sparkles,
    Maximize2,
    X,
    Layers,
    Tag,
    Building,
    CheckCircle2,
    Image as ImageIcon,
} from '@lucide/vue';
import Footer from '@/Components/Landing/Footer.vue';

const props = defineProps({
    portfolio: {
        type: Object,
        required: true,
    },
    relatedPortfolios: {
        type: Array,
        default: () => [],
    },
    settings: {
        type: Object,
        default: () => ({}),
    },
    whatsappUrl: {
        type: String,
        default: '#',
    },
});

// Prepare all gallery images including image_url
const allImages = computed(() => {
    const list = Array.isArray(props.portfolio.gallery_images) && props.portfolio.gallery_images.length > 0
        ? [...props.portfolio.gallery_images]
        : props.portfolio.image_url
        ? [props.portfolio.image_url]
        : [];

    if (props.portfolio.image_url && !list.includes(props.portfolio.image_url)) {
        list.unshift(props.portfolio.image_url);
    }
    return list;
});

const activeImageIndex = ref(0);
const activeImage = computed(() => {
    if (allImages.value.length === 0) return null;
    return allImages.value[activeImageIndex.value] || allImages.value[0];
});

// Lightbox state
const isLightboxOpen = ref(false);

const openLightbox = (index = 0) => {
    activeImageIndex.value = index;
    isLightboxOpen.value = true;
};

const closeLightbox = () => {
    isLightboxOpen.value = false;
};

const nextImage = () => {
    if (allImages.value.length > 1) {
        activeImageIndex.value = (activeImageIndex.value + 1) % allImages.value.length;
    }
};

const prevImage = () => {
    if (allImages.value.length > 1) {
        activeImageIndex.value = (activeImageIndex.value - 1 + allImages.value.length) % allImages.value.length;
    }
};

const getCategoryBadgeClass = (category, pillar = null) => {
    if (pillar === 'art' || category === 'website' || category === 'game') {
        return 'bg-amber-50 text-amber-700 border-amber-200';
    }
    return 'bg-blue-50 text-blue-700 border-blue-200';
};

const getCategoryLabel = (category) => {
    if (props.portfolio.service_category?.name) {
        return props.portfolio.service_category.name;
    }
    const map = {
        website: 'Website & Digital Design',
        android: 'Android Mobile Application',
        game: 'Android Game Development',
        ar: 'Augmented Reality (AR 3D)',
        vr: 'Virtual Reality (VR 360°)',
    };
    return map[category] || category;
};
</script>

<template>
    <Head>
        <title>{{ portfolio.title }} - Portofolio {{ settings.site_name || 'Virtarastudio' }}</title>
        <meta
            name="description"
            :content="portfolio.description ? portfolio.description.substring(0, 160) : 'Detail portofolio proyek dari Virtarastudio.'"
        />
        <link
            v-if="settings.site_favicon || $page.props.site_settings?.site_favicon"
            rel="icon"
            :href="settings.site_favicon || $page.props.site_settings.site_favicon"
        />
    </Head>

    <div class="min-h-screen bg-slate-50/50 text-slate-900 selection:bg-blue-600 selection:text-white font-sans antialiased">
        <!-- Minimal Top Navbar -->
        <header class="sticky top-0 z-40 w-full border-b border-slate-200 bg-white/95 backdrop-blur-md shadow-2xs">
            <div class="mx-auto flex h-16 max-w-7xl items-center justify-between px-4 sm:px-6 lg:px-8">
                <!-- Brand / Back Link -->
                <Link
                    href="/"
                    class="group inline-flex items-center gap-2 text-sm font-semibold text-slate-600 hover:text-slate-900 transition"
                >
                    <div class="flex h-8 w-8 items-center justify-center rounded-lg border border-slate-200 bg-slate-50 group-hover:bg-slate-100 transition">
                        <ArrowLeft class="h-4 w-4 text-slate-600 group-hover:-translate-x-0.5 transition-transform" />
                    </div>
                    <span class="hidden sm:inline">Kembali ke Beranda</span>
                </Link>

                <!-- Site Logo -->
                <Link href="/" class="flex items-center gap-2">
                    <template v-if="settings.site_logo || $page.props.site_settings?.site_logo">
                        <img
                            :src="settings.site_logo || $page.props.site_settings.site_logo"
                            :alt="settings.site_name || 'Virtarastudio'"
                            class="h-8 w-auto max-w-[160px] object-contain"
                        />
                    </template>
                    <template v-else>
                        <div class="flex items-center text-lg font-extrabold tracking-tight">
                            <span class="text-slate-900">{{ settings.site_name ? settings.site_name.substring(0, Math.ceil(settings.site_name.length / 2)) : 'Virtara' }}</span>
                            <span class="text-amber-500">{{ settings.site_name ? settings.site_name.substring(Math.ceil(settings.site_name.length / 2)) : 'studio' }}</span>
                        </div>
                    </template>
                </Link>

                <!-- WhatsApp Action -->
                <a
                    :href="whatsappUrl"
                    target="_blank"
                    rel="noopener noreferrer"
                    class="inline-flex items-center gap-2 rounded-xl bg-emerald-600 px-4 py-2 text-xs sm:text-sm font-bold text-white shadow-xs hover:bg-emerald-700 transition"
                >
                    <MessageCircle class="h-4 w-4" />
                    <span class="hidden sm:inline">Konsultasi Proyek</span>
                    <span class="sm:hidden">WhatsApp</span>
                </a>
            </div>
        </header>

        <main class="py-8 sm:py-12">
            <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 space-y-8">
                <!-- Breadcrumb & Header Info -->
                <div class="space-y-3">
                    <div class="flex items-center gap-2 text-xs font-semibold text-slate-500">
                        <Link href="/" class="hover:text-blue-600 transition">Beranda</Link>
                        <span>/</span>
                        <Link href="/#portfolio" class="hover:text-blue-600 transition">Portofolio</Link>
                        <span>/</span>
                        <span class="text-slate-800 line-clamp-1 max-w-xs">{{ portfolio.title }}</span>
                    </div>

                    <div class="flex flex-wrap items-center gap-3 pt-1">
                        <span
                            class="rounded-full border px-3 py-1 text-xs font-bold uppercase tracking-wider shadow-2xs"
                            :class="getCategoryBadgeClass(portfolio.category)"
                        >
                            {{ getCategoryLabel(portfolio.category) }}
                        </span>
                        <span v-if="portfolio.client_name" class="inline-flex items-center gap-1.5 text-xs font-semibold text-slate-600 bg-white border border-slate-200 rounded-full px-3 py-1">
                            <Building class="h-3.5 w-3.5 text-slate-400" />
                            Klien: {{ portfolio.client_name }}
                        </span>
                    </div>

                    <h1 class="text-2xl sm:text-4xl font-extrabold tracking-tight text-slate-900 leading-tight">
                        {{ portfolio.title }}
                    </h1>
                </div>

                <!-- Main Gallery Showcase -->
                <div class="space-y-4">
                    <!-- Main Active Large Image -->
                    <div class="group relative aspect-video sm:aspect-21/9 w-full rounded-3xl border border-slate-200 bg-slate-900 overflow-hidden shadow-md">
                        <template v-if="activeImage">
                            <img
                                :src="activeImage"
                                :alt="portfolio.title"
                                class="h-full w-full object-cover sm:object-contain bg-slate-950/40 transition-all duration-300"
                            />
                            <!-- Zoom in button -->
                            <button
                                type="button"
                                @click="openLightbox(activeImageIndex)"
                                class="absolute top-4 right-4 z-10 flex h-10 w-10 items-center justify-center rounded-2xl bg-white/90 text-slate-800 shadow-md backdrop-blur-sm opacity-0 group-hover:opacity-100 transition-all hover:scale-110 hover:bg-white cursor-pointer"
                                title="Perbesar Gambar"
                            >
                                <Maximize2 class="h-5 w-5" />
                            </button>

                            <!-- Prev/Next Overlay Buttons if multi-image -->
                            <template v-if="allImages.length > 1">
                                <button
                                    type="button"
                                    @click="prevImage"
                                    class="absolute left-4 top-1/2 -translate-y-1/2 flex h-10 w-10 items-center justify-center rounded-full bg-white/80 text-slate-800 shadow-md backdrop-blur-sm opacity-0 group-hover:opacity-100 transition-all hover:bg-white hover:scale-110 cursor-pointer"
                                >
                                    <ChevronLeft class="h-6 w-6" />
                                </button>
                                <button
                                    type="button"
                                    @click="nextImage"
                                    class="absolute right-4 top-1/2 -translate-y-1/2 flex h-10 w-10 items-center justify-center rounded-full bg-white/80 text-slate-800 shadow-md backdrop-blur-sm opacity-0 group-hover:opacity-100 transition-all hover:bg-white hover:scale-110 cursor-pointer"
                                >
                                    <ChevronRight class="h-6 w-6" />
                                </button>

                                <div class="absolute bottom-4 left-4 z-10 rounded-lg bg-slate-900/80 px-3 py-1 text-xs font-semibold text-white backdrop-blur-xs">
                                    {{ activeImageIndex + 1 }} / {{ allImages.length }}
                                </div>
                            </template>
                        </template>

                        <div v-else class="h-full w-full flex flex-col items-center justify-center text-slate-400 bg-slate-100">
                            <ImageIcon class="h-12 w-12 text-slate-300 mb-2" />
                            <span class="text-sm font-medium">Gambar showcase sedang dipersiapkan</span>
                        </div>
                    </div>

                    <!-- Thumbnails Strip -->
                    <div v-if="allImages.length > 1" class="flex items-center gap-3 overflow-x-auto pb-2 pt-1 scrollbar-thin">
                        <button
                            v-for="(img, idx) in allImages"
                            :key="idx"
                            type="button"
                            @click="activeImageIndex = idx"
                            class="relative aspect-video h-16 sm:h-20 shrink-0 rounded-xl overflow-hidden border-2 transition-all duration-200 cursor-pointer bg-slate-100"
                            :class="[
                                activeImageIndex === idx
                                    ? 'border-blue-600 ring-2 ring-blue-600/30 scale-102'
                                    : 'border-slate-200 opacity-70 hover:opacity-100 hover:border-slate-400',
                            ]"
                        >
                            <img :src="img" :alt="`Thumbnail ${idx + 1}`" class="h-full w-full object-cover" />
                        </button>
                    </div>
                </div>

                <!-- Two Column Details Section -->
                <div class="grid gap-8 lg:grid-cols-12 items-start pt-4">
                    <!-- Left: Description & Tech -->
                    <div class="lg:col-span-8 space-y-8">
                        <!-- About Section -->
                        <div class="rounded-3xl border border-slate-200 bg-white p-6 sm:p-8 shadow-xs space-y-4">
                            <h2 class="text-xl font-bold text-slate-900 tracking-tight flex items-center gap-2">
                                <span>Deskripsi & Gambaran Proyek</span>
                            </h2>
                            <div class="text-slate-600 leading-relaxed text-sm sm:text-base whitespace-pre-line">
                                {{ portfolio.description }}
                            </div>
                        </div>

                        <!-- Technologies Used -->
                        <div v-if="portfolio.technologies?.length" class="rounded-3xl border border-slate-200 bg-white p-6 sm:p-8 shadow-xs space-y-4">
                            <h3 class="text-base font-bold text-slate-900 tracking-tight flex items-center gap-2">
                                <Tag class="h-4 w-4 text-blue-600" />
                                <span>Teknologi & Tools yang Digunakan</span>
                            </h3>
                            <div class="flex flex-wrap gap-2 pt-1">
                                <span
                                    v-for="(tech, i) in portfolio.technologies"
                                    :key="i"
                                    class="inline-flex items-center gap-1.5 rounded-xl border border-slate-200 bg-slate-50 px-3.5 py-1.5 text-xs sm:text-sm font-semibold text-slate-800 shadow-2xs"
                                >
                                    <CheckCircle2 class="h-3.5 w-3.5 text-emerald-600" />
                                    {{ tech }}
                                </span>
                            </div>
                        </div>
                    </div>

                    <!-- Right: Sticky Project Metadata & CTA -->
                    <div class="lg:col-span-4 space-y-6 lg:sticky lg:top-24">
                        <!-- Metadata Card -->
                        <Card class="border-slate-200 shadow-xs">
                            <CardContent class="p-6 space-y-4">
                                <h3 class="text-sm font-bold text-slate-900 uppercase tracking-wider">
                                    Informasi Proyek
                                </h3>

                                <div class="divide-y divide-slate-100 text-xs sm:text-sm">
                                    <div class="py-2.5 flex justify-between gap-4">
                                        <span class="text-slate-500">Kategori</span>
                                        <span class="font-bold text-slate-900 capitalize">{{ portfolio.service_category?.name || portfolio.category }}</span>
                                    </div>

                                    <div v-if="portfolio.client_name" class="py-2.5 flex justify-between gap-4">
                                        <span class="text-slate-500">Klien / Brand</span>
                                        <span class="font-bold text-slate-900 text-right">{{ portfolio.client_name }}</span>
                                    </div>

                                    <div v-if="portfolio.service?.name" class="py-2.5 flex justify-between gap-4">
                                        <span class="text-slate-500">Layanan</span>
                                        <span class="font-bold text-slate-900 text-right">{{ portfolio.service.name }}</span>
                                    </div>

                                    <div class="py-2.5 flex justify-between gap-4">
                                        <span class="text-slate-500">Studio Pengembang</span>
                                        <span class="font-bold text-slate-900">{{ settings.site_name || 'Virtarastudio' }}</span>
                                    </div>
                                </div>

                                <!-- Live Demo Button if demo_url exists -->
                                <div v-if="portfolio.demo_url" class="pt-2">
                                    <a
                                        :href="portfolio.demo_url"
                                        target="_blank"
                                        rel="noopener noreferrer"
                                        class="flex w-full items-center justify-center gap-2 rounded-xl border border-slate-300 bg-white py-2.5 text-xs sm:text-sm font-bold text-slate-800 shadow-2xs hover:bg-slate-50 hover:border-slate-400 transition"
                                    >
                                        <span>Buka Demo / Live Preview</span>
                                        <ExternalLink class="h-4 w-4 text-slate-500" />
                                    </a>
                                </div>
                            </CardContent>
                        </Card>

                        <!-- WhatsApp Action Box -->
                        <div class="rounded-3xl border border-emerald-200 bg-emerald-50/80 p-6 space-y-4 shadow-xs">
                            <div class="flex items-center gap-2.5">
                                <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-emerald-600 text-white shadow-xs">
                                    <Sparkles class="h-5 w-5" />
                                </div>
                                <div>
                                    <h4 class="text-sm font-bold text-emerald-950">Tertarik Proyek Serupa?</h4>
                                    <p class="text-xs text-emerald-700 mt-0.5">Konsultasi gratis langsung via WhatsApp.</p>
                                </div>
                            </div>

                            <p class="text-xs text-emerald-800 leading-relaxed">
                                Tim Virtarastudio siap merancang dan mewujudkan solusi digital kustom dengan standar mutu tinggi dan harga terjangkau.
                            </p>

                            <a
                                :href="whatsappUrl"
                                target="_blank"
                                rel="noopener noreferrer"
                                class="flex w-full items-center justify-center gap-2 rounded-xl bg-emerald-600 py-3 text-sm font-bold text-white shadow-sm hover:bg-emerald-700 transition"
                            >
                                <MessageCircle class="h-4 w-4" />
                                <span>Tanya Estimasi Biaya</span>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Related Portfolios Section -->
                <div v-if="relatedPortfolios.length > 0" class="pt-12 border-t border-slate-200 space-y-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <h3 class="text-xl font-bold text-slate-900 tracking-tight">Karya Terkait Lainnya</h3>
                            <p class="text-xs sm:text-sm text-slate-500 mt-0.5">
                                Eksplorasi hasil pengerjaan tim kami lainnya di kategori yang serupa.
                            </p>
                        </div>
                        <Link
                            href="/#portfolio"
                            class="text-xs sm:text-sm font-bold text-blue-600 hover:text-blue-700 transition"
                        >
                            Lihat Semua &rarr;
                        </Link>
                    </div>

                    <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
                        <Link
                            v-for="rel in relatedPortfolios"
                            :key="rel.id"
                            :href="route('portfolio.show', rel.slug)"
                            class="group overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-2xs hover:shadow-lg hover:-translate-y-1 hover:border-slate-300 transition-all duration-300 flex flex-col justify-between"
                        >
                            <div>
                                <div class="relative aspect-video w-full overflow-hidden bg-slate-100">
                                    <img
                                        v-if="rel.image_url"
                                        :src="rel.image_url"
                                        :alt="rel.title"
                                        class="h-full w-full object-cover transition-transform duration-500 group-hover:scale-105"
                                    />
                                    <div v-else class="h-full w-full flex items-center justify-center text-slate-400 text-xs">
                                        No Image
                                    </div>
                                    <div class="absolute top-3 left-3">
                                        <span
                                            class="rounded-full border px-2.5 py-0.5 text-[10px] font-bold uppercase tracking-wider shadow-xs"
                                            :class="getCategoryBadgeClass(rel.category, rel.service_category?.pillar)"
                                        >
                                            {{ rel.service_category?.name || rel.category }}
                                        </span>
                                    </div>
                                </div>

                                <div class="p-5">
                                    <span v-if="rel.client_name" class="text-[11px] font-semibold text-slate-400 block">
                                        {{ rel.client_name }}
                                    </span>
                                    <h4 class="mt-1 text-base font-bold text-slate-900 group-hover:text-blue-600 transition-colors">
                                        {{ rel.title }}
                                    </h4>
                                    <p class="mt-1.5 text-xs text-slate-500 line-clamp-2">
                                        {{ rel.description }}
                                    </p>
                                </div>
                            </div>

                            <div class="border-t border-slate-100 px-5 py-3 bg-slate-50/60 flex items-center justify-between text-xs font-bold text-blue-600 group-hover:text-blue-700">
                                <span>Lihat Detail</span>
                                <span>&rarr;</span>
                            </div>
                        </Link>
                    </div>
                </div>
            </div>
        </main>

        <!-- Lightbox Modal -->
        <div
            v-if="isLightboxOpen"
            class="fixed inset-0 z-50 flex items-center justify-center bg-black/95 p-4 backdrop-blur-md transition-all"
            @click.self="closeLightbox"
        >
            <button
                type="button"
                @click="closeLightbox"
                class="absolute top-5 right-5 flex h-10 w-10 items-center justify-center rounded-full bg-white/20 text-white hover:bg-white/30 transition cursor-pointer"
            >
                <X class="h-6 w-6" />
            </button>

            <template v-if="allImages.length > 1">
                <button
                    type="button"
                    @click="prevImage"
                    class="absolute left-5 top-1/2 -translate-y-1/2 flex h-12 w-12 items-center justify-center rounded-full bg-white/20 text-white hover:bg-white/30 transition cursor-pointer"
                >
                    <ChevronLeft class="h-7 w-7" />
                </button>
                <button
                    type="button"
                    @click="nextImage"
                    class="absolute right-5 top-1/2 -translate-y-1/2 flex h-12 w-12 items-center justify-center rounded-full bg-white/20 text-white hover:bg-white/30 transition cursor-pointer"
                >
                    <ChevronRight class="h-7 w-7" />
                </button>
            </template>

            <div class="max-h-[85vh] max-w-5xl overflow-hidden rounded-2xl">
                <img
                    :src="activeImage"
                    :alt="portfolio.title"
                    class="max-h-[85vh] max-w-full object-contain"
                />
            </div>
        </div>

        <!-- Footer -->
        <Footer
            :settings="settings"
            :whatsapp-url="whatsappUrl"
        />
    </div>
</template>
