<script setup>
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import {Head, useForm, Link} from '@inertiajs/vue3';
import AuthLayout from "@/Layouts/AuthLayout.vue";
import AppLogoIndex from "@/Components/AppLogoIndex.vue";

const props = defineProps({
    email: {
        type: String,
        required: true,
    },
    token: {
        type: String,
        required: true,
    },
});

const form = useForm({
    token: props.token,
    email: props.email,
    password: '',
    password_confirmation: '',
});

const submit = () => {
    form.post(route('password.store'), {
        onFinish: () => form.reset('password', 'password_confirmation'),
    });
};
</script>

<template>
    <Head>
        <title>Resetear password</title>
        <meta name="description" content="Página para resetear password">
    </Head>

    <auth-layout>
        <div class="flex flex-col items-center justify-center pb-16 h-screen lg:py-0">
            <!--logo filmXtra-->
            <app-logo-index />
            <!--bloque principal-->
            <div class="w-full p-6 bg-white shadow md:mt-0 sm:max-w-md sm:p-8">
                <h2 class="mb-1 text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl">
                    Cambiar contraseña
                </h2>
                <form class="mt-4 space-y-4 lg:mt-5 md:space-y-5" @submit.prevent="submit">
                    <div>
                        <InputLabel for="email" class="block mb-2 text-sm font-medium text-gray-900">Correo electrónico</InputLabel>
                        <TextInput id="email" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm focus:ring-flamingo focus:border-flamingo block w-full p-2.5" placeholder="nombre@correo.com" v-model="form.email" />
                        <InputError class="mt-2" :message="form.errors.email"/>
                    </div>
                    <div>
                        <InputLabel for="password" class="block mb-2 text-sm font-medium text-gray-900">Nueva contraseña</InputLabel>
                        <TextInput type="password" id="password" placeholder="••••••••" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm focus:ring-flamingo focus:border-flamingo block w-full p-2.5"  v-model="form.password" />
                        <InputError class="mt-2" :message="form.errors.password"/>
                    </div>
                    <div>
                        <InputLabel for="confirm-password" class="block mb-2 text-sm font-medium text-gray-900">Confirmar nueva contraseña</InputLabel>
                        <TextInput type="password"  id="confirm-password" placeholder="••••••••" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm focus:ring-flamingo focus:border-flamingo block w-full p-2.5" v-model="form.password_confirmation" />
                        <InputError class="mt-2" :message="form.errors.password_confirmation"/>
                    </div>
                    <div>
                        <PrimaryButton type="submit" class="w-full text-white bg-flamingo hover:text-black focus:bg-flamingo focus:ring-flamingo focus:border-flamingo focus:outline-none font-medium text-sm px-5 py-2.5 text-center">Resetear contraseña</PrimaryButton>
                    </div>
                    <p class="text-sm font-light text-gray-500">
                        ¿Ya tienes cuenta?
                        <Link :href="route('login')" class="font-medium text-primary-600 hover:underline focus:outline-none focus:border-[2px] focus:border-flamingo border-[2px] border-white">¡Inicia sesión aquí!</Link>
                    </p>
                </form>
            </div>
        </div>
    </auth-layout>
</template>
