<script setup>
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Link, useForm, usePage } from '@inertiajs/vue3';

defineProps({
    mustVerifyEmail: {
        type: Boolean,
    },
    status: {
        type: String,
    },
});

const form = useForm({
    usuario: usePage().props.auth.user.usuario,
    email: usePage().props.auth.user.email,
});
</script>

<template>
    <section>
        <header>
            <h2 class="text-lg font-medium text-gray-900">
                Información
            </h2>

            <p class="mt-1 text-sm text-gray-600">
                Actualizar datos de cuenta.
            </p>
        </header>

        <form @submit.prevent="form.patch(route('profile.update'))" class="mt-6 space-y-6">
            <div>
                <input-label for="usuario" value="Usuario" />

                <text-input
                    id="usuario"
                    type="text"
                    class="mt-1 block w-full"
                    v-model="form.usuario"
                    required
                    autofocus
                    autocomplete="usuario"
                />

                <input-error class="mt-2" :message="form.errors.usuario" />
            </div>

            <div>
                <input-label for="email" value="Email" />

                <text-input
                    id="email"
                    type="email"
                    class="mt-1 block w-full"
                    v-model="form.email"
                    required
                    autocomplete="username"
                />

                <input-error class="mt-2" :message="form.errors.email" />
            </div>

            <div v-if="mustVerifyEmail && $page.props.auth.user.email_verificado_fecha === null">
                <p class="text-sm mt-2 text-gray-800">
                    Tu email no ha sido verificado.
                    <Link
                        :href="route('verification.send')"
                        method="post"
                        as="button"
                        class="underline text-sm text-gray-600 hover:text-gray-900 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                    >
                        Clica para reenviar email de verificación.
                    </Link>
                </p>

                <div
                    v-show="status === 'verification-link-sent'"
                    class="mt-2 font-medium text-sm text-green-600"
                >
                    Un nuevo email de verificación ha sido enviado.
                </div>
            </div>

            <div class="flex items-center gap-4">
                <primary-button :disabled="form.processing">Guardar</primary-button>

                <Transition
                    enter-active-class="transition ease-in-out"
                    enter-from-class="opacity-0"
                    leave-active-class="transition ease-in-out"
                    leave-to-class="opacity-0"
                >
                    <p v-if="form.recentlySuccessful" class="text-sm text-gray-600">Guardado.</p>
                </Transition>
            </div>
        </form>
    </section>
</template>
