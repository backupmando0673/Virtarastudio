<script setup>
import { ref, computed } from 'vue';
import { Card, CardContent } from '@/Components/ui/card';
import { Badge } from '@/Components/ui/badge';
import { Sparkles, ExternalLink } from '@lucide/vue';

const props = defineProps({
    portfolios: {
        type: Array,
        default: () => [],
    },
});

const activeCategory = ref('all');

const categories = [
    { label: 'Semua', value: 'all' },
    { label: 'Website', value: 'website' },
    { label: 'Android App', value: 'android' },
    { label: 'Game Android', value: 'game' },
    { label: 'AR (Augmented Reality)', value: 'ar' },
    { label: 'VR (Virtual Reality)', value: 'vr' },
];

const filteredPortfolios = computed(() => {
    if (activeCategory.value === 'all') {
        return props.portfolios;
    }
    return props.portfolios.filter((p) => p.category === activeCategory.value);
});
</script>

<template>
    <section id="portfolio" class="relative bg-white py-20 md:py-28">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="mx-auto max-w-3xl text-center">
                <div class="inline-flex items-center gap-2 rounded-full bg-orange-100/80 px-3.5 py-1 text-xs font-semibold text-orange-700">
                    <Sparkles class="h-3.5 w-3.5 text-orange-500" />
                    <span>Showcase Karya</span>
                </div>
                <h2 class="mt-4 text-3xl font-extrabold tracking-tight text-slate-900 sm:text-4xl">
                    Portofolio & Hasil Pengerjaan Kami
                </h2>
                <p class="mt-4 text-base text-slate-600 sm:text-lg leading-relaxed">
                    Beberapa karya dan solusi digital yang telah kami kembangkan untuk berbagai klien dan kebutuhan industri.
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
                            ? 'bg-orange-500 text-white shadow-md shadow-orange-500/25'
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
                    class="group overflow-hidden rounded-2xl border border-slate-200/90 bg-white shadow-sm transition-all duration-300 hover:-translate-y-1.5 hover:border-orange-300 hover:shadow-xl"
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
                            <Badge variant="orangeSoft" class="capitalize font-bold text-[11px] shadow-sm">
                                {{ project.category }}
                            </Badge>
                        </div>
                    </div>

                    <!-- Content -->
                    <div class="p-6">
                        <span v-if="project.client_name" class="text-xs font-semibold text-slate-400">
                            Klien: {{ project.client_name }}
                        </span>
                        <h3 class="mt-1 text-lg font-bold text-slate-900 group-hover:text-orange-600 transition-colors">
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
