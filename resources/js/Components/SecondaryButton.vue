<script setup>
defineProps({
    type: {
        type: String,
        default: 'button',
    },
});
</script>

<template>
    <button :type="type" class="m-auto inline-flex items-center px-4 py-2.5 bg-white border-[2px] border-gray-300 font-semibold text-sm text-gray-700 uppercase tracking-widest shadow-sm hover:text-flamingo hover:bg-gray-50 focus:outline-none focus:ring-2 focus:border-[2px] focus:ring-flamingo disabled:opacity-25 transition ease-in-out duration-150">
        <slot />
    </button>
</template>
