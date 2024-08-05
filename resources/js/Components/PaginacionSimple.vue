<script setup>
import {Link} from "@inertiajs/vue3";

defineProps(['obras']);
</script>

<template>
    <nav>
        <ul class="pagination">
            <li v-if="obras.current_page === 1" disabled="true">Anterior dis
            </li>
            <li v-else>
                <Link :href="obras.prev_page_url" v-html="'Anterior en'" />
            </li>

            <li v-if="obras.next_page_url">
                <Link :href="obras.next_page_url" v-html="'Siguiente en'" />
            </li>
            <li v-else disabled="true">Siguiente dis</li>
        </ul>
    </nav>
</template>
