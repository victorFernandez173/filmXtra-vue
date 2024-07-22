<script setup>
import { computed } from 'vue';
import { Link } from '@inertiajs/vue3';

// Componente ejemplo para aplicar el modo oscuro, si en revisión no es la mejor opción, simplificar

const props = defineProps({
    href: {
        type: String,
        required: true,
    },
    dark: {
        type: Boolean,
        required: false,
        default: true,
    },
});

const classes = computed(() =>
    props.dark ? 'block w-full' : 'block w-full bg-flamingo'
);
</script>

<template>
    <Link :href="href" :class="classes">
        <slot />
    </Link>
</template>
