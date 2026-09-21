<script setup>
import { badgeVariants } from './index';
import { cn } from '@/lib/utils';

const props = defineProps({
    variant: {
        type: String,
        default: 'default',
    },
    class: {
        type: [String, Array, Object],
        default: '',
    },
});
</script>

<template>
    <div :class="cn(badgeVariants({ variant }), props.class)">
        <slot />
    </div>
</template>
