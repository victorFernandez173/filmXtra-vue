<script setup>
const props = defineProps(['obra']);
</script>

<template>
    <h3 class="font-medium">({{obra['num_valoraciones']}} valoraciones)</h3>
</template>
