<script>
import LayoutPrincipal from "../Layouts/LayoutPrincipal.vue";
import { getActiveLanguage } from "laravel-vue-i18n";

export default {
    layout: LayoutPrincipal,
}
</script>

<script setup>
import { Head, Link, useForm} from "@inertiajs/vue3";
import Estrellitas from "../Components/Estrellitas.vue";
import SelectRango from "../Components/SelectRango.vue";
import PaginacionSimple from "../Components/PaginacionSimple.vue";
import Critica from "@/Components/Critica.vue";

const props = defineProps({
    'obra' : Object,
    'mediaEvaluaciones' : Object,
    'criticas' : Object,
    'nGifs' : Number,
    'evaluacionUsuario' : Array,
    'criticaUsuario' : Array,
});

// Form Crítica
const form = useForm({
    obra_id: props.obra.id,
    critica: props.criticaUsuario[0] ? props.criticaUsuario[0] : '',
});
// Form Evaluación
const form2 = useForm({
    obra_id: props.obra.id,
    evaluacion: '',
});
</script>

<template>
    <Head>
        <title>
            Valoraciones: {{ getActiveLanguage() === 'es' ? obra.titulo : obra.titulo_original }}
        </title>
        <meta name="description" content="Ficha valoraciones obra">
    </Head>
    <div class="container mx-auto mt-10 mb-10">
        <h1 class="text-center font-bold text-flamingo text-3xl w-11/12 mx-auto">
            {{ getActiveLanguage() === 'es' ? obra.titulo : obra.titulo_original }}
        </h1>

        <div class="grid grid-cols-1 lg:grid-cols-4 mt-10">
            <!--Poster y boton ficha obra-->
            <div>
                <div class="w-full flex justify-center flex-wrap items-center">
                    <img class="w-[95%] lg:w-[98%]" :src="'/posters/thumbnails/tn_' + obra.poster.ruta" :alt="obra.poster.alt">
                    <Estrellitas class="w-full mb-1" :mediaEvaluaciones="mediaEvaluaciones.evaluaciones_avg_evaluacion" :obra="obra"/>
                    <p class="text-black text-center"> &nbsp;&nbsp;
                        {{ parseFloat(mediaEvaluaciones.evaluaciones_avg_evaluacion).toFixed(1) }}/10 ({{ obra.evaluaciones.length }}
                    </p>
                    <svg class="w-5 h-5 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                        <path fill-rule="evenodd" d="M12 4a4 4 0 1 0 0 8 4 4 0 0 0 0-8Zm-2 9a4 4 0 0 0-4 4v1a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2v-1a4 4 0 0 0-4-4h-4Z" clip-rule="evenodd"/>
                    </svg>
                    )
                </div>
                <div class="flex justify-center mx-auto w-11/12 lg:w-full mb-7 lg:mb-0">
                    <Link :href="route('obra', obra.titulo_slug)" class="text-black hover:bg-black hover:text-flamingo bg-flamingo focus:bg-flamingo focus:text-black focus:ring-flamingo focus:border-flamingo focus:outline-none font-bold text-sm px-5 py-2.5 mt-5 text-center">
                        &larr; {{ $t('ficha_valoraciones.ficha') }} {{ getActiveLanguage() === 'es' ? obra.titulo : obra.titulo_original }}
                    </Link>
                </div>
            </div>

            <!--Criticas-->
            <div class="w-[95%] mx-auto lg:mr-0 col-span-3 flex flex-wrap bg-flamingo">
                <div class="w-full p-6 md:p-10">
                    <!--Titulo usuarios-->
                    <div class="w-full">
                        <h5 class="font-bold text-center text-lg md:text-xl mt-2 mb-6">
                            {{ $t('ficha_valoraciones.subtitulo') }}
                        </h5>
                    </div>
                    <!--Críticas usuarios-->
                    <div v-for="(critica, indice) in criticas.data" class="w-full px-3 md:px-6 text-white">
                        <critica :critica="critica" :indice="indice" />
                    </div>
                </div>
                <div class="w-full flex justify-center self-end mt-5">
                    <paginacion-simple :datos="criticas" />
                </div>
            </div>

            <!-- Sección formularios container-->
            <div class="w-[95%] lg:w-full mx-auto col-span-1 lg:col-span-4 mt-5 bg-flamingo container">
                <div v-if="$page.props.auth.user" class="w-full grid grid-cols-1 md:grid-cols-12 lg:grid-cols-12 p-3">
                    <!-- Form Evaluaciones -->
                    <form @submit.prevent="form2.post(route('evaluar'),
                    {
                                preserveScroll: true,
                                only: ['mediaEvaluaciones', 'evaluacionUsuario', 'obra']
                           }
                    )"
                    class="col-span-1 md:col-span-3 lg:col-span-2 flex justify-center flex-wrap p-1 border-b md:border-r md:border-b-0 content-center">
                        <div class="w-full text-center">
                            <label class="font-bold text-lg md:text-xl text-black">{{ $t('ficha_valoraciones.formularios.evaluar') }} {{ getActiveLanguage() === 'es' ? obra.titulo : obra.titulo_original }}:</label>
                        </div>
                        <p v-if="evaluacionUsuario.length > 0" class="text-center text-xs">
                            ({{ $t('ficha_valoraciones.formularios.ya_evaluada') }})
                        </p>
                        <div class="w-full">
                            <select-rango class="w-2/5 sm:w-1/4 md:w-3/4 text-center" :limite="11" :valor="evaluacionUsuario.length > 0 ? evaluacionUsuario.toString() : (getActiveLanguage() === 'es' ? 'Nota' : 'Score')" @emision="(e) => form2.evaluacion = e" />
                        </div>
                        <div class="w-full text-center">
                            <p class="text-yellow-300 w-2/5 sm:w-1/4 md:w-3/4 text-center m-auto">
                                {{ $page.props.errors['evaluacion'] }}
                            </p>
                            <p v-if="form2.recentlySuccessful">
                                {{ $t('ficha_valoraciones.formularios.evaluacion_exitosa') }}
                            </p>
                        </div>
                        <div class="w-full text-center">
                            <button class="w-2/5 sm:w-1/4 md:w-3/4 text-flamingo bg-white hover:bg-black font-bold text-sm px-5 py-2.5 my-2 text-center">
                                {{ $t('ficha_valoraciones.formularios.evaluar') }}
                            </button>
                        </div>
                    </form>
                    <!-- Form Críticas -->
                    <div class="col-span-1 md:col-span-9 lg:col-span-10 p-1 lg:ml-1 flex justify-center flex-wrap">
                        <label class="w-full text-center font-bold text-lg md:text-xl mt-3 text-black">
                            {{ $t('ficha_valoraciones.formularios.criticar') }} {{ getActiveLanguage() === 'es' ? obra.titulo : obra.titulo_original }}
                            <span :class="[form.critica.length > 5000 ? 'text-yellow-300 font-bold' : 'text-black']">
                                ({{ form.critica.length }}/5000 {{ $t('ficha_valoraciones.formularios.caracteres') }}){{ form.critica.length > 5000 ? ' Máximo de caracteres sobrepasado' : '' }}
                            </span>
                        </label>
                        <p v-if="criticaUsuario.length > 0" class="text-center text-xs">({{ $t('ficha_valoraciones.formularios.ya_criticada') }})</p>
                        <form @submit.prevent="form.post(route('criticar'),
                        {
                                    preserveScroll: true,
                                    only: ['criticaUsuario', 'criticas']
                                }
                        )"
                        class="w-11/12 text-center">
                            <textarea class="w-full h-[200px] m-1 focus:border-black focus:border-[3px] focus:ring-0" v-model="form.critica" />
                            <div class="w-full text-center">
                                <p class="text-yellow-300 w-2/5 sm:w-1/4 md:w-3/4 text-center m-auto">
                                    {{ $page.props.errors['critica'] }}
                                </p>
                                <p v-if="form.recentlySuccessful">
                                    {{ $t('ficha_valoraciones.formularios.critica_exitosa') }}
                                </p>
                            </div>
                            <button class="w-2/5 text-flamingo bg-white hover:bg-black focus:bg-white focus:ring-flamingo focus:text-flamingo focus:outline-none font-bold text-sm px-5 py-2.5 my-2 text-center">
                                {{ $t('ficha_valoraciones.formularios.criticar') }}
                            </button>
                        </form>

                    </div>
                </div>
                <div v-else class="grid grid-cols-1 p-10 font-bold text-white text-lg md:text-2xl lg:text-3xl text-center">
                    {{ $t('ficha_valoraciones.control1') }} "{{ getActiveLanguage() === 'es' ? obra.titulo : obra.titulo_original }}", {{ $t('ficha_valoraciones.control2') }}
                    <Link as="button" :href="route('login')" class="m-auto mt-5 text-flamingo bg-white hover:bg-black focus:bg-white focus:ring-flamingo focus:text-flamingo focus:outline-none font-bold text-sm px-5 py-2.5 my-2 text-center">
                        {{ $t('ficha_valoraciones.boton_login') }}
                    </Link>
                    <img src="/images/logo.png" class="w-40 pt-5 m-auto" alt="Logo de la web">
                </div>
            </div>
        </div>
    </div>
</template>
