<script setup>
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Head, Link, useForm, usePage } from '@inertiajs/vue3';
import AuthLayout from "@/Layouts/AuthLayout.vue";
import AppLogoIndex from "@/Components/AppLogoIndex.vue";
import { computed, onMounted } from "vue";
import Swal from "sweetalert2";

const props = defineProps({
    'canResetPassword' : Boolean,
    'status': String,
    'nGifs': Number
});
const confirmacionPasswordModificado = computed(() => props.status);

const form = useForm({
    email: '',
    password: '',
    remember: false,
});

const submit = () => {
    form.post(route('login'), {
        onFinish: () => form.reset('password'),
    });
};

onMounted(() => {
    /*Si hay flash de password reset, lanzamos SWAL*/
    if (confirmacionPasswordModificado.value) {
        Swal.fire({
            title: 'Bravo!!',
            text: confirmacionPasswordModificado.value,
            imageUrl: '../gif/' + (Math.floor(Math.random() * usePage().props.nGifs) + 1) + '.gif',
            imageWidth: '80%',
            imageAlt: 'gif de cine',
            showConfirmButton: false,
            position: 'center',
            timer: 4500
        });
    }
});
</script>

<template>
    <Head>
        <title>
            Login
        </title>
        <meta name="description" content="Página de login">
    </Head>
    <auth-layout>
        <div class="flex flex-col items-center justify-center pb-16 min-h-screen lg:py-0">
            <!--logo filmXtra-->
            <div class="mt-8">
                <app-logo-index />
            </div>
            <!--bloque principal-->
            <div class="w-[95%] bg-white shadow md:mt-0 sm:max-w-md xl:p-0">
                <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
                    <h1 class="text-xl font-bold text-gray-900 md:text-2xl">
                        Inicia sesión con tu cuenta
                    </h1>
                    <!--         Formulario           -->
                    <form class="space-y-4 md:space-y-6" @submit.prevent="submit">
                        <!--             Correo electrónico               -->
                        <div>
                            <input-label for="email" value="Correo electrónico" class="block mb-2 text-sm font-medium text-gray-900" />
                            <text-input
                                id="email"
                                placeholder="nombre@correo.com"
                                class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm focus:ring-flamingo  block w-full p-2.5"
                                v-model="form.email"
                                autofocus
                                autocomplete="username"
                            />
                            <input-error class="mt-2" :message="form.errors.email"/>
                        </div>
                        <!--             Contraseña               -->
                        <div>
                            <input-label for="password" value="Contraseña" class="block mb-2 text-sm font-medium text-gray-900" />
                            <text-input
                                id="password"
                                type="password"
                                placeholder="••••••••"
                                class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm focus:ring-flamingo focus:border-flamingo block w-full p-2.5"
                                v-model="form.password"
                                autocomplete="current-password"
                            />
                            <input-error class="mt-2" :message="form.errors.password"/>
                        </div>
                        <!-- bloque recuérdame y contraseña olvidada -->
                        <div class="flex items-center justify-end">
                            <Link
                                v-if="canResetPassword"
                                :href="route('password.request')"
                                class="text-sm text-gray-800 hover:text-flamingo focus:outline-none focus:border-[2px] focus:border-flamingo border-[2px] border-white active:text-gray-800"
                            >
                                ¿Contraseña olvidada?
                            </Link>
                        </div>
                        <!--botón principal-->
                        <div class="text-center">
                            <primary-button :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                                Inicia sesión
                            </primary-button>
                        </div>
                        <div class="flex justify-around">
                            <!--Iniciar sesion Github-->
                            <a :href="route('auth.github')" type="button" class="text-white bg-gray-800 hover:bg-flamingo hover:text-gray-800 focus:ring-4 focus:outline-none focus:ring-gray-800/50 font-medium text-sm px-5 py-2.5 text-center inline-flex items-center">
                                <svg class="w-4 h-4 mr-2 -ml-1" aria-hidden="true" focusable="false" data-prefix="fab" data-icon="github" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 496 512">
                                    <path fill="currentColor" d="M165.9 397.4c0 2-2.3 3.6-5.2 3.6-3.3 .3-5.6-1.3-5.6-3.6 0-2 2.3-3.6 5.2-3.6 3-.3 5.6 1.3 5.6 3.6zm-31.1-4.5c-.7 2 1.3 4.3 4.3 4.9 2.6 1 5.6 0 6.2-2s-1.3-4.3-4.3-5.2c-2.6-.7-5.5 .3-6.2 2.3zm44.2-1.7c-2.9 .7-4.9 2.6-4.6 4.9 .3 2 2.9 3.3 5.9 2.6 2.9-.7 4.9-2.6 4.6-4.6-.3-1.9-3-3.2-5.9-2.9zM244.8 8C106.1 8 0 113.3 0 252c0 110.9 69.8 205.8 169.5 239.2 12.8 2.3 17.3-5.6 17.3-12.1 0-6.2-.3-40.4-.3-61.4 0 0-70 15-84.7-29.8 0 0-11.4-29.1-27.8-36.6 0 0-22.9-15.7 1.6-15.4 0 0 24.9 2 38.6 25.8 21.9 38.6 58.6 27.5 72.9 20.9 2.3-16 8.8-27.1 16-33.7-55.9-6.2-112.3-14.3-112.3-110.5 0-27.5 7.6-41.3 23.6-58.9-2.6-6.5-11.1-33.3 2.6-67.9 20.9-6.5 69 27 69 27 20-5.6 41.5-8.5 62.8-8.5s42.8 2.9 62.8 8.5c0 0 48.1-33.6 69-27 13.7 34.7 5.2 61.4 2.6 67.9 16 17.7 25.8 31.5 25.8 58.9 0 96.5-58.9 104.2-114.8 110.5 9.2 7.9 17 22.9 17 46.4 0 33.7-.3 75.4-.3 83.6 0 6.5 4.6 14.4 17.3 12.1C428.2 457.8 496 362.9 496 252 496 113.3 383.5 8 244.8 8zM97.2 352.9c-1.3 1-1 3.3 .7 5.2 1.6 1.6 3.9 2.3 5.2 1 1.3-1 1-3.3-.7-5.2-1.6-1.6-3.9-2.3-5.2-1zm-10.8-8.1c-.7 1.3 .3 2.9 2.3 3.9 1.6 1 3.6 .7 4.3-.7 .7-1.3-.3-2.9-2.3-3.9-2-.6-3.6-.3-4.3 .7zm32.4 35.6c-1.6 1.3-1 4.3 1.3 6.2 2.3 2.3 5.2 2.6 6.5 1 1.3-1.3 .7-4.3-1.3-6.2-2.2-2.3-5.2-2.6-6.5-1zm-11.4-14.7c-1.6 1-1.6 3.6 0 5.9 1.6 2.3 4.3 3.3 5.6 2.3 1.6-1.3 1.6-3.9 0-6.2-1.4-2.3-4-3.3-5.6-2z"></path>
                                </svg>
                                Inicia con Github
                            </a>
                            <!--Iniciar sesion Google-->
                            <a :href="route('auth.google')" type="button" class="text-white bg-[#4285F4] hover:bg-flamingo hover:font-extrabold hover:text-[#4285F4] focus:ring-4 focus:outline-none focus:ring-[#4285F4]/50 font-medium text-sm px-5 py-2.5 text-center inline-flex items-center">
                                <svg class="w-4 h-4 mr-2 -ml-1" aria-hidden="true" focusable="false" data-prefix="fab" data-icon="google" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 488 512">
                                    <path fill="currentColor" d="M488 261.8C488 403.3 391.1 504 248 504 110.8 504 0 393.2 0 256S110.8 8 248 8c66.8 0 123 24.5 166.3 64.9l-67.5 64.9C258.5 52.6 94.3 116.6 94.3 256c0 86.5 69.1 156.6 153.7 156.6 98.2 0 135-70.4 140.8-106.9H248v-85.3h236.1c2.3 12.7 3.9 24.9 3.9 41.4z"></path>
                                </svg>
                                Inicia con Google
                            </a>
                        </div>
                        <p class="text-right text-sm font-light text-gray-700">
                            ¿Aún no tienes cuenta?
                            <Link :href="route('register')" class="font-medium text-primary-600 hover:text-flamingo focus:outline-none focus:border-[2px] focus:border-flamingo border-[2px] border-white">
                                ¡Regístrate aquí!
                            </Link>
                        </p>
                    </form>
                </div>
            </div>
        </div>
    </auth-layout>
</template>
