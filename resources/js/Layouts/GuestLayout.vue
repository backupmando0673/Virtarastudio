<script setup>
import { Link } from '@inertiajs/vue3';
import { Sparkles } from '@lucide/vue';
</script>

<template>
    <div
        class="flex min-h-screen flex-col items-center bg-slate-50 pt-10 sm:justify-center sm:pt-0 font-sans"
    >
        <div>
            <Link href="/" class="flex flex-col items-center gap-2 group">
                <div
                    class="flex h-12 w-12 items-center justify-center rounded-2xl bg-gradient-to-tr from-blue-600 to-amber-400 text-white shadow-md shadow-blue-500/25 transition-transform duration-200 group-hover:scale-105"
                >
                    <Sparkles class="h-6 w-6" />
                </div>
                <div class="text-2xl font-extrabold tracking-tight">
                    <span class="text-slate-900">Virtara</span>
                    <span class="text-amber-500">studio</span>
                </div>
                <span class="text-xs font-semibold text-slate-400 uppercase tracking-widest">
                    Area Akses Administrator
                </span>
            </Link>
        </div>

        <div
            class="mt-6 w-full overflow-hidden bg-white px-8 py-8 shadow-xl border border-slate-200/80 sm:max-w-md sm:rounded-2xl"
        >
            <slot />
        </div>
    </div>
</template>
