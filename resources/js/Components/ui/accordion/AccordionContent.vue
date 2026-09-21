<script setup>
import { AccordionContent } from 'radix-vue';
import { cn } from '@/lib/utils';

const props = defineProps({
    asChild: {
        type: Boolean,
        default: false,
    },
    as: {
        type: [String, Object],
        default: 'div',
    },
    class: {
        type: [String, Array, Object],
        default: '',
    },
});
</script>

<template>
    <AccordionContent
        :as="as"
        :as-child="asChild"
        class="overflow-hidden text-sm text-slate-600 transition-all data-[state=closed]:animate-accordion-up data-[state=open]:animate-accordion-down"
        :class="props.class"
    >
        <div class="pb-4 pt-0 leading-relaxed">
            <slot />
        </div>
    </AccordionContent>
</template>
