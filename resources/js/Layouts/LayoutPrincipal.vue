<script setup>
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
        <!-- Contenido del layout -->
    </slot>

    <!-- Pie de pagina -->
    <Footer/>
</template>
