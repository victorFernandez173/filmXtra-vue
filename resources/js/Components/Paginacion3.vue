<script setup>
import { Link } from "@inertiajs/vue3";

const props = defineProps({
    'datos' : Object
});
</script>

<template>
    <div class="mb-2" v-if="datos.links.length > 3">
        <div class="flex flex-wrap">
            <template v-for="(link) in datos.links">
                <div v-if="link.url === null" class="m-0 sm:mr-1 sm:mb-1 px-1 py-1.5 sm:px-4 sm:py-3 leading-4 text-gray-500 text-sm sm:text-base" v-html="link.label"/>
                <Link
                    v-if="((link.label.includes('Anterior') || link.label.includes('Prev')) && datos.current_page !== 1) || ((link.label.includes('Siguiente') || link.label.includes('Next')) && datos.current_page !== datos.last_page) || link.label === datos.current_page.toString() || (datos.current_page - parseInt(link.label) <= 1 && parseInt(link.label) < datos.current_page) || (parseInt(link.label) - datos.current_page <= 1 && parseInt(link.label) > datos.current_page)"
                    as="button"
                    class="m-0 sm:mr-1 sm:mb-1 px-2.5 py-1.5 sm:px-4 sm:py-3 leading-4 hover:bg-flamingo text-sm sm:text-base"
                    :class="{ 'text-white bg-flamingo border-flamingo border-solid border-1 hover:text-black': link.active }"
                    :href="link.url"
                    v-html="(parseInt(link.label) > 1 && parseInt(link.label) < parseInt(datos.last_page) && parseInt(link.label) !== datos.current_page) ? link.label > datos.current_page ? link.label+'...' : '...'+link.label : link.label"
                    :disabled="link.active"
                    preserve-state
                />
            </template>
        </div>
    </div>
</template>
