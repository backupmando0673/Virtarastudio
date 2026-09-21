<script setup>
import { AccordionHeader, AccordionTrigger } from 'radix-vue';
import { ChevronDown } from '@lucide/vue';
import { cn } from '@/lib/utils';

const props = defineProps({
    asChild: {
        type: Boolean,
        default: false,
    },
    as: {
        type: [String, Object],
        default: 'button',
    },
    class: {
        type: [String, Array, Object],
        default: '',
    },
});
</script>

<template>
    <AccordionHeader class="flex">
        <AccordionTrigger
            :as="as"
            :as-child="asChild"
            :class="
                cn(
                    'flex flex-1 items-center justify-between py-4 text-left font-semibold text-slate-900 transition-all hover:text-orange-600 [&[data-state=open]>svg]:rotate-180',
                    props.class
                )
            "
        >
            <slot />
            <ChevronDown
                class="h-4 w-4 shrink-0 text-slate-500 transition-transform duration-200"
            />
        </AccordionTrigger>
    </AccordionHeader>
</template>
