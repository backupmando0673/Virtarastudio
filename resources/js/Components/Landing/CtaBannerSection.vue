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
                class="relative overflow-hidden rounded-3xl border border-orange-200 bg-gradient-to-br from-orange-500 via-orange-600 to-amber-600 px-6 py-14 sm:px-12 sm:py-20 text-white shadow-2xl shadow-orange-500/20"
            >
                <!-- Decorative background circles -->
                <div
                    class="pointer-events-none absolute -top-24 -right-24 h-96 w-96 rounded-full bg-white/10 blur-2xl"
                />
                <div
                    class="pointer-events-none absolute -bottom-24 -left-24 h-96 w-96 rounded-full bg-black/10 blur-2xl"
                />

                <div class="relative mx-auto max-w-3xl text-center">
                    <div
                        class="inline-flex items-center gap-2 rounded-full bg-white/20 px-4 py-1.5 text-xs font-semibold text-white backdrop-blur-sm"
                    >
                        <Sparkles class="h-3.5 w-3.5" />
                        <span>Mulai Langkah Digital Anda Hari Ini</span>
                    </div>

                    <h2 class="mt-6 text-3xl font-extrabold tracking-tight sm:text-4xl lg:text-5xl leading-tight">
                        Siap Mewujudkan Website, App, Game, atau AR/VR Anda?
                    </h2>

                    <p class="mt-6 text-base sm:text-lg text-orange-50 leading-relaxed max-w-2xl mx-auto">
                        Jangan biarkan ide hebat Anda tertunda. Hubungi kami untuk sesi konsultasi 100% gratis tanpa komitmen apapun. Kami bantu rancang solusi terbaik sesuai budget Anda.
                    </p>

                    <div class="mt-8 flex flex-col sm:flex-row items-center justify-center gap-4">
                        <Button
                            as="a"
                            :href="whatsappUrl"
                            target="_blank"
                            rel="noopener noreferrer"
                            size="lg"
                            class="w-full sm:w-auto gap-2.5 bg-white text-orange-600 hover:bg-orange-50 font-bold shadow-xl shadow-black/10 text-base"
                        >
                            <MessageCircle class="h-5 w-5 text-green-600" />
                            Hubungi via WhatsApp Sekarang
                        </Button>
                    </div>

                    <div class="mt-8 flex flex-wrap items-center justify-center gap-6 text-xs sm:text-sm font-medium text-orange-100">
                        <div class="flex items-center gap-2">
                            <CheckCircle2 class="h-4 w-4 text-white" />
                            <span>Konsultasi 100% Gratis</span>
                        </div>
                        <div class="flex items-center gap-2">
                            <CheckCircle2 class="h-4 w-4 text-white" />
                            <span>Estimasi Biaya Transparan</span>
                        </div>
                        <div class="flex items-center gap-2">
                            <CheckCircle2 class="h-4 w-4 text-white" />
                            <span>Respons Cepat & Ramah</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>
