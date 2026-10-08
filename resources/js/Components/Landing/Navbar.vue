<script setup>
import { ref } from 'vue';
import { Link } from '@inertiajs/vue3';
import { Button } from '@/Components/ui/button';
import { Menu, X, MessageCircle, Sparkles, Cpu } from '@lucide/vue';

const props = defineProps({
    whatsappUrl: {
        type: String,
        default: '#',
    },
    siteName: {
        type: String,
        default: 'Virtarastudio',
    },
    siteLogo: {
        type: String,
        default: null,
    },
});

const mobileMenuOpen = ref(false);

const navLinks = [
    { name: 'Layanan', href: '#services' },
    { name: 'AR/VR & Game', href: '#immersive' },
    { name: 'Keunggulan', href: '#why-us' },
    { name: 'Portofolio', href: '#portfolio' },
    { name: 'FAQ', href: '#faq' },
];
</script>

<template>
    <header
        class="sticky top-0 z-40 w-full border-b border-slate-200 bg-white shadow-xs"
    >
        <div class="mx-auto flex h-20 max-w-7xl items-center justify-between px-4 sm:px-6 lg:px-8">
            <!-- Brand Logo -->
            <a href="#" class="group flex items-center gap-2.5">
                <template v-if="siteLogo || $page.props.site_settings?.site_logo">
                    <img
                        :src="siteLogo || $page.props.site_settings.site_logo"
                        :alt="siteName"
                        class="h-11 w-auto max-w-[200px] object-contain transition-transform duration-200 group-hover:scale-105"
                    />
                </template>
                <template v-else>
                    <div
                        class="flex h-11 w-11 items-center justify-center rounded-xl bg-blue-600 text-white shadow-xs transition-transform duration-200 group-hover:scale-105"
                    >
                        <Sparkles class="h-5 w-5" />
                    </div>
                    <div class="flex flex-col">
                        <div class="flex items-center text-xl font-extrabold tracking-tight">
                            <span class="text-slate-900">{{ siteName ? siteName.substring(0, Math.ceil(siteName.length / 2)) : 'Virtara' }}</span>
                            <span class="text-amber-500">{{ siteName ? siteName.substring(Math.ceil(siteName.length / 2)) : 'studio' }}</span>
                        </div>
                        <div class="flex items-center gap-1.5 text-[10px] font-semibold tracking-wider uppercase text-slate-500">
                            <span class="text-amber-600 font-bold">Seni</span>
                            <span>&bull;</span>
                            <span class="text-blue-600 font-bold">Teknologi</span>
                        </div>
                    </div>
                </template>
            </a>

            <!-- Desktop Nav Links -->
            <nav class="hidden items-center gap-8 md:flex">
                <a
                    v-for="link in navLinks"
                    :key="link.name"
                    :href="link.href"
                    class="text-sm font-medium text-slate-600 transition-colors duration-150 hover:text-blue-600"
                >
                    {{ link.name }}
                </a>
            </nav>

            <!-- Actions Desktop: Solid Amber Button & Dashboard link if logged in -->
            <div class="hidden items-center gap-3.5 md:flex">
                <Link
                    v-if="$page.props.auth.user"
                    :href="route('dashboard')"
                    class="inline-flex items-center gap-1.5 rounded-xl border border-slate-200 bg-slate-50 px-3.5 py-2 text-xs font-semibold text-slate-700 hover:border-blue-300 hover:text-blue-600 transition"
                >
                    <Cpu class="h-3.5 w-3.5 text-blue-600" />
                    <span>Dashboard Admin</span>
                </Link>

                <Button
                    as="a"
                    :href="whatsappUrl"
                    target="_blank"
                    rel="noopener noreferrer"
                    class="gap-2 font-bold bg-amber-500 hover:bg-amber-600 text-white shadow-sm border-0 transition-all hover:-translate-y-0.5"
                >
                    <MessageCircle class="h-4 w-4" />
                    Konsultasi Gratis
                </Button>
            </div>

            <!-- Mobile Menu Toggle -->
            <div class="flex md:hidden">
                <button
                    type="button"
                    class="inline-flex items-center justify-center rounded-xl p-2.5 text-slate-700 hover:bg-slate-100"
                    @click="mobileMenuOpen = !mobileMenuOpen"
                >
                    <Menu v-if="!mobileMenuOpen" class="h-6 w-6" />
                    <X v-else class="h-6 w-6 text-amber-500" />
                </button>
            </div>
        </div>

        <!-- Mobile Menu Dropdown -->
        <div
            v-if="mobileMenuOpen"
            class="border-b border-slate-200 bg-white px-4 pt-2 pb-6 md:hidden shadow-lg"
        >
            <div class="flex flex-col space-y-3">
                <a
                    v-for="link in navLinks"
                    :key="link.name"
                    :href="link.href"
                    class="rounded-lg px-3 py-2 text-base font-medium text-slate-700 hover:bg-blue-50 hover:text-blue-600"
                    @click="mobileMenuOpen = false"
                >
                    {{ link.name }}
                </a>
                <div class="my-2 border-t border-slate-100 pt-3">
                    <Button
                        as="a"
                        :href="whatsappUrl"
                        target="_blank"
                        rel="noopener noreferrer"
                        class="w-full gap-2 font-bold bg-amber-500 hover:bg-amber-600 text-white shadow-sm border-0"
                        @click="mobileMenuOpen = false"
                    >
                        <MessageCircle class="h-4 w-4" />
                        Konsultasi Gratis via WhatsApp
                    </Button>

                    <div v-if="$page.props.auth.user" class="mt-3 text-center">
                        <Link
                            :href="route('dashboard')"
                            class="text-xs font-semibold text-blue-600 hover:underline"
                        >
                            Masuk ke Dashboard Admin &rarr;
                        </Link>
                    </div>
                </div>
            </div>
        </div>
    </header>
</template>
