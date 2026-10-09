<script setup>
import { ref, computed } from 'vue';
import { Card, CardContent } from '@/Components/ui/card';
import { Badge } from '@/Components/ui/badge';
import { Sparkles, ExternalLink, Palette, Cpu, Globe, Smartphone, Gamepad2, Glasses, Layers, Image as ImageIcon } from '@lucide/vue';

const props = defineProps({
    portfolios: {
        type: Array,
        default: () => [],
    },
});

const activeCategory = ref('all');

const categories = [
    { label: 'Semua', value: 'all' },
    { label: 'Website (Seni & Web)', value: 'website' },
    { label: 'Android App (Teknologi)', value: 'android' },
    { label: 'Game Android (Seni)', value: 'game' },
    { label: 'AR 3D (Teknologi)', value: 'ar' },
    { label: 'VR 360° (Teknologi)', value: 'vr' },
];

const filteredPortfolios = computed(() => {
    if (activeCategory.value === 'all') {
        return props.portfolios;
    }
    return props.portfolios.filter((p) => p.category === activeCategory.value);
});

const getCategoryBadgeClass = (category) => {
    if (category === 'website' || category === 'game') {
        return 'bg-amber-50 text-amber-700 border-amber-200';
    }
    return 'bg-blue-50 text-blue-700 border-blue-200';
};
</script>

<template>
    <section id="portfolio" class="relative bg-white py-20 md:py-28">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="mx-auto max-w-3xl text-center">
                <div class="inline-flex items-center gap-2 rounded-full border border-slate-200 bg-white px-4 py-1 text-xs font-semibold text-slate-700 shadow-xs">
                    <span class="text-amber-500 font-bold">Karya Seni</span>
                    <span>&bull;</span>
                    <span class="text-blue-600 font-bold">Implementasi Teknologi</span>
                </div>
                <h2 class="mt-4 text-3xl font-extrabold tracking-tight text-slate-900 sm:text-4xl">
                    Portofolio & Hasil Pengerjaan Kami
                </h2>
                <p class="mt-4 text-base text-slate-600 sm:text-lg leading-relaxed">
                    Lihat hasil perpaduan desain visual dan rekayasa software yang telah kami selesaikan untuk berbagai klien.
                </p>
            </div>

            <!-- Filter Buttons -->
            <div class="mt-10 flex flex-wrap items-center justify-center gap-2">
                <button
                    v-for="cat in categories"
                    :key="cat.value"
                    type="button"
                    class="rounded-full px-5 py-2 text-xs sm:text-sm font-semibold transition-all duration-200 cursor-pointer"
                    :class="[
                        activeCategory === cat.value
                            ? 'bg-slate-900 text-white shadow-md'
                            : 'bg-slate-100 text-slate-600 hover:bg-slate-200/80',
                    ]"
                    @click="activeCategory = cat.value"
                >
                    {{ cat.label }}
                </button>
            </div>

            <!-- Empty State -->
            <div
                v-if="filteredPortfolios.length === 0"
                class="mt-16 flex flex-col items-center justify-center rounded-3xl border border-dashed border-slate-200 p-12 text-center"
            >
                <div class="h-12 w-12 rounded-2xl bg-slate-100 flex items-center justify-center text-slate-400 mb-3">
                    <Layers class="h-6 w-6" />
                </div>
                <h3 class="text-base font-bold text-slate-800">Belum ada portofolio di kategori ini</h3>
                <p class="text-xs text-slate-500 mt-1 max-w-sm">
                    Karya pada kategori ini sedang dalam tahap dokumentasi atau proses pengerjaan.
                </p>
            </div>

            <!-- Portfolio Grid -->
            <div v-else class="mt-12 grid gap-8 sm:grid-cols-2 lg:grid-cols-3">
                <div
                    v-for="project in filteredPortfolios"
                    :key="project.id"
                    class="group overflow-hidden rounded-2xl border border-slate-200/90 bg-white shadow-sm transition-all duration-300 hover:-translate-y-1.5 hover:border-slate-300 hover:shadow-xl flex flex-col justify-between"
                >
                    <div>
                        <!-- Image Wrapper -->
                        <div class="relative aspect-video w-full overflow-hidden bg-slate-100">
                            <img
                                v-if="project.image_url"
                                :src="project.image_url"
                                :alt="project.title"
                                class="h-full w-full object-cover transition-transform duration-500 group-hover:scale-105"
                                loading="lazy"
                            />
                            <div v-else class="h-full w-full flex flex-col items-center justify-center text-slate-400 bg-slate-50">
                                <ImageIcon class="h-8 w-8 text-slate-300 mb-1" />
                                <span class="text-xs font-medium text-slate-400">Virtarastudio Project</span>
                            </div>

                            <!-- Category Badge -->
                            <div class="absolute top-3 left-3">
                                <span
                                    class="rounded-full border px-2.5 py-0.5 text-[10px] font-bold uppercase tracking-wider shadow-xs backdrop-blur-xs"
                                    :class="getCategoryBadgeClass(project.category)"
                                >
                                    {{ project.category }}
                                </span>
                            </div>

                            <!-- Demo URL overlay icon -->
                            <a
                                v-if="project.demo_url"
                                :href="project.demo_url"
                                target="_blank"
                                rel="noopener noreferrer"
                                class="absolute bottom-3 right-3 flex h-8 w-8 items-center justify-center rounded-xl bg-white/90 text-slate-800 shadow-md backdrop-blur-sm transition-all hover:scale-110 hover:bg-white"
                                title="Lihat Demo Langsung"
                            >
                                <ExternalLink class="h-4 w-4" />
                            </a>
                        </div>

                        <!-- Content -->
                        <div class="p-6">
                            <span v-if="project.client_name" class="text-xs font-semibold text-slate-400">
                                Klien: {{ project.client_name }}
                            </span>
                            <h3 class="mt-1 text-lg font-bold text-slate-900 group-hover:text-blue-600 transition-colors">
                                {{ project.title }}
                            </h3>
                            <p class="mt-2 text-xs sm:text-sm text-slate-600 line-clamp-2 leading-relaxed">
                                {{ project.description }}
                            </p>

                            <!-- Tech tags -->
                            <div v-if="project.technologies?.length" class="mt-4 flex flex-wrap gap-1.5">
                                <span
                                    v-for="(tech, i) in project.technologies"
                                    :key="i"
                                    class="rounded-md bg-slate-100 px-2 py-0.5 text-[11px] font-medium text-slate-600"
                                >
                                    {{ tech }}
                                </span>
                            </div>
                        </div>
                    </div>

                    <!-- Footer Link if Demo exists -->
                    <div v-if="project.demo_url" class="border-t border-slate-100 px-6 py-3 bg-slate-50/50 flex items-center justify-between">
                        <span class="text-xs text-slate-500 font-medium">Live Project</span>
                        <a
                            :href="project.demo_url"
                            target="_blank"
                            rel="noopener noreferrer"
                            class="inline-flex items-center gap-1.5 text-xs font-bold text-blue-600 hover:text-blue-700 transition-colors"
                        >
                            <span>Buka Projek</span>
                            <ExternalLink class="h-3 w-3" />
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>
