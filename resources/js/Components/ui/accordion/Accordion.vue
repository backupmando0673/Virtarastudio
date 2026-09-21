<script setup>
import { AccordionRoot, useForwardPropsEmits } from 'radix-vue';

const props = defineProps({
    collapsible: {
        type: Boolean,
        default: true,
    },
    disabled: {
        type: Boolean,
        default: false,
    },
    dir: {
        type: String,
        default: 'ltr',
    },
    orientation: {
        type: String,
        default: 'vertical',
    },
    asChild: {
        type: Boolean,
        default: false,
    },
    as: {
        type: [String, Object],
        default: 'div',
    },
    type: {
        type: String,
        default: 'single',
    },
    defaultValue: {
        type: [String, Array],
        default: undefined,
    },
    modelValue: {
        type: [String, Array],
        default: undefined,
    },
});

const emits = defineEmits(['update:modelValue']);
const forwarded = useForwardPropsEmits(props, emits);
</script>

<template>
    <AccordionRoot v-bind="forwarded">
        <slot />
    </AccordionRoot>
</template>
