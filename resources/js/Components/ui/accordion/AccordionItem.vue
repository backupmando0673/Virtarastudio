<script setup>
import { AccordionItem, useForwardProps } from 'radix-vue';
import { cn } from '@/lib/utils';

const props = defineProps({
    disabled: {
        type: Boolean,
        default: false,
    },
    value: {
        type: String,
        required: true,
    },
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

const forwarded = useForwardProps(props);
</script>

<template>
    <AccordionItem
        v-bind="forwarded"
        :class="cn('border-b border-slate-200/80', props.class)"
    >
        <slot />
    </AccordionItem>
</template>
