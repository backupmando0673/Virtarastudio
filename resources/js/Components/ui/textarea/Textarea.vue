<script setup>
import { useVModel } from '@vueuse/core';
import { cn } from '@/lib/utils';

const props = defineProps({
    defaultValue: {
        type: [String, Number],
        default: undefined,
    },
    modelValue: {
        type: [String, Number],
        default: undefined,
    },
    class: {
        type: [String, Array, Object],
        default: '',
    },
});

const emits = defineEmits(['update:modelValue']);
const modelValue = useVModel(props, 'modelValue', emits, {
    passive: true,
    defaultValue: props.defaultValue,
});
</script>

<template>
    <textarea
        v-model="modelValue"
        :class="
            cn(
                'flex min-h-[80px] w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-900 ring-offset-white placeholder:text-slate-400 focus-visible:outline-none focus-visible:border-orange-500 focus-visible:ring-4 focus-visible:ring-orange-500/10 disabled:cursor-not-allowed disabled:opacity-50 transition-all duration-150',
                props.class
            )
        "
    />
</template>
