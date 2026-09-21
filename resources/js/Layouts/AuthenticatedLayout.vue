<script setup>
import { ref } from 'vue';
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
import Dropdown from '@/Components/Dropdown.vue';
import DropdownLink from '@/Components/DropdownLink.vue';
import NavLink from '@/Components/NavLink.vue';
import ResponsiveNavLink from '@/Components/ResponsiveNavLink.vue';
import { Link } from '@inertiajs/vue3';
import { Sparkles, ExternalLink } from '@lucide/vue';

const showingNavigationDropdown = ref(false);
</script>

<template>
    <div>
        <div class="min-h-screen bg-slate-50 text-slate-900 font-sans">
            <!-- Navbar -->
            <nav class="border-b border-slate-200 bg-white sticky top-0 z-30 shadow-xs">
                <!-- Primary Navigation Menu -->
                <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                    <div class="flex h-16 justify-between">
                        <div class="flex">
                            <!-- Logo -->
                            <div class="flex shrink-0 items-center">
                                <Link :href="route('admin.dashboard')" class="flex items-center gap-2">
                                    <div class="flex h-9 w-9 items-center justify-center rounded-xl bg-orange-500 text-white shadow-sm">
                                        <Sparkles class="h-4 w-4" />
                                    </div>
                                    <span class="font-bold text-slate-900 text-base">
                                        Virtara<span class="text-orange-500">CMS</span>
                                    </span>
                                </Link>
                            </div>

                            <!-- Navigation Links -->
                            <div class="hidden space-x-6 sm:-my-px sm:ms-8 sm:flex">
                                <NavLink
                                    :href="route('admin.dashboard')"
                                    :active="route().current('admin.dashboard')"
                                    class="text-sm font-medium"
                                >
                                    Dashboard
                                </NavLink>
                                <NavLink
                                    :href="route('admin.settings.index')"
                                    :active="route().current('admin.settings.*')"
                                    class="text-sm font-medium"
                                >
                                    Pengaturan Landing Page
                                </NavLink>
                                <NavLink
                                    :href="route('admin.services.index')"
                                    :active="route().current('admin.services.*')"
                                    class="text-sm font-medium"
                                >
                                    5 Layanan
                                </NavLink>
                                <NavLink
                                    :href="route('admin.portfolios.index')"
                                    :active="route().current('admin.portfolios.*')"
                                    class="text-sm font-medium"
                                >
                                    Portofolio
                                </NavLink>
                                <NavLink
                                    :href="route('admin.faqs.index')"
                                    :active="route().current('admin.faqs.*')"
                                    class="text-sm font-medium"
                                >
                                    FAQ
                                </NavLink>
                            </div>
                        </div>

                        <div class="hidden sm:ms-6 sm:flex sm:items-center gap-3">
                            <!-- Public Site Link -->
                            <a
                                href="/"
                                target="_blank"
                                class="inline-flex items-center gap-1.5 rounded-lg border border-slate-200 bg-white px-3 py-1.5 text-xs font-semibold text-slate-700 hover:border-orange-200 hover:text-orange-600 transition"
                            >
                                <span>Lihat Website</span>
                                <ExternalLink class="h-3.5 w-3.5" />
                            </a>

                            <!-- Settings Dropdown -->
                            <div class="relative ms-2">
                                <Dropdown align="right" width="48">
                                    <template #trigger>
                                        <span class="inline-flex rounded-md">
                                            <button
                                                type="button"
                                                class="inline-flex items-center gap-2 rounded-xl border border-slate-200 bg-white px-3 py-1.5 text-sm font-medium text-slate-700 hover:bg-slate-50 transition"
                                            >
                                                <span>{{ $page.props.auth.user.name }}</span>
                                                <svg
                                                    class="h-4 w-4 text-slate-400"
                                                    xmlns="http://www.w3.org/2000/svg"
                                                    viewBox="0 0 20 20"
                                                    fill="currentColor"
                                                >
                                                    <path
                                                        fill-rule="evenodd"
                                                        d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                                        clip-rule="evenodd"
                                                    />
                                                </svg>
                                            </button>
                                        </span>
                                    </template>

                                    <template #content>
                                        <DropdownLink :href="route('profile.edit')">
                                            Profil Akun
                                        </DropdownLink>
                                        <DropdownLink :href="route('logout')" method="post" as="button">
                                            Keluar (Logout)
                                        </DropdownLink>
                                    </template>
                                </Dropdown>
                            </div>
                        </div>

                        <!-- Mobile Hamburger Button -->
                        <div class="-me-2 flex items-center sm:hidden">
                            <button
                                @click="showingNavigationDropdown = !showingNavigationDropdown"
                                class="inline-flex items-center justify-center rounded-lg p-2 text-slate-500 hover:bg-slate-100"
                            >
                                <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                                    <path
                                        :class="{ hidden: showingNavigationDropdown, 'inline-flex': !showingNavigationDropdown }"
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M4 6h16M4 12h16M4 18h16"
                                    />
                                    <path
                                        :class="{ hidden: !showingNavigationDropdown, 'inline-flex': showingNavigationDropdown }"
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M6 18L18 6M6 6l12 12"
                                    />
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Responsive Navigation Menu -->
                <div
                    :class="{ block: showingNavigationDropdown, hidden: !showingNavigationDropdown }"
                    class="sm:hidden border-t border-slate-100 bg-white px-4 pt-2 pb-3"
                >
                    <div class="space-y-1">
                        <ResponsiveNavLink :href="route('admin.dashboard')" :active="route().current('admin.dashboard')">
                            Dashboard
                        </ResponsiveNavLink>
                        <ResponsiveNavLink :href="route('admin.settings.index')" :active="route().current('admin.settings.*')">
                            Pengaturan Landing Page
                        </ResponsiveNavLink>
                        <ResponsiveNavLink :href="route('admin.services.index')" :active="route().current('admin.services.*')">
                            5 Layanan
                        </ResponsiveNavLink>
                        <ResponsiveNavLink :href="route('admin.portfolios.index')" :active="route().current('admin.portfolios.*')">
                            Portofolio
                        </ResponsiveNavLink>
                        <ResponsiveNavLink :href="route('admin.faqs.index')" :active="route().current('admin.faqs.*')">
                            FAQ
                        </ResponsiveNavLink>
                        <a href="/" target="_blank" class="block py-2 px-3 text-base font-medium text-orange-600">
                            Lihat Website Publik &rarr;
                        </a>
                    </div>

                    <!-- Responsive Settings Options -->
                    <div class="border-t border-slate-200 pt-4 pb-1">
                        <div class="px-4">
                            <div class="text-base font-medium text-slate-800">
                                {{ $page.props.auth.user.name }}
                            </div>
                            <div class="text-sm font-medium text-slate-500">
                                {{ $page.props.auth.user.email }}
                            </div>
                        </div>

                        <div class="mt-3 space-y-1">
                            <ResponsiveNavLink :href="route('profile.edit')"> Profil Akun </ResponsiveNavLink>
                            <ResponsiveNavLink :href="route('logout')" method="post" as="button">
                                Keluar (Logout)
                            </ResponsiveNavLink>
                        </div>
                    </div>
                </div>
            </nav>

            <!-- Page Heading -->
            <header class="bg-white border-b border-slate-200/80" v-if="$slots.header">
                <div class="mx-auto max-w-7xl py-6 px-4 sm:px-6 lg:px-8">
                    <slot name="header" />
                </div>
            </header>

            <!-- Page Content -->
            <main>
                <slot />
            </main>
        </div>
    </div>
</template>
