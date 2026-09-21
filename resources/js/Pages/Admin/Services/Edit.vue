<script setup>
import Form from './Form.vue';

defineProps({
    service: {
        type: Object,
        default: null,
    },
});
</script>

<template>
    <Form :service="service" />
</template>
