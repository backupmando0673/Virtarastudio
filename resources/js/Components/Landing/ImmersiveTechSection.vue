<script setup>
import { Button } from '@/Components/ui/button';
import { Badge } from '@/Components/ui/badge';
import {
    Scan,
    Glasses,
    Gamepad2,
    Eye,
    Layers,
    Sparkles,
    MessageCircle,
    ArrowRight,
} from '@lucide/vue';

const props = defineProps({
    whatsappUrl: {
        type: String,
        default: '#',
    },
});
</script>

<template>
    <section id="immersive" class="relative overflow-hidden bg-white py-20 md:py-28">
        <!-- Subtle background shapes -->
        <div
            class="pointer-events-none absolute top-1/2 right-0 -z-10 h-[500px] w-[500px] -translate-y-1/2 rounded-full bg-orange-100/40 blur-3xl"
        />

        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <!-- Header -->
            <div class="flex flex-col items-center text-center">
                <div class="inline-flex items-center gap-2 rounded-full bg-orange-100/80 px-4 py-1 text-xs font-semibold text-orange-700">
                    <Sparkles class="h-3.5 w-3.5 text-orange-500" />
                    <span>Inovasi Masa Depan</span>
                </div>
                <h2 class="mt-4 max-w-3xl text-3xl font-extrabold tracking-tight text-slate-900 sm:text-4xl">
                    Keunggulan Spesial: Game, AR & VR Development
                </h2>
                <p class="mt-4 max-w-2xl text-base text-slate-600 sm:text-lg leading-relaxed">
                    Virtarastudio tidak hanya membangun website dan aplikasi biasa. Kami menghadirkan teknologi interaktif & imersif untuk meningkatkan daya tarik brand Anda ke level berikutnya.
                </p>
            </div>

            <!-- 3 Immersive Pillars Grid -->
            <div class="mt-14 grid gap-8 md:grid-cols-3">
                <!-- Pillar 1: Game Development -->
                <div
                    class="group relative flex flex-col justify-between rounded-3xl border border-slate-200/90 bg-white p-8 shadow-sm transition-all duration-300 hover:border-orange-300 hover:shadow-xl hover:shadow-orange-500/10"
                >
                    <div>
                        <div class="flex h-14 w-14 items-center justify-center rounded-2xl bg-orange-500 text-white shadow-md shadow-orange-500/25">
                            <Gamepad2 class="h-7 w-7" />
                        </div>
                        <h3 class="mt-6 text-xl font-bold text-slate-900">
                            Game Android 2D & 3D
                        </h3>
                        <p class="mt-3 text-sm text-slate-600 leading-relaxed">
                            Kembangkan game seru untuk media promosi bisnis (advergame), gamifikasi event, maupun media edukasi interaktif anak dan pelajar dengan engine game modern.
                        </p>
                        <div class="mt-5 space-y-2 text-xs font-medium text-slate-700">
                            <div class="flex items-center gap-2">
                                <span class="h-1.5 w-1.5 rounded-full bg-orange-500"></span>
                                <span>Game promosi brand & event</span>
                            </div>
                            <div class="flex items-center gap-2">
                                <span class="h-1.5 w-1.5 rounded-full bg-orange-500"></span>
                                <span>Game edukasi sekolah & kampus</span>
                            </div>
                            <div class="flex items-center gap-2">
                                <span class="h-1.5 w-1.5 rounded-full bg-orange-500"></span>
                                <span>Game komersial publik (Admob/IAP)</span>
                            </div>
                        </div>
                    </div>
                    <div class="mt-8 pt-6 border-t border-slate-100">
                        <Badge variant="orangeSoft">Unity & Godot Engine</Badge>
                    </div>
                </div>

                <!-- Pillar 2: Augmented Reality (AR) -->
                <div
                    class="group relative flex flex-col justify-between rounded-3xl border-2 border-orange-400 bg-gradient-to-b from-orange-50/40 via-white to-white p-8 shadow-lg shadow-orange-500/10 transition-all duration-300 hover:-translate-y-1 hover:shadow-2xl"
                >
                    <div>
                        <div class="flex items-center justify-between">
                            <div class="flex h-14 w-14 items-center justify-center rounded-2xl bg-orange-500 text-white shadow-md shadow-orange-500/25">
                                <Scan class="h-7 w-7" />
                            </div>
                            <Badge variant="default" class="bg-orange-500 text-white text-xs">Paling Diminati</Badge>
                        </div>
                        <h3 class="mt-6 text-xl font-bold text-slate-900">
                            Augmented Reality (AR)
                        </h3>
                        <p class="mt-3 text-sm text-slate-600 leading-relaxed">
                            Hadirkan produk 3D langsung di depan mata calon pembeli lewat kamera smartphone. Sangat efektif untuk katalog furnitur, pameran produk, dan promosi sosial media.
                        </p>
                        <div class="mt-5 space-y-2 text-xs font-medium text-slate-700">
                            <div class="flex items-center gap-2">
                                <span class="h-1.5 w-1.5 rounded-full bg-orange-500"></span>
                                <span>Katalog 3D produk interaktif</span>
                            </div>
                            <div class="flex items-center gap-2">
                                <span class="h-1.5 w-1.5 rounded-full bg-orange-500"></span>
                                <span>WebAR (Tanpa download aplikasi)</span>
                            </div>
                            <div class="flex items-center gap-2">
                                <span class="h-1.5 w-1.5 rounded-full bg-orange-500"></span>
                                <span>Buku visual 3D & edukasi sains</span>
                            </div>
                        </div>
                    </div>
                    <div class="mt-8 pt-6 border-t border-orange-100">
                        <Badge variant="orangeSoft">WebAR & ARCore / ARKit</Badge>
                    </div>
                </div>

                <!-- Pillar 3: Virtual Reality (VR) -->
                <div
                    class="group relative flex flex-col justify-between rounded-3xl border border-slate-200/90 bg-white p-8 shadow-sm transition-all duration-300 hover:border-orange-300 hover:shadow-xl hover:shadow-orange-500/10"
                >
                    <div>
                        <div class="flex h-14 w-14 items-center justify-center rounded-2xl bg-orange-500 text-white shadow-md shadow-orange-500/25">
                            <Glasses class="h-7 w-7" />
                        </div>
                        <h3 class="mt-6 text-xl font-bold text-slate-900">
                            Virtual Reality (VR)
                        </h3>
                        <p class="mt-3 text-sm text-slate-600 leading-relaxed">
                            Ciptakan simulasi dunia virtual 360° yang imersif. Solusi terbaik untuk virtual tour perumahan/apartemen, pariwisata, hingga simulasi pelatihan kerja dengan risiko nol.
                        </p>
                        <div class="mt-5 space-y-2 text-xs font-medium text-slate-700">
                            <div class="flex items-center gap-2">
                                <span class="h-1.5 w-1.5 rounded-full bg-orange-500"></span>
                                <span>Virtual tour 360° properti & wisata</span>
                            </div>
                            <div class="flex items-center gap-2">
                                <span class="h-1.5 w-1.5 rounded-full bg-orange-500"></span>
                                <span>Simulasi pelatihan K3 / safety training</span>
                            </div>
                            <div class="flex items-center gap-2">
                                <span class="h-1.5 w-1.5 rounded-full bg-orange-500"></span>
                                <span>Showroom mobil & pameran virtual</span>
                            </div>
                        </div>
                    </div>
                    <div class="mt-8 pt-6 border-t border-slate-100">
                        <Badge variant="orangeSoft">Meta Quest & 360 Panoramic</Badge>
                    </div>
                </div>
            </div>

            <!-- Bottom Action -->
            <div class="mt-12 text-center">
                <Button
                    as="a"
                    :href="whatsappUrl"
                    target="_blank"
                    rel="noopener noreferrer"
                    variant="outline"
                    size="lg"
                    class="gap-2 font-bold text-slate-800 hover:text-orange-600 hover:border-orange-300"
                >
                    <MessageCircle class="h-5 w-5 text-orange-500" />
                    Diskusi Konsep Game / AR / VR via WhatsApp
                    <ArrowRight class="h-4 w-4" />
                </Button>
            </div>
        </div>
    </section>
</template>
