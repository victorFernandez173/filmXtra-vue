<script setup>
const props = defineProps(['obra']);
</script>

<template>
    <h3 class="font-bold text-flamingo">{{ parseFloat(obra['nota_media']).toFixed(1) }}</h3>
</template>
