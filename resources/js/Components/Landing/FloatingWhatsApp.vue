<script setup>
import { MessageCircle } from '@lucide/vue';

const props = defineProps({
    whatsappUrl: {
        type: String,
        default: '#',
    },
});
</script>

<template>
    <div class="fixed bottom-6 right-6 z-50 flex items-center group">
        <!-- Floating Tooltip badge -->
        <span
            class="mr-3 hidden rounded-xl bg-slate-900/90 px-3.5 py-1.5 text-xs font-semibold text-white shadow-xl backdrop-blur-sm sm:inline-block transition-all duration-200 group-hover:scale-105"
        >
            Konsultasi Gratis via WhatsApp 👋
        </span>

        <!-- Floating Button -->
        <a
            :href="whatsappUrl"
            target="_blank"
            rel="noopener noreferrer"
            class="relative flex h-14 w-14 items-center justify-center rounded-full bg-[#25D366] text-white shadow-xl shadow-green-600/30 transition-all duration-300 hover:scale-110 hover:bg-[#20ba59] active:scale-95"
            aria-label="Hubungi kami melalui WhatsApp"
        >
            <!-- Pulsing Ring -->
            <span
                class="absolute -inset-1 -z-10 animate-ping rounded-full bg-[#25D366] opacity-60 duration-1000"
            />
            <MessageCircle class="h-7 w-7" />
        </a>
    </div>
</template>
