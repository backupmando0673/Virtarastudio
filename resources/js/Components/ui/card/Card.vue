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
    <div
        :class="
            cn(
                'rounded-2xl border border-slate-200/90 bg-white text-slate-900 shadow-sm transition-all duration-300',
                props.class
            )
        "
    >
        <slot />
    </div>
</template>
