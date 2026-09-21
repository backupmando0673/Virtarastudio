<script setup>
import { Link } from '@inertiajs/vue3';
import { Sparkles, MessageCircle, Mail, MapPin } from '@lucide/vue';

const props = defineProps({
    settings: {
        type: Object,
        default: () => ({}),
    },
    whatsappUrl: {
        type: String,
        default: '#',
    },
    services: {
        type: Array,
        default: () => [],
    },
});

const currentYear = new Date().getFullYear();
</script>

<template>
    <footer class="bg-slate-900 text-slate-400 pt-16 pb-12 border-t border-slate-800">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="grid gap-10 md:grid-cols-2 lg:grid-cols-5">
                <!-- Brand Column -->
                <div class="lg:col-span-2">
                    <div class="flex items-center gap-2.5">
                        <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-orange-500 text-white shadow-md shadow-orange-500/25">
                            <Sparkles class="h-5 w-5" />
                        </div>
                        <span class="text-xl font-extrabold tracking-tight text-white">
                            Virtara<span class="text-orange-500">studio</span>
                        </span>
                    </div>
                    <p class="mt-4 text-sm text-slate-400 leading-relaxed max-w-sm">
                        {{ settings.site_tagline || 'Studio pengembangan website murah, aplikasi Android, game 2D/3D, serta solusi masa depan Augmented Reality (AR) & Virtual Reality (VR).' }}
                    </p>
                    <div class="mt-6 flex items-center gap-3">
                        <a
                            v-if="settings.instagram_url"
                            :href="settings.instagram_url"
                            target="_blank"
                            rel="noopener noreferrer"
                            class="flex h-9 w-9 items-center justify-center rounded-lg bg-slate-800 text-slate-400 hover:bg-orange-500 hover:text-white transition-colors"
                        >
                            <span class="text-xs font-bold">IG</span>
                        </a>
                        <a
                            v-if="settings.tiktok_url"
                            :href="settings.tiktok_url"
                            target="_blank"
                            rel="noopener noreferrer"
                            class="flex h-9 w-9 items-center justify-center rounded-lg bg-slate-800 text-slate-400 hover:bg-orange-500 hover:text-white transition-colors"
                        >
                            <span class="text-xs font-bold">TT</span>
                        </a>
                        <a
                            v-if="settings.linkedin_url"
                            :href="settings.linkedin_url"
                            target="_blank"
                            rel="noopener noreferrer"
                            class="flex h-9 w-9 items-center justify-center rounded-lg bg-slate-800 text-slate-400 hover:bg-orange-500 hover:text-white transition-colors"
                        >
                            <span class="text-xs font-bold">IN</span>
                        </a>
                    </div>
                </div>

                <!-- Services Links -->
                <div>
                    <h4 class="text-sm font-bold text-white uppercase tracking-wider">Layanan Kami</h4>
                    <ul class="mt-4 space-y-2.5 text-sm">
                        <li v-for="srv in services" :key="srv.id">
                            <a :href="srv.whatsapp_url" target="_blank" rel="noopener noreferrer" class="hover:text-orange-400 transition-colors">
                                {{ srv.name }}
                            </a>
                        </li>
                    </ul>
                </div>

                <!-- Quick Navigation -->
                <div>
                    <h4 class="text-sm font-bold text-white uppercase tracking-wider">Navigasi</h4>
                    <ul class="mt-4 space-y-2.5 text-sm">
                        <li>
                            <a href="#" class="hover:text-orange-400 transition-colors">Beranda</a>
                        </li>
                        <li>
                            <a href="#services" class="hover:text-orange-400 transition-colors">5 Layanan</a>
                        </li>
                        <li>
                            <a href="#immersive" class="hover:text-orange-400 transition-colors">Teknologi AR / VR</a>
                        </li>
                        <li>
                            <a href="#portfolio" class="hover:text-orange-400 transition-colors">Portofolio</a>
                        </li>
                        <li>
                            <a href="#why-us" class="hover:text-orange-400 transition-colors">Keunggulan</a>
                        </li>
                        <li>
                            <a href="#faq" class="hover:text-orange-400 transition-colors">FAQ</a>
                        </li>
                    </ul>
                </div>

                <!-- Contact Info -->
                <div>
                    <h4 class="text-sm font-bold text-white uppercase tracking-wider">Kontak Resmi</h4>
                    <ul class="mt-4 space-y-3 text-sm">
                        <li class="flex items-center gap-2.5">
                            <MessageCircle class="h-4 w-4 text-green-400 shrink-0" />
                            <a :href="whatsappUrl" target="_blank" rel="noopener noreferrer" class="hover:text-white transition-colors">
                                +{{ settings.whatsapp_number || '6281234567890' }}
                            </a>
                        </li>
                        <li class="flex items-center gap-2.5">
                            <Mail class="h-4 w-4 text-orange-400 shrink-0" />
                            <span>{{ settings.email || 'kontak@virtarastudio.com' }}</span>
                        </li>
                        <li class="flex items-center gap-2.5">
                            <MapPin class="h-4 w-4 text-orange-400 shrink-0" />
                            <span>{{ settings.address || 'Indonesia' }}</span>
                        </li>
                    </ul>

                    <div class="mt-6 pt-4 border-t border-slate-800">
                        <Link
                            :href="route('login')"
                            class="text-xs text-slate-500 hover:text-orange-400 transition-colors"
                        >
                            Area Login Admin
                        </Link>
                    </div>
                </div>
            </div>

            <!-- Bottom Copyright -->
            <div class="mt-12 border-t border-slate-800 pt-8 flex flex-col sm:flex-row items-center justify-between text-xs text-slate-500 gap-4">
                <p>&copy; {{ currentYear }} {{ settings.site_name || 'Virtarastudio' }}. Hak Cipta Dilindungi Undang-Undang.</p>
                <p>Website Murah &bull; Android App &bull; Game Dev &bull; AR &bull; VR</p>
            </div>
        </div>
    </footer>
</template>
