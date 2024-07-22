<script setup>
import { onMounted, ref } from 'vue';

const modelValue = defineModel();

const input = ref(null);

onMounted(() => {
    if (input.value.hasAttribute('autofocus')) {
        input.value.focus();
    }
});

defineExpose({ focus: () => input.value.focus() });
</script>

<template>
    <input
        class="border-[2px] border-gray-300 focus:ring-flamingo rounded-md shadow-sm focus:border-[2px] focus:border-flamingo"
        :value="modelValue"
        @input="$emit('update:modelValue', $event.target.value)"
        ref="input"
    />
</template>
