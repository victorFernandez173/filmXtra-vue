<script setup>
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import {Head, Link, useForm} from '@inertiajs/vue3';
import AuthLayout from "@/Layouts/AuthLayout.vue";
import AppLogoIndex from "@/Components/AppLogoIndex.vue";

const form = useForm({
    name: '',
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
</script>


<template>
    <Head>
        <title>Registro</title>
        <meta name="description" content="Página de registro">
    </Head>
    <auth-layout>
        <div class="flex flex-col items-center justify-center h-screen lg:py-0 pb-16">
            <!--logo filmXtra-->
            <app-logo-index />
            <!--bloque principal-->
            <div class="w-full bg-white shadow md:mt-0 sm:max-w-md xl:p-0">
                <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
                    <h1 class="text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl">
                        Crear una cuenta
                    </h1>
                    <form class="space-y-4 md:space-y-6" @submit.prevent="submit">
                        <div class="mt-4">
                            <InputLabel for="name" value="Nombre" class="block mb-2 text-sm font-medium text-gray-900" />
                            <TextInput
                                id="name"
                                placeholder="Nombre"
                                class="w-full"
                                v-model="form.name"
                                autocomplete="name"
                            />
                            <InputError class="mt-2" :message="form.errors.name"/>
                        </div>

                        <div class="mt-4">
                            <InputLabel for="email" value="Correo electrónico" class="block mb-2 text-sm font-medium text-gray-900" />
                            <TextInput
                                id="email"
                                placeholder="nombre@correo.com"
                                class="w-full"
                                v-model="form.email"
                            />
                            <InputError class="mt-2" :message="form.errors.email"/>
                        </div>

                        <div class="mt-4">
                            <InputLabel for="password" value="Contraseña" class="block mb-2 text-sm font-medium text-gray-900" />
                            <TextInput
                                id="password"
                                type="password"
                                placeholder="••••••••"
                                class="w-full"
                                v-model="form.password"
                                autocomplete="new-password"
                            />
                            <InputError class="mt-2" :message="form.errors.password"/>
                        </div>

                        <div class="mt-4">
                            <InputLabel for="password_confirmation" value="Confirmar contraseña" class="block mb-2 text-sm font-medium text-gray-900" />
                            <TextInput
                                id="password_confirmation"
                                type="password"
                                placeholder="••••••••"
                                class="w-full"
                                v-model="form.password_confirmation"
                                autocomplete="new-password"
                            />
                            <InputError class="mt-2" :message="form.errors.password_confirmation"/>
                        </div>

                        <div class="mt-4">
                            <InputLabel for="number" value="Teléfono" class="block mb-2 text-sm font-medium text-gray-900" />
                            <TextInput
                                id="number"
                                type="number"
                                placeholder="Teléfono opcional"
                                class="w-full"
                                v-model="form.number"
                                autocomplete="number"
                            />
                        </div>

                        <PrimaryButton :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                            Crear cuenta
                        </PrimaryButton>
                        <p class="text-right text-sm font-light text-gray-500">
                            ¿Ya tienes cuenta? <Link :href="route('login')" class="font-medium text-gray-600 hover:text-flamingo focus:outline-none focus:border-[2px] focus:border-flamingo border-[2px] border-white rounded-md">¡Inicia sesión aquí!</Link>
                        </p>
                    </form>
                </div>
            </div>
        </div>
    </auth-layout>
</template>
