<script setup>
const props = defineProps({
    'avgEvaluaciones' : String
});
</script>

<template>
    <h3 class="font-bold text-flamingo">{{ parseFloat(avgEvaluaciones).toFixed(1) }}</h3>
</template>
