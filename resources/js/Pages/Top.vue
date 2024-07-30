<!--script independiente sin "setup" para la carga del LayoutPrincipal como layout persistente-->
<script>
import LayoutPrincipal from "../Layouts/LayoutPrincipal.vue";

export default {
    layout: LayoutPrincipal,
}
</script>

<!--script estandar para lo habitual-->
<script setup>
import {Head} from "@inertiajs/vue3";
import BarraLateral from "../Components/BarraLateral.vue";
import FormularioFiltrado from "../Components/FormularioFiltrado.vue";
import Paginacion from "../Components/Paginacion.vue";
import Poster from "../Components/Poster.vue";

defineProps(['obras', 'titulo', 'filtros', 'pionera']);
</script>

<template>
    <Head>
        <title>Top FilmXtra</title>
        <meta name="filter" content="Página top filmXtra">
    </Head>
    <div class="flex content-stretch">
        <!-- Barra lateral -->
        <div class="hidden lg:block lg:w-[13vw] xl:w-[11vw] 2xl:w-[8vw]">
            <BarraLateral/>
        </div>
        <!-- Contenido -->
        <div class="lg:w-[87vw] xl:w-[89vw] 2xl:w-[92vw] mx-auto">
                <!-- Título -->
                <h1 class="w-full mt-2 font-oswald text-center text-5xl h-[8vh] text-flamingo">Top FilmXtra</h1>
                <!-- Formulario de filtrado -->
                <FormularioFiltrado :paises="$page.props.paises" :generos="$page.props.generos" :pionera="$page.props.pionera"  />
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
                <div v-else class="w-full text-center"><p>Sin filtros</p></div>
                <!-- Seccion Principal de contenido -->
                <div class="container grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-3 2xl:grid-cols-4 gap-x-8 gap-y-4 m-auto my-8">
                    <!-- Posters -->
                    <Poster v-for="obra in obras.data" :key="obra.id" :obra="obra" :titulo="`text-sm py-2.5 top-0.5`" :info="true"/>
                </div>
                <!-- Componente para la paginación -->
                <div class="w-full flex mt-8 mb-2">
                    <Paginacion class="mx-auto" :obras="obras"/>
                </div>
            </div>
    </div>
</template>
