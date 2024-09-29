<script setup>
import PrimaryButton from '@/Components/PrimaryButton.vue';
import SelectConsulta from "./SelectConsulta.vue";
import {useForm} from '@inertiajs/vue3';
import SelectRangoAnno from "./SelectRangoAnno.vue";
import SecondaryButton from "@/Components/SecondaryButton.vue";

const props = defineProps({
    'paises' : Array,
    'generos' : Array,
    'pionera' : Number,
    'filtros' : Object
});

// Formulario
const form = useForm({
    genero: '',
    pais: '',
    desde: '',
    hasta: '',
    classFiltrado : route().params.classFiltrado ? route().params.classFiltrado : 'hidden'
});
// Entrega del formulario
const submit = () => {
    form.get(route('top'),
        {
            preserveState: false,
            preserveScroll: true
        }
    );
};

const resetearFiltros = () => {
    form.reset('genero', 'pais', 'desde', 'hasta');
    submit()
}

// Calculamos el rango de años a partir de la pelicula más vieja
const rangoAnnos = parseInt((new Date().getFullYear()).toString()) - parseInt(props.pionera) + 1;
const annoActual = (new Date().getFullYear() + 1);

const toggleFiltrado = () => {
    form.classFiltrado === 'hidden' ? form.classFiltrado = 'flex flex-col' : form.classFiltrado = 'hidden';
};
</script>

<template>
    <div class="flex justify-center sm:hidden mb-3">
        <secondary-button @click="toggleFiltrado">
            {{ form.classFiltrado === 'hidden' ? 'Filtrar' : 'Ocultar' }}
        </secondary-button>
    </div>
    <form @submit.prevent="submit" class="m-auto sm:flex sm:flex-col" :class="`${form.classFiltrado}`">
        <div class="m-auto grid grid-cols-1 md:grid-cols-2 xl:grid-cols-5 hover:[&>div>select]:cursor-pointer">
            <!-- Selects-->
            <div>
                <select-consulta :consulta="generos" :filtro="filtros.genero" @emision="(e) => form.genero = e">
                    {{ $t('form_filtrado.genero') }}
                </select-consulta>
            </div>
            <div>
                <select-consulta :consulta="paises" :filtro="filtros.pais" @emision="(e) => form.pais = e">
                    {{ $t('form_filtrado.pais') }}
                </select-consulta>
            </div>
            <div>
                <select-rango-anno :filtro="filtros.desde" :rango-annos="rangoAnnos" :limite-superior="annoActual" @emision="(e) => form.desde = e">
                    {{ $t('form_filtrado.desde') }}
                </select-rango-anno>
            </div>
            <div>
                <select-rango-anno :filtro="filtros.hasta" :rango-annos="rangoAnnos" :limite-superior="annoActual" @emision="(e) => form.hasta = e">
                    {{ $t('form_filtrado.hasta') }}
                </select-rango-anno>
            </div>

            <!-- Botones -->
            <div class="flex pt-2.5 pb-3 md:col-span-2 xl:col-span-1">
                <primary-button :disabled="form.processing" :class="{ 'opacity-25': form.processing }">
                    {{ $t('form_filtrado.filtra') }}
                </primary-button>
                <secondary-button @click="resetearFiltros">
                    {{ $t('form_filtrado.reset') }}
                </secondary-button>
            </div>
        </div>

        <!-- Mensaje de filtrado condicionado en funcion de parámetros del formulario -->
        <p v-if="filtros.genero || filtros.pais || filtros.desde || filtros.hasta" class="w-full text-center mt-1">
            {{ $t('top_filmxtra.filtros') }}&rarr;
            <!-- Si hay genero (filtros[0])...se añade coma, y así sucesivamente ... -->
            {{ filtros.genero === '' ? '' : `${$t('form_filtrado.genero')}: ${filtros.genero}`}}{{(filtros.genero !== '' && filtros.pais !== '') ? ', ' : ''}}{{ filtros.pais === '' ? '' : ` ${$t('form_filtrado.pais')}: ${filtros.pais}`}}{{(filtros.pais !== '' && filtros.desde !== '') ? ', ' : ''}}{{ filtros.desde === '' ? '' : ` ${$t('form_filtrado.desde')}: ${filtros.desde}`}}{{(filtros.desde !== '' && filtros.hasta !== '') ? ', ' : ''}}{{ filtros.hasta === '' ? '' : ` ${$t('form_filtrado.hasta')}: ${filtros.hasta}`}}{{ filtros.genero !== null ?  '.' : ''}}
        </p>
        <div v-else class="w-full text-center">
            <p>
                {{ $t('top_filmxtra.sin_filtros') }}
            </p>
        </div>
    </form>
</template>
