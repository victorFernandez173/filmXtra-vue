<script setup>
const checked = defineModel();
</script>

<template>
    <input
        type="checkbox"
        v-model="checked"
        class="rounded border-gray-300 text-flamingo shadow-sm focus:ring-flamingo"
    />
</template>
