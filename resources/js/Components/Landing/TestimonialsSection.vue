<script setup>
import { Card, CardContent } from '@/Components/ui/card';
import { Badge } from '@/Components/ui/badge';
import { Star, Sparkles, Quote } from '@lucide/vue';

const props = defineProps({
    testimonials: {
        type: Array,
        default: () => [],
    },
});
</script>

<template>
    <section class="relative bg-slate-50/70 py-20 md:py-28 border-y border-slate-200/70">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="mx-auto max-w-3xl text-center">
                <div class="inline-flex items-center gap-2 rounded-full bg-orange-100/80 px-3.5 py-1 text-xs font-semibold text-orange-700">
                    <Sparkles class="h-3.5 w-3.5 text-orange-500" />
                    <span>Testimoni Klien</span>
                </div>
                <h2 class="mt-4 text-3xl font-extrabold tracking-tight text-slate-900 sm:text-4xl">
                    Apa Kata Klien yang Telah Bekerja Sama?
                </h2>
                <p class="mt-4 text-base text-slate-600 sm:text-lg leading-relaxed">
                    Kepuasan klien dan kesuksesan peluncuran produk digital adalah prioritas utama kami di setiap proyek.
                </p>
            </div>

            <div class="mt-14 grid gap-8 md:grid-cols-3">
                <Card
                    v-for="item in testimonials"
                    :key="item.id"
                    class="relative flex flex-col justify-between rounded-2xl border border-slate-200/90 bg-white p-6 sm:p-8 shadow-sm transition-all duration-300 hover:shadow-lg hover:border-orange-200"
                >
                    <CardContent class="p-0">
                        <!-- Rating Stars -->
                        <div class="flex items-center gap-1 text-amber-400">
                            <Star
                                v-for="s in (item.rating || 5)"
                                :key="s"
                                class="h-4 w-4 fill-amber-400 text-amber-400"
                            />
                        </div>

                        <!-- Content Quote -->
                        <p class="mt-4 text-sm text-slate-600 leading-relaxed italic">
                            "{{ item.content }}"
                        </p>
                    </CardContent>

                    <!-- Author Info -->
                    <div class="mt-6 flex items-center gap-3.5 pt-6 border-t border-slate-100">
                        <img
                            v-if="item.avatar_url"
                            :src="item.avatar_url"
                            :alt="item.client_name"
                            class="h-11 w-11 rounded-full object-cover border-2 border-orange-100"
                        />
                        <div
                            v-else
                            class="flex h-11 w-11 items-center justify-center rounded-full bg-orange-100 font-bold text-orange-600"
                        >
                            {{ item.client_name.charAt(0) }}
                        </div>
                        <div>
                            <h4 class="text-sm font-bold text-slate-900">
                                {{ item.client_name }}
                            </h4>
                            <p class="text-xs text-slate-500">
                                {{ item.client_role }} - {{ item.company }}
                            </p>
                        </div>
                    </div>
                </Card>
            </div>
        </div>
    </section>
</template>
