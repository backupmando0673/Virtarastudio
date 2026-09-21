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
                class="relative overflow-hidden rounded-3xl border border-slate-200 bg-gradient-to-br from-blue-700 via-indigo-700 to-amber-600 px-6 py-14 sm:px-12 sm:py-20 text-white shadow-2xl shadow-blue-500/15"
            >
                <!-- Decorative background circles -->
                <div
                    class="pointer-events-none absolute -top-24 -right-24 h-96 w-96 rounded-full bg-amber-400/20 blur-3xl"
                />
                <div
                    class="pointer-events-none absolute -bottom-24 -left-24 h-96 w-96 rounded-full bg-blue-500/20 blur-3xl"
                />

                <div class="relative mx-auto max-w-3xl text-center">
                    <div
                        class="inline-flex items-center gap-2 rounded-full bg-white/20 px-4 py-1.5 text-xs font-semibold text-white backdrop-blur-sm"
                    >
                        <Sparkles class="h-3.5 w-3.5 text-amber-300" />
                        <span>Mulai Langkah Digital Anda Bersama Kami</span>
                    </div>

                    <h2 class="mt-6 text-3xl font-extrabold tracking-tight sm:text-4xl lg:text-5xl leading-tight">
                        Siap Mewujudkan Website, App Android, Game, atau AR/VR Anda?
                    </h2>

                    <p class="mt-6 text-base sm:text-lg text-blue-100 leading-relaxed max-w-2xl mx-auto">
                        Kombinasikan ide kreatif Anda dengan keahlian teknis kami. Konsultasikan kebutuhan proyek Anda via WhatsApp—100% gratis tanpa komitmen apapun.
                    </p>

                    <div class="mt-8 flex flex-col sm:flex-row items-center justify-center gap-4">
                        <Button
                            as="a"
                            :href="whatsappUrl"
                            target="_blank"
                            rel="noopener noreferrer"
                            size="lg"
                            class="w-full sm:w-auto gap-2.5 bg-white text-slate-900 hover:bg-slate-50 font-bold shadow-xl shadow-black/10 text-base hover:scale-105 transition-all"
                        >
                            <MessageCircle class="h-5 w-5 text-[#25D366]" />
                            Hubungi via WhatsApp Sekarang
                        </Button>
                    </div>

                    <div class="mt-8 flex flex-wrap items-center justify-center gap-6 text-xs sm:text-sm font-medium text-blue-100">
                        <div class="flex items-center gap-2">
                            <CheckCircle2 class="h-4 w-4 text-amber-300" />
                            <span>Konsultasi 100% Bebas Biaya</span>
                        </div>
                        <div class="flex items-center gap-2">
                            <CheckCircle2 class="h-4 w-4 text-amber-300" />
                            <span>Estimasi Biaya Transparan</span>
                        </div>
                        <div class="flex items-center gap-2">
                            <CheckCircle2 class="h-4 w-4 text-amber-300" />
                            <span>Respons Cepat & Ramah</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>
