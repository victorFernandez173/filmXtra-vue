<!--script independiente sin "setup" para la carga del LayoutPrincipal como layout persistente-->
<script>
import LayoutPrincipal from "../Layouts/LayoutPrincipal.vue";

export default {
    layout: LayoutPrincipal,
}
</script>

<!--script estandar para lo habitual-->
<script setup>
import { Head } from "@inertiajs/vue3";
import BarraLateral from "../Components/BarraLateral.vue";
import FormularioFiltrado from "../Components/FormularioFiltrado.vue";
import FichaPeli from "@/Components/FichaPeli.vue";
import { useIntersectionObserver } from '@vueuse/core';
import { ref } from "vue";
import axios from "axios";

const props = defineProps(['obras', 'paises', 'generos', 'filtros', 'pionera']);

const gatilloScroll = ref(null);

// Para controllar con vue useIntersectionObserver el scrolling infinito
const { stop } = useIntersectionObserver(
    // Elemento observado para actuar
    gatilloScroll,
    ([{ isIntersecting }]) => {
        // Si llegamos al elemento
        if (isIntersecting) {
            // Clonamos el objeto para que pueda ser reutilizado sin errores
            const obrasClonadas = JSON.parse(JSON.stringify(props.obras));
            // Axios con url basica, parametros y cursor para especificar datos a pasar
            axios.get(`${props.obras.path}?cursor=${props.obras.next_cursor}${props.filtros.pais?'&pais='+props.filtros.pais:''}${props.filtros.genero?'&genero='+props.filtros.genero:''}${props.filtros.desde?'&desde='+props.filtros.desde:''}${props.filtros.hasta?'&hasta='+props.filtros.hasta:''}`).then((response) => {
                // En caso de que haya que paginar
                if(response.data.tienePaginas) {
                    props.obras.data = [...obrasClonadas.data, ...response.data.obras.data];
                    props.obras.prev_cursor = response.data.obras.prev_cursor;
                    props.obras.next_cursor = response.data.obras.next_cursor;
                }
                // Si response no tiene next_cursor, no hay más datos, se para el scrolling
                if (!response.data.obras.next_cursor) {
                    stop();
                }
            })
        }
    }
);
</script>

<template>
    <Head>
        <title>
            Top FilmXtra
        </title>
        <meta name="filter" content="Página top filmXtra">
    </Head>
    <div class="flex content-stretch">
        <!-- Barra lateral -->
        <div class="hidden lg:block lg:w-[13vw] xl:w-[11vw] 2xl:w-[8vw]">
            <barra-lateral/>
        </div>
        <!-- Contenido -->
        <div class="lg:w-[87vw] xl:w-[89vw] 2xl:w-[92vw] mx-auto">
            <!-- Título -->
            <h1 class="w-full mt-2 font-oswald text-center text-5xl h-[8vh] text-flamingo">
                Top FilmXtra
            </h1>
            <!-- Formulario de filtrado -->
            <formulario-filtrado :paises="paises" :generos="generos" :pionera="pionera" :filtros="filtros"  />
            <!-- Mensaje de filtrado condicionado en funcion de parámetros del formulario -->
            <p v-if="filtros.genero || filtros.pais || filtros.desde || filtros.hasta" class="w-full text-center mt-1">
                Filtros&rarr; &nbsp;
                <!-- Si hay genero (filtros[0])... -->
                {{ filtros.genero === '' ? '' : `género: ${filtros.genero}`  }}
                <!--se añade coma, y así sucesivamente ... -->
                {{(filtros.genero !== '' && filtros.pais !== '') ? ', &nbsp;' : ''}}
                {{ filtros.pais === '' ? '' : ` país: ${filtros.pais}`   }}
                {{(filtros.pais !== '' && filtros.desde !== '') ? ', &nbsp;' : ''}}
                {{ filtros.desde === '' ? '' : ` desde: ${filtros.desde}`  }}
                {{(filtros.desde !== '' && filtros.hasta !== '') ? ', &nbsp;' : ''}}
                {{ filtros.hasta === '' ? '' : ` hasta: ${filtros.hasta}`  }}
                {{ filtros.genero !== null ?  '.' : '' }}
            </p>
            <div v-else class="w-full text-center">
                <p>Sin filtros</p>
            </div>
            <!-- Seccion Principal con las fichas -->
            <div class="container grid grid-cols-1 m-auto my-8">
                <ficha-peli v-for="obra in obras.data" :obra="obra" :info="true" />
            </div>
            <!-- Para el infinite scrolling -->
            <div ref="gatilloScroll" />
        </div>
    </div>
</template>
