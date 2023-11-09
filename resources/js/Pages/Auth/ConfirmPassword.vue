<script setup>
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import {Head, useForm} from '@inertiajs/vue3';
import AuthLayout from "@/Layouts/AuthLayout.vue";
import AppLogoIndex from "@/Components/AppLogoIndex.vue";

const form = useForm({
    password: '',
});

const submit = () => {
    form.post(route('password.confirm'), {
        onFinish: () => form.reset(),
    });
};
</script>

<template>
    <Head>
        <title>Confirmar password</title>
        <meta name="description" content="Pagina de confirmacion de password">
    </Head>
    <auth-layout>
        <div class="flex flex-col items-center justify-center pb-16 h-screen lg:py-0">
            <!--logo filmXtra-->
            <app-logo-index />
            <!--bloque principal-->
            <div class="w-full bg-white rounded-lg shadow md:mt-0 sm:max-w-md xl:p-0">
                <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
                    <h1 class="text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl">
                        Confirmación de la contraseña
                    </h1>
                    <h3 class="text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-lg">
                        Área segura. Por favor, confirme su contraseña antes de continuar.
                    </h3>
                    <form class="space-y-4 md:space-y-6" @submit.prevent="submit">
                        <div>
                            <InputLabel for="password" value="Contraseña" class="block mb-2 text-sm font-medium text-gray-900" />
                            <TextInput
                                id="password"
                                type="password"
                                placeholder="••••••••"
                                class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-flamingo focus:border-flamingo block w-full p-2.5"
                                v-model="form.password"
                                autocomplete="current-password"
                            />
                            <InputError class="mt-2" :message="form.errors.password"/>
                        </div>
                        <PrimaryButton :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                            Confirmar
                        </PrimaryButton>
                    </form>
                </div>
            </div>
        </div>
    </auth-layout>
</template>
