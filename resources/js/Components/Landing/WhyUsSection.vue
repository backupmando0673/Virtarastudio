<script setup>
import { Badge } from '@/Components/ui/badge';
import {
    CircleDollarSign,
    Zap,
    Code2,
    ShieldCheck,
    Palette,
    Cpu,
} from '@lucide/vue';

const advantages = [
    {
        icon: CircleDollarSign,
        colorClass: 'bg-amber-100 text-amber-600',
        title: 'Harga Bersahabat & Transparan',
        description:
            'Biaya ramah kantong untuk UMKM hingga startup tanpa biaya tersembunyi. Skema pembayaran bertahap (DP dan Pelunasan) yang aman dan nyaman.',
    },
    {
        icon: Zap,
        colorClass: 'bg-amber-100 text-amber-600',
        title: 'Pengerjaan Cepat & Terjadwal',
        description:
            'Timeline pengerjaan yang jelas dan terstruktur. Kami berkomitmen menyelesaikan proyek tepat waktu sesuai kesepakatan bersama.',
    },
    {
        icon: Code2,
        colorClass: 'bg-blue-100 text-blue-600',
        title: 'Teknologi Modern Terkini',
        description:
            'Dibangun menggunakan teknologi industri terdepan seperti Laravel, Vue.js, Tailwind CSS, Unity, dan WebXR untuk performa maksimal.',
    },
    {
        icon: ShieldCheck,
        colorClass: 'bg-blue-100 text-blue-600',
        title: 'Garansi Bebas Bug & Maintenance',
        description:
            'Kami memberikan garansi perbaikan bug dan pendampingan teknis setelah serah terima proyek agar sistem Anda siap beroperasi optimal.',
    },
];
</script>

<template>
    <section id="why-us" class="relative bg-slate-50/70 py-20 md:py-28 border-y border-slate-200/70">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="mx-auto max-w-3xl text-center">
                <div class="inline-flex items-center gap-2 rounded-full border border-slate-200 bg-white px-4 py-1 text-xs font-semibold text-slate-700 shadow-xs">
                    <span class="text-amber-600 font-bold">Kreativitas</span>
                    <span>&bull;</span>
                    <span class="text-blue-600 font-bold">Keandalan</span>
                    <span>|</span>
                    <span>Keunggulan Kami</span>
                </div>
                <h2 class="mt-4 text-3xl font-extrabold tracking-tight text-slate-900 sm:text-4xl">
                    Mengapa Memilih Virtara Studio?
                </h2>
                <p class="mt-4 text-base text-slate-600 sm:text-lg leading-relaxed">
                    Komitmen kami adalah memberikan hasil digital terbaik dengan proses yang mudah, komunikasi cepat via WhatsApp, dan biaya yang efisien.
                </p>
            </div>

            <div class="mt-14 grid gap-8 sm:grid-cols-2 lg:grid-cols-4">
                <div
                    v-for="(item, index) in advantages"
                    :key="index"
                    class="flex flex-col items-start rounded-2xl border border-slate-200/90 bg-white p-6 shadow-sm transition-all duration-300 hover:border-slate-300 hover:shadow-lg hover:-translate-y-1"
                >
                    <div
                        class="flex h-12 w-12 items-center justify-center rounded-xl shadow-xs"
                        :class="item.colorClass"
                    >
                        <component :is="item.icon" class="h-6 w-6" />
                    </div>
                    <h3 class="mt-5 text-lg font-bold text-slate-900">
                        {{ item.title }}
                    </h3>
                    <p class="mt-2 text-sm text-slate-600 leading-relaxed">
                        {{ item.description }}
                    </p>
                </div>
            </div>
        </div>
    </section>
</template>
