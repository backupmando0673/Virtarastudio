<script setup>
import { ref } from 'vue';
import { Link } from '@inertiajs/vue3';
import { Button } from '@/Components/ui/button';
import { Menu, X, MessageCircle, Sparkles } from '@lucide/vue';

const props = defineProps({
    canLogin: {
        type: Boolean,
        default: true,
    },
    whatsappUrl: {
        type: String,
        default: '#',
    },
    siteName: {
        type: String,
        default: 'Virtarastudio',
    },
});

const mobileMenuOpen = ref(false);

const navLinks = [
    { name: 'Layanan', href: '#services' },
    { name: 'AR/VR Tech', href: '#immersive' },
    { name: 'Keunggulan', href: '#why-us' },
    { name: 'Portofolio', href: '#portfolio' },
    { name: 'FAQ', href: '#faq' },
];
</script>

<template>
    <header
        class="sticky top-0 z-40 w-full border-b border-slate-200/80 bg-white/90 backdrop-blur-md transition-all"
    >
        <div class="mx-auto flex h-20 max-w-7xl items-center justify-between px-4 sm:px-6 lg:px-8">
            <!-- Brand Logo -->
            <a href="#" class="group flex items-center gap-2.5">
                <div
                    class="flex h-10 w-10 items-center justify-center rounded-xl bg-orange-500 text-white shadow-md shadow-orange-500/25 transition-transform duration-200 group-hover:scale-105"
                >
                    <Sparkles class="h-5 w-5" />
                </div>
                <div class="flex flex-col">
                    <span class="text-xl font-extrabold tracking-tight text-slate-900">
                        Virtara<span class="text-orange-500">studio</span>
                    </span>
                    <span class="text-[10px] font-medium tracking-widest text-slate-500 uppercase">
                        Digital & Immersive Studio
                    </span>
                </div>
            </a>

            <!-- Desktop Nav Links -->
            <nav class="hidden items-center gap-8 md:flex">
                <a
                    v-for="link in navLinks"
                    :key="link.name"
                    :href="link.href"
                    class="text-sm font-medium text-slate-600 transition-colors duration-150 hover:text-orange-600"
                >
                    {{ link.name }}
                </a>
            </nav>

            <!-- Actions Desktop -->
            <div class="hidden items-center gap-3 md:flex">
                <Link
                    v-if="$page.props.auth.user"
                    :href="route('dashboard')"
                    class="text-sm font-medium text-slate-700 hover:text-orange-600"
                >
                    Dashboard Admin
                </Link>
                <Link
                    v-else-if="canLogin"
                    :href="route('login')"
                    class="text-sm font-medium text-slate-600 hover:text-orange-600"
                >
                    Admin Login
                </Link>

                <Button
                    as="a"
                    :href="whatsappUrl"
                    target="_blank"
                    rel="noopener noreferrer"
                    variant="default"
                    class="gap-2 font-semibold shadow-md shadow-orange-500/20"
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
                    <X v-else class="h-6 w-6 text-orange-600" />
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
                    class="rounded-lg px-3 py-2 text-base font-medium text-slate-700 hover:bg-orange-50 hover:text-orange-600"
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
                        variant="default"
                        class="w-full gap-2 font-semibold shadow-md shadow-orange-500/20"
                        @click="mobileMenuOpen = false"
                    >
                        <MessageCircle class="h-4 w-4" />
                        Konsultasi Gratis via WhatsApp
                    </Button>
                    <div class="mt-3 text-center">
                        <Link
                            v-if="$page.props.auth.user"
                            :href="route('dashboard')"
                            class="text-sm font-medium text-slate-700 hover:text-orange-600"
                        >
                            Masuk ke Dashboard Admin
                        </Link>
                        <Link
                            v-else-if="canLogin"
                            :href="route('login')"
                            class="text-xs font-medium text-slate-500 hover:text-orange-600"
                        >
                            Admin Login Area
                        </Link>
                    </div>
                </div>
            </div>
        </div>
    </header>
</template>
