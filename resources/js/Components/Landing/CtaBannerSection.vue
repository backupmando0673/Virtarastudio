<script setup>
import { Button } from '@/Components/ui/button';
import { MessageCircle, Sparkles, CheckCircle2 } from '@lucide/vue';

const props = defineProps({
    whatsappUrl: {
        type: String,
        default: '#',
    },
});
</script>

<template>
    <section class="relative bg-white py-16 md:py-24">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div
                class="relative overflow-hidden rounded-3xl border border-slate-800 bg-slate-900 px-6 py-14 sm:px-12 sm:py-20 text-white shadow-xl"
            >
                <div class="relative mx-auto max-w-3xl text-center">
                    <div
                        class="inline-flex items-center gap-2 rounded-full border border-slate-700 bg-slate-800 px-4 py-1.5 text-xs font-semibold text-slate-200"
                    >
                        <Sparkles class="h-3.5 w-3.5 text-amber-400" />
                        <span>Mulai Langkah Digital Anda Bersama Kami</span>
                    </div>

                    <h2 class="mt-6 text-3xl font-extrabold tracking-tight sm:text-4xl lg:text-5xl leading-tight">
                        Siap Mewujudkan Website, App Android, Game, atau AR/VR Anda?
                    </h2>

                    <p class="mt-6 text-base sm:text-lg text-slate-300 leading-relaxed max-w-2xl mx-auto">
                        Kombinasikan ide kreatif Anda dengan keahlian teknis kami. Konsultasikan kebutuhan proyek Anda via WhatsApp—100% gratis tanpa komitmen apapun.
                    </p>

                    <div class="mt-8 flex flex-col sm:flex-row items-center justify-center gap-4">
                        <Button
                            as="a"
                            :href="whatsappUrl"
                            target="_blank"
                            rel="noopener noreferrer"
                            size="lg"
                            class="w-full sm:w-auto gap-2.5 bg-amber-500 hover:bg-amber-600 text-white font-bold shadow-md border-0 text-base transition-all hover:-translate-y-0.5"
                        >
                            <MessageCircle class="h-5 w-5" />
                            Hubungi via WhatsApp Sekarang
                        </Button>
                    </div>

                    <div class="mt-8 flex flex-wrap items-center justify-center gap-6 text-xs sm:text-sm font-medium text-slate-300">
                        <div class="flex items-center gap-2">
                            <CheckCircle2 class="h-4 w-4 text-amber-400" />
                            <span>Konsultasi 100% Bebas Biaya</span>
                        </div>
                        <div class="flex items-center gap-2">
                            <CheckCircle2 class="h-4 w-4 text-blue-400" />
                            <span>Estimasi Biaya Transparan</span>
                        </div>
                        <div class="flex items-center gap-2">
                            <CheckCircle2 class="h-4 w-4 text-emerald-400" />
                            <span>Respons Cepat & Ramah</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>
