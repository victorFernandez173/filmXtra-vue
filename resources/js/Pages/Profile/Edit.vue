<script setup>
import AuthLayout from "@/Layouts/AuthLayout.vue";
import DeleteUserForm from './Partials/DeleteUserForm.vue';
import UpdatePasswordForm from './Partials/UpdatePasswordForm.vue';
import UpdateProfileInformationForm from './Partials/UpdateProfileInformationForm.vue';
import { Head } from '@inertiajs/vue3';

defineProps({
    mustVerifyEmail: {
        type: Boolean,
    },
    status: {
        type: String,
    },
});
</script>

<template>

    <Head>
        <title>
            {{ $t('profile.title') }}
        </title>
        <meta name="description" content="Página de cuenta de usuario">
    </Head>

    <auth-layout>
        <div class="w-full flex justify-center">
            <div class="flex flex-col items-center h-fit md:max-w-screen-md">

                <div class="my-8 p-4 max-w-fit bg-white">
                    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                        {{ $t('profile.h2') }}
                    </h2>
                </div>

                <div class="w-[95%] mb-8 p-4 sm:p-8 bg-white shadow text-center">
                    <update-profile-information-form
                        :must-verify-email="mustVerifyEmail"
                        :status="status"
                    />
                </div>

                <div v-if="$page.props.auth.user.login_tipo_id === 1 && $page.props.auth.user.email_verificado_fecha" class="w-[95%] mb-8 p-4 sm:p-8 bg-white shadow text-center">
                    <update-password-form />
                </div>

                <div class="mb-8 w-[95%] p-4 sm:p-8 bg-white shadow text-center">
                    <delete-user-form class="m-4" />
                </div>
            </div>
        </div>
    </auth-layout>

</template>
