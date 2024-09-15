<script setup>
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Head, useForm } from '@inertiajs/vue3';
import AuthLayout from "@/Layouts/AuthLayout.vue";
import AppLogoIndex from "@/Components/AppLogoIndex.vue";

defineProps({
    status: {
        type: String,
    },
});

const form = useForm({
    email: '',
});

const submit = () => {
    form.post(route('password.email'));
};

</script>

<template>
    <Head>
        <title>
            {{ $t('forgot_password.title') }}
        </title>
        <meta name="description" content="Página de password olvidado">
    </Head>
    <auth-layout>
        <div class="flex flex-col items-center justify-center pb-16 h-screen lg:py-0">
            <!--logo filmXtra-->
            <app-logo-index />
            <!--bloque principal-->
            <div class="w-[95%] bg-white shadow md:mt-0 sm:max-w-md xl:p-0">
                <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
                    <h1 class="text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-xl">
                        {{ $t('forgot_password.olvidado') }}
                    </h1>
                    <h3 class="text-xl leading-tight tracking-tight text-gray-900 md:text-lg">
                        {{ $t('forgot_password.introduce') }}
                    </h3>
                    <form class="space-y-4 md:space-y-6" @submit.prevent="submit">
                        <div>
                            <input-label for="email" :value="$t('forgot_password.label')" class="block mb-2 text-sm font-medium text-gray-900" />
                            <text-input
                                id="email"
                                :placeholder="$t('forgot_password.label')"
                                class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm focus:ring-flamingo focus:border-flamingo block w-full p-2.5"
                                v-model="form.email"
                                autofocus
                                autocomplete="username"
                            />
                            <input-error class="mt-2" :message="form.errors.email"/>
                            <!--Para el mensaje de confirmación de envío-->
                            <input-error v-if="status" class="mt-2" :message="'Email enviado satisfactoriamente'"/>
                        </div>
                        <div class="text-center">
                            <primary-button :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                                {{ $t('forgot_password.boton') }}
                            </primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </auth-layout>
</template>
