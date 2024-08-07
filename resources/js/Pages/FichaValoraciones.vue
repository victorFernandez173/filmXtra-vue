<script>
import LayoutPrincipal from "../Layouts/LayoutPrincipal.vue";

export default {
    layout: LayoutPrincipal,
}
</script>

<script setup>
import {Head, Link, useForm, usePage} from "@inertiajs/vue3";
import Estrellitas from "../Components/Estrellitas.vue";
import SelectRango from "../Components/SelectRango.vue";
import PaginacionSimple from "../Components/PaginacionSimple.vue";
import Critica from "@/Components/Critica.vue";

const page = usePage();
const props = defineProps(['obra', 'mediaEvaluaciones', 'criticas', 'nGifs', 'evaluacionUsuario', 'criticaUsuario']);

// Form Crítica
const form = useForm({
    obra_id: page.props.obra.id,
    critica: page.props.criticaUsuario[0] ? page.props.criticaUsuario[0] : '',
});
// Form Evaluación
const form2 = useForm({
    obra_id: page.props.obra.id,
    evaluacion: '',
});
</script>

<template>
    <Head>
        <title>Valoraciones: {{ obra.titulo }}</title>
        <meta name="description" content="Ficha valoraciones obra">
    </Head>
    <div class="container mx-auto mt-10 mb-10">
        <h1 class="text-center font-bold text-flamingo text-3xl w-11/12 mx-auto">
            {{ obra.titulo }}
        </h1>

        <div class="grid grid-cols-1 lg:grid-cols-4 mt-10">
            <!--Poster y boton ficha obra-->
            <div>
                <div class="w-full flex justify-center flex-wrap items-center">
                    <img class="w-[95%] lg:w-[98%]" :src="'/posters/' + obra.poster.ruta" :alt="obra.poster.alt">
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
                    <Link :href="route('obra', obra.titulo_slug)" class="text-black hover:text-flamingo bg-flamingo hover:bg-black focus:bg-flamingo focus:ring-flamingo focus:border-flamingo focus:outline-none font-bold text-sm px-5 py-2.5 mt-5 text-center">
                        &larr; Ficha {{ obra.titulo }}
                    </Link>
                </div>
            </div>

            <!--Criticas-->
            <div class="w-[95%] mx-auto lg:mr-0 col-span-3 flex flex-wrap bg-flamingo">
                <div class="w-full p-6 md:p-10">
                    <!--Titulo usuarios-->
                    <div class="w-full">
                        <h5 class="font-bold text-center text-lg md:text-xl mt-2 mb-6">
                            Criticas de usuarios
                        </h5>
                    </div>
                    <!--Críticas usuarios-->
                    <div v-for="(critica, indice) in criticas.data" class="w-full px-3 md:px-6 text-white">
                        <Critica :critica="critica" :indice="indice" />
                    </div>
                </div>
                <div class="w-full flex justify-center self-end mt-5">
                    <PaginacionSimple :datos="criticas" />
                </div>
            </div>

            <!-- Sección formularios container-->
            <div class="w-[95%] lg:w-full mx-auto col-span-1 lg:col-span-4 mt-5 bg-flamingo container">
                <div v-if="$page.props.auth.user" class="grid grid-cols-1 md:grid-cols-12 lg:grid-cols-12 p-1 py-3">
                    <!-- Form Evaluaciones -->
                    <form @submit.prevent="form2.post(route('evaluar'),
                    {
                                preserveScroll: true,
                                only: ['mediaEvaluaciones', 'evaluacionUsuario']
                           }
                    )"
                    class="col-span-1 md:col-span-3 lg:col-span-2 flex justify-center flex-wrap p-1 border-b md:border-r md:border-b-0 content-center">
                        <div class="w-full text-center">
                            <label class="font-bold text-lg md:text-xl text-black">Evaluar {{ obra.titulo}}:</label>
                        </div>
                        <p v-if="evaluacionUsuario.length > 0" class="text-center text-xs">
                            (Ya has evaluado esta película, puedes modificar tu evaluación)
                        </p>
                        <div class="w-full">
                            <SelectRango class="w-2/5 sm:w-1/4 md:w-3/4 text-center" :limite="11" :valor="page.props.evaluacionUsuario.length > 0 ? page.props.evaluacionUsuario.toString() : 'Nota'" @emision="(e) => form2.evaluacion = e" />
                        </div>
                        <div class="w-full text-center">
                            <p class="text-yellow-300 w-2/5 sm:w-1/4 md:w-3/4 text-center m-auto">
                                {{ $page.props.errors['evaluacion'] }}
                            </p>
                            <p v-if="form2.recentlySuccessful">
                                Evaluación exitosa
                            </p>
                        </div>
                        <div class="w-full text-center">
                            <button class="w-2/5 sm:w-1/4 md:w-3/4 text-flamingo bg-white hover:bg-black font-bold text-sm px-5 py-2.5 my-2 text-center">
                                Evaluar
                            </button>
                        </div>
                    </form>
                    <!-- Form Críticas -->
                    <div class="col-span-1 md:col-span-9 lg:col-span-10 p-1 lg:ml-1 flex justify-center flex-wrap">
                        <label class="w-full text-center font-bold text-lg md:text-xl mt-3 text-black">
                            Reseña {{ obra.titulo }}
                            <span :class="[form.critica.length > 5000 ? 'text-yellow-300 font-bold' : 'text-black']">
                                ({{ form.critica.length }}/5000 caracteres){{ form.critica.length > 5000 ? ' Máximo de caracteres sobrepasado' : '' }}
                            </span>
                        </label>
                        <p v-if="criticaUsuario.length > 0" class="text-center text-xs">(Ya has reseñado esta película, puedes modificar tu crítica)</p>
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
                                    Crítica registrada con éxito
                                </p>
                            </div>
                            <button class="w-2/5 text-flamingo bg-white hover:bg-black focus:bg-white focus:ring-flamingo focus:text-flamingo focus:outline-none font-bold text-sm px-5 py-2.5 my-2 text-center">
                                Reseñar
                            </button>
                        </form>

                    </div>
                </div>
                <div v-else class="grid grid-cols-1 p-10 font-bold text-white text-lg md:text-2xl lg:text-3xl text-center">
                    Para poder evaluar o criticar "{{obra.titulo}}", tienes que estar logueado.
                    <Link as="button" :href="route('login')" class="m-auto mt-5 text-flamingo bg-white hover:bg-black focus:bg-white focus:ring-flamingo focus:text-flamingo focus:outline-none font-bold text-sm px-5 py-2.5 my-2 text-center">
                        Loguearse
                    </Link>
                    <img src="/images/logo.png" class="w-40 pt-5 m-auto" alt="Logo de la web">
                </div>
            </div>
        </div>
    </div>
</template>
