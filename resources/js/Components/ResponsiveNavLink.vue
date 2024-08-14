<script setup>
import { computed } from 'vue';
import { Link } from '@inertiajs/vue3';

const props = defineProps({
    href: {
        type: String,
        required: true,
    },
    dark: {
        type: Boolean,
        required: false,
        default: false,
    },
    elegido: {
        type: String,
        required: false,
    },
});

const classes = computed(() =>
    props.dark ? 'block w-full' + props.elegido : 'block w-full ' + props.elegido
);
</script>

<template>
    <Link :href="href" :class="classes">
        <slot />
    </Link>
</template>
