<script setup>
import { cn } from '@/lib/utils';

const props = defineProps({
    class: {
        type: [String, Array, Object],
        default: '',
    },
});
</script>

<template>
    <p :class="cn('text-sm text-slate-600 leading-relaxed', props.class)">
        <slot />
    </p>
</template>
