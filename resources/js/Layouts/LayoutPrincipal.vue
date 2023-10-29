<script setup>
import {Link} from "@inertiajs/vue3";
import {onMounted} from "vue";
import {initFlowbite} from "flowbite";
import NavBar from "@/Components/NavBar.vue";
import Footer from "@/Components/Footer.vue";

// Para montar componentes Flowbite
onMounted(() => {
    initFlowbite();
})
</script>

<template>
    <!-- Barra de navegacion -->
    <NavBar/>

    <slot>
        <!-- AQUÍ VA EL CONTENIDO QUE SE EL PASA AL LAYOUT    -->
    </slot>

    <!-- Pie de pagina -->
    <Footer/>
</template>
