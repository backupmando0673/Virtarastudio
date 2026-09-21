<script setup>
import { ref, computed } from 'vue';
import { Card, CardContent } from '@/Components/ui/card';
import { Badge } from '@/Components/ui/badge';
import { Sparkles, ExternalLink, Palette, Cpu } from '@lucide/vue';

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
                    class="rounded-full px-5 py-2 text-xs sm:text-sm font-semibold transition-all duration-200"
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

            <!-- Portfolio Grid -->
            <div class="mt-12 grid gap-8 sm:grid-cols-2 lg:grid-cols-3">
                <div
                    v-for="project in filteredPortfolios"
                    :key="project.id"
                    class="group overflow-hidden rounded-2xl border border-slate-200/90 bg-white shadow-sm transition-all duration-300 hover:-translate-y-1.5 hover:border-slate-300 hover:shadow-xl"
                >
                    <!-- Image Wrapper -->
                    <div class="relative aspect-video w-full overflow-hidden bg-slate-100">
                        <img
                            :src="project.image_url"
                            :alt="project.title"
                            class="h-full w-full object-cover transition-transform duration-500 group-hover:scale-105"
                            loading="lazy"
                        />
                        <div class="absolute top-3 left-3">
                            <span
                                class="rounded-full border px-2.5 py-0.5 text-[10px] font-bold uppercase tracking-wider shadow-xs backdrop-blur-xs"
                                :class="getCategoryBadgeClass(project.category)"
                            >
                                {{ project.category }}
                            </span>
                        </div>
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
            </div>
        </div>
    </section>
</template>
