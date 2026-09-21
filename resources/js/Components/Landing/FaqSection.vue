<script setup>
import {
    Accordion,
    AccordionItem,
    AccordionTrigger,
    AccordionContent,
} from '@/Components/ui/accordion';
import { Sparkles, HelpCircle } from '@lucide/vue';

const props = defineProps({
    faqs: {
        type: Array,
        default: () => [],
    },
});
</script>

<template>
    <section id="faq" class="relative bg-white py-20 md:py-28">
        <div class="mx-auto max-w-4xl px-4 sm:px-6 lg:px-8">
            <div class="mx-auto max-w-3xl text-center">
                <div class="inline-flex items-center gap-2 rounded-full bg-orange-100/80 px-3.5 py-1 text-xs font-semibold text-orange-700">
                    <Sparkles class="h-3.5 w-3.5 text-orange-500" />
                    <span>Pertanyaan Umum</span>
                </div>
                <h2 class="mt-4 text-3xl font-extrabold tracking-tight text-slate-900 sm:text-4xl">
                    Kerap Ditanyakan (FAQ)
                </h2>
                <p class="mt-4 text-base text-slate-600 sm:text-lg leading-relaxed">
                    Jawaban atas beberapa pertanyaan yang paling sering diajukan seputar alur kerja, harga, dan teknologi di Virtarastudio.
                </p>
            </div>

            <div class="mt-12">
                <Accordion type="single" collapsible class="w-full space-y-4">
                    <AccordionItem
                        v-for="faq in faqs"
                        :key="faq.id"
                        :value="`faq-${faq.id}`"
                        class="rounded-2xl border border-slate-200/90 bg-white px-6 py-1 shadow-sm transition-all hover:border-orange-200"
                    >
                        <AccordionTrigger class="text-base font-semibold text-slate-900 hover:text-orange-600">
                            {{ faq.question }}
                        </AccordionTrigger>
                        <AccordionContent class="text-sm text-slate-600 leading-relaxed pt-1 pb-4">
                            {{ faq.answer }}
                        </AccordionContent>
                    </AccordionItem>
                </Accordion>
            </div>
        </div>
    </section>
</template>
