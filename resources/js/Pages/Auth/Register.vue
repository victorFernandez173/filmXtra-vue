<script setup>
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';
import AuthLayout from "@/Layouts/AuthLayout.vue";
import AppLogoIndex from "@/Components/AppLogoIndex.vue";
import { ref } from "vue";

const form = useForm({
    usuario: '',
    email: '',
    password: '',
    password_confirmation: '',
    number: '',
    terms: false,
});

const submit = () => {
    form.post(route('register'), {
        onFinish: () => form.reset('password', 'password_confirmation'),
    });
};

// funcionalidad para ocultar/mostrar el texto de los inputs de contraseñas
let tipoCampoPassword = ref("password");
const togglePassword = () => {
    tipoCampoPassword.value = tipoCampoPassword.value === 'password' ? 'text' : 'password';
    let ojoAbierto = $('#ojoMostrar');
    let ojoCerrado = $('#ojoOcultar')
    if(tipoCampoPassword.value === 'password') {
        ojoAbierto.addClass('inline-block').removeClass('hidden');
        ojoCerrado.addClass('hidden').removeClass('inline-block');
    } else {
        ojoCerrado.addClass('inline-block').removeClass('hidden');
        ojoAbierto.addClass('hidden').removeClass('inline-block');
    }
};
</script>


<template>
    <Head>
        <title>
            {{ $t('register.title') }}
        </title>
        <meta name="description" content="Página de registro">
    </Head>
    <auth-layout>
        <div class="flex flex-col items-center justify-center min-h-screen lg:py-0 pb-16">
            <!--logo filmXtra-->
            <div class="mt-8">
                <app-logo-index />
            </div>
            <!--bloque principal-->
            <div class="w-[95%] bg-white shadow md:mt-0 sm:max-w-md xl:p-0">
                <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
                    <h1 class="text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl">
                        {{ $t('register.h1') }}
                    </h1>
                    <form class="space-y-4 md:space-y-6" @submit.prevent="submit">
                        <div class="mt-4">
                            <input-label for="usuario" :value="$t('register.user_label')" class="block mb-2 text-sm font-medium text-gray-900" />
                            <text-input
                                id="usuario"
                                :placeholder="$t('register.user_label')"
                                class="w-full"
                                v-model="form.usuario"
                                autocomplete="usuario"
                            />
                            <input-error class="mt-2" :message="form.errors.usuario"/>
                        </div>

                        <div class="mt-4">
                            <input-label for="email" :value="$t('register.email_label')" class="block mb-2 text-sm font-medium text-gray-900" />
                            <text-input
                                id="email"
                                :placeholder="$t('register.email_label')"
                                class="w-full"
                                v-model="form.email"
                            />
                            <input-error class="mt-2" :message="form.errors.email"/>
                        </div>

                        <div class="mt-4">
                            <input-label for="password" :value="$t('register.password_label')" class="inline-block mb-2 text-sm font-medium text-gray-900" />&nbsp;
                            <svg id="ojoMostrar" @click="togglePassword" class="inline-block hover:cursor-pointer w-5 h-5 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                <path stroke="currentColor" stroke-width="2" d="M21 12c0 1.2-4.03 6-9 6s-9-4.8-9-6c0-1.2 4.03-6 9-6s9 4.8 9 6Z"/>
                                <path stroke="currentColor" stroke-width="2" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z"/>
                            </svg>
                            <svg id="ojoOcultar" @click="togglePassword" class="hidden hover:cursor-pointer w-5 h-5 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.933 13.909A4.357 4.357 0 0 1 3 12c0-1 4-6 9-6m7.6 3.8A5.068 5.068 0 0 1 21 12c0 1-3 6-9 6-.314 0-.62-.014-.918-.04M5 19 19 5m-4 7a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z"/>
                            </svg>
                            <text-input
                                id="password"
                                :type="tipoCampoPassword"
                                placeholder="••••••••"
                                class="w-full"
                                v-model="form.password"
                                autocomplete="new-password"
                            />
                            <input-error class="mt-2" :message="form.errors.password"/>
                        </div>

                        <div class="mt-4">
                            <input-label for="password_confirmation" :value="$t('register.confirm_label')" class="block mb-2 text-sm font-medium text-gray-900" />
                            <text-input
                                id="password_confirmation"
                                :type="tipoCampoPassword"
                                placeholder="••••••••"
                                class="w-full"
                                v-model="form.password_confirmation"
                                autocomplete="new-password"
                            />
                            <input-error class="mt-2" :message="form.errors.password_confirmation"/>
                        </div>

                        <div class="text-center">
                            <primary-button :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                                {{ $t('register.crear_cuenta') }}
                            </primary-button>
                        </div>
                        <p class="text-right text-sm font-light text-gray-500">
                            {{ $t('register.tienes_cuenta') }}
                            <Link :href="route('login')" class="font-medium text-gray-600 hover:text-flamingo focus:outline-none focus:border-[2px] focus:border-flamingo border-[2px] border-white">
                                {{ $t('register.inicia_sesion') }}
                            </Link>
                        </p>
                    </form>
                </div>
            </div>
        </div>
    </auth-layout>
</template>
