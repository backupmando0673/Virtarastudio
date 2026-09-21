<script setup>
import { Button } from '@/Components/ui/button';
import { Badge } from '@/Components/ui/badge';
import {
    Scan,
    Glasses,
    Gamepad2,
    Palette,
    Cpu,
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
        <!-- Dual background blurs -->
        <div
            class="pointer-events-none absolute top-1/2 left-0 -z-10 h-[450px] w-[450px] -translate-y-1/2 rounded-full bg-amber-100/30 blur-3xl"
        />
        <div
            class="pointer-events-none absolute top-1/2 right-0 -z-10 h-[450px] w-[450px] -translate-y-1/2 rounded-full bg-blue-100/35 blur-3xl"
        />

        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <!-- Header -->
            <div class="flex flex-col items-center text-center">
                <div class="inline-flex items-center gap-2 rounded-full border border-slate-200 bg-white px-4 py-1 text-xs font-semibold text-slate-700 shadow-xs">
                    <span class="flex items-center gap-1 text-amber-600 font-bold">
                        <Palette class="h-3.5 w-3.5" /> Seni
                    </span>
                    <span class="text-slate-300">&bull;</span>
                    <span class="flex items-center gap-1 text-blue-600 font-bold">
                        <Cpu class="h-3.5 w-3.5" /> Teknologi
                    </span>
                    <span class="text-slate-300">|</span>
                    <span class="text-slate-600">Inovasi Terdepan</span>
                </div>

                <h2 class="mt-4 max-w-3xl text-3xl font-extrabold tracking-tight text-slate-900 sm:text-4xl">
                    Keunggulan Spesial: Game, AR & VR Development
                </h2>
                <p class="mt-4 max-w-2xl text-base text-slate-600 sm:text-lg leading-relaxed">
                    Kami menggabungkan estetika desain visual (Seni) dan algoritma perangkat lunak mutakhir (Teknologi) untuk menghasilkan produk imersif yang memikat pelanggan Anda.
                </p>
            </div>

            <!-- 3 Immersive Pillars Grid -->
            <div class="mt-14 grid gap-8 md:grid-cols-3">
                <!-- Pillar 1: Game Development (Pilar Seni & Interaksi) -->
                <div
                    class="group relative flex flex-col justify-between rounded-3xl border border-amber-200/90 bg-gradient-to-b from-amber-50/30 to-white p-8 shadow-sm transition-all duration-300 hover:border-amber-400 hover:shadow-xl hover:shadow-amber-500/10"
                >
                    <div>
                        <div class="flex items-center justify-between">
                            <div class="flex h-14 w-14 items-center justify-center rounded-2xl bg-amber-500 text-white shadow-md shadow-amber-500/25">
                                <Gamepad2 class="h-7 w-7" />
                            </div>
                            <span class="rounded-full bg-amber-100 px-2.5 py-0.5 text-[10px] font-bold text-amber-800 uppercase tracking-wider">
                                Pilar Seni
                            </span>
                        </div>
                        <h3 class="mt-6 text-xl font-bold text-slate-900">
                            Game Android 2D & 3D
                        </h3>
                        <p class="mt-3 text-sm text-slate-600 leading-relaxed">
                            Kombinasi ilustrasi karakter yang indah, animasi fluid, dan efek suara berpadu dengan mekanik gameplay adiktif untuk media promosi dan edukasi interaktif.
                        </p>
                        <div class="mt-5 space-y-2 text-xs font-medium text-slate-700">
                            <div class="flex items-center gap-2">
                                <span class="h-1.5 w-1.5 rounded-full bg-amber-500"></span>
                                <span>Game promosi brand (Advergame)</span>
                            </div>
                            <div class="flex items-center gap-2">
                                <span class="h-1.5 w-1.5 rounded-full bg-amber-500"></span>
                                <span>Game edukasi sekolah & kampus</span>
                            </div>
                            <div class="flex items-center gap-2">
                                <span class="h-1.5 w-1.5 rounded-full bg-amber-500"></span>
                                <span>Game komersial Play Store (AdMob/IAP)</span>
                            </div>
                        </div>
                    </div>
                    <div class="mt-8 pt-6 border-t border-amber-100 flex items-center justify-between">
                        <span class="text-xs font-semibold text-amber-700">Unity & Godot Engine</span>
                        <span class="text-xs font-bold text-slate-900">Mulai 1.9Jt</span>
                    </div>
                </div>

                <!-- Pillar 2: Augmented Reality (Pilar Teknologi 3D) -->
                <div
                    class="group relative flex flex-col justify-between rounded-3xl border-2 border-blue-400 bg-gradient-to-b from-blue-50/40 via-white to-white p-8 shadow-lg shadow-blue-500/10 transition-all duration-300 hover:-translate-y-1 hover:shadow-2xl"
                >
                    <div>
                        <div class="flex items-center justify-between">
                            <div class="flex h-14 w-14 items-center justify-center rounded-2xl bg-blue-600 text-white shadow-md shadow-blue-600/25">
                                <Scan class="h-7 w-7" />
                            </div>
                            <span class="rounded-full bg-blue-600 px-2.5 py-0.5 text-[10px] font-bold text-white uppercase tracking-wider">
                                Pilar Teknologi
                            </span>
                        </div>
                        <h3 class="mt-6 text-xl font-bold text-slate-900">
                            Augmented Reality (AR)
                        </h3>
                        <p class="mt-3 text-sm text-slate-600 leading-relaxed">
                            Proyeksikan model 3D produk Anda secara nyata di ruangan calon pelanggan melalui kamera smartphone. Solusi tepat untuk pameran, katalog furnitur, dan pemasaran modern.
                        </p>
                        <div class="mt-5 space-y-2 text-xs font-medium text-slate-700">
                            <div class="flex items-center gap-2">
                                <span class="h-1.5 w-1.5 rounded-full bg-blue-600"></span>
                                <span>Katalog 3D produk interaktif</span>
                            </div>
                            <div class="flex items-center gap-2">
                                <span class="h-1.5 w-1.5 rounded-full bg-blue-600"></span>
                                <span>WebAR (Buka langsung tanpa download)</span>
                            </div>
                            <div class="flex items-center gap-2">
                                <span class="h-1.5 w-1.5 rounded-full bg-blue-600"></span>
                                <span>Buku visual 3D & edukasi anatomi</span>
                            </div>
                        </div>
                    </div>
                    <div class="mt-8 pt-6 border-t border-blue-100 flex items-center justify-between">
                        <span class="text-xs font-semibold text-blue-700">WebAR & ARCore / ARKit</span>
                        <span class="text-xs font-bold text-slate-900">Mulai 1.8Jt</span>
                    </div>
                </div>

                <!-- Pillar 3: Virtual Reality (Pilar Teknologi Imersif) -->
                <div
                    class="group relative flex flex-col justify-between rounded-3xl border border-indigo-200/90 bg-gradient-to-b from-indigo-50/30 to-white p-8 shadow-sm transition-all duration-300 hover:border-indigo-400 hover:shadow-xl hover:shadow-indigo-500/10"
                >
                    <div>
                        <div class="flex items-center justify-between">
                            <div class="flex h-14 w-14 items-center justify-center rounded-2xl bg-indigo-600 text-white shadow-md shadow-indigo-600/25">
                                <Glasses class="h-7 w-7" />
                            </div>
                            <span class="rounded-full bg-indigo-100 px-2.5 py-0.5 text-[10px] font-bold text-indigo-800 uppercase tracking-wider">
                                Pilar Teknologi
                            </span>
                        </div>
                        <h3 class="mt-6 text-xl font-bold text-slate-900">
                            Virtual Reality (VR)
                        </h3>
                        <p class="mt-3 text-sm text-slate-600 leading-relaxed">
                            Ciptakan simulasi 360 derajat yang realistis. Memungkinkan klien berjalan di dalam rumah contoh, properti wisata, atau melatih karyawan dalam lingkungan kerja aman.
                        </p>
                        <div class="mt-5 space-y-2 text-xs font-medium text-slate-700">
                            <div class="flex items-center gap-2">
                                <span class="h-1.5 w-1.5 rounded-full bg-indigo-600"></span>
                                <span>Virtual tour 360° properti & arsitektur</span>
                            </div>
                            <div class="flex items-center gap-2">
                                <span class="h-1.5 w-1.5 rounded-full bg-indigo-600"></span>
                                <span>Simulasi pelatihan K3 / safety training</span>
                            </div>
                            <div class="flex items-center gap-2">
                                <span class="h-1.5 w-1.5 rounded-full bg-indigo-600"></span>
                                <span>Showroom produk & museum virtual</span>
                            </div>
                        </div>
                    </div>
                    <div class="mt-8 pt-6 border-t border-indigo-100 flex items-center justify-between">
                        <span class="text-xs font-semibold text-indigo-700">Meta Quest & 360 HD</span>
                        <span class="text-xs font-bold text-slate-900">Mulai 2.4Jt</span>
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
                    class="gap-2 font-bold border-blue-200 bg-white text-blue-700 hover:bg-blue-50 hover:border-blue-300"
                >
                    <MessageCircle class="h-5 w-5 text-emerald-500" />
                    Konsultasi Gratis Konsep Game / AR / VR via WhatsApp
                    <ArrowRight class="h-4 w-4" />
                </Button>
            </div>
        </div>
    </section>
</template>
