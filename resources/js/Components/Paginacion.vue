<script setup>
import {Link} from "@inertiajs/vue3";

defineProps(['obras']);
</script>

<template>
    <div class="mb-2" v-if="obras.links.length > 3">
        <div class="flex flex-wrap">
            <template v-for="(link) in obras.links">
                <div v-if="link.url === null" class="mr-1 mb-1 px-4 py-3 leading-4 text-gray-500"
                     v-html="link.label"/>
                <Link v-else
                      class="mr-1 mb-1 px-4 py-3 leading-4 hover:bg-white text-base "
                      :class="{ 'text-white bg-flamingo border-flamingo border-solid border-1 hover:text-black': link.active }" :href="link.url" v-html="link.label" preserve-state/>
            </template>
        </div>
    </div>
</template>
