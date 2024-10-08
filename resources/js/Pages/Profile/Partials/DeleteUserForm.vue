<script setup>
import DangerButton from '@/Components/DangerButton.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import Modal from '@/Components/Modal.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { useForm, usePage } from '@inertiajs/vue3';
import { nextTick, ref } from 'vue';

const confirmingUserDeletion = ref(false);
const passwordInput = ref(null);

const form = useForm({
    password: '',
});

const confirmUserDeletion = () => {
    confirmingUserDeletion.value = true;

    if(usePage().props.auth.user.login_tipo_id === 1){
        nextTick(() => passwordInput.value.focus());
    }
};

const deleteUser = () => {
    form.delete(route('profile.destroy'), {
        onSuccess: () => closeModal(),
        onError: () => passwordInput.value.focus(),
        onFinish: () => form.reset(),
    });
};

const closeModal = () => {
    confirmingUserDeletion.value = false;

    form.reset();
};
</script>

<template>
    <section class="space-y-6">
        <header>
            <h2 class="text-lg font-medium text-gray-900">
                {{ $t('delete_profile.h2') }}
            </h2>

            <p class="mt-1 text-sm text-gray-600">
                {{ $t('delete_profile.subtitle') }}
            </p>
        </header>

        <danger-button @click="confirmUserDeletion">
            {{ $t('delete_profile.boton') }}
        </danger-button>

        <modal :show="confirmingUserDeletion" @close="closeModal">
            <div class="p-6">
                <h2 class="text-lg font-medium text-gray-900">
                    {{ $t('delete_profile.pregunta') }}
                </h2>

                <p class="mt-1 text-sm text-gray-600">
                    {{ $t('delete_profile.subtitle') }}
                </p>

                <div class="mt-6">
                    <input-label v-if="$page.props.auth.user.login_tipo_id === 1" for="password" value="Password" class="sr-only" />

                    <text-input
                        v-if="$page.props.auth.user.login_tipo_id === 1"
                        id="password"
                        ref="passwordInput"
                        v-model="form.password"
                        type="password"
                        class="mx-auto mt-1 block w-3/4"
                        placeholder="Password"
                        @keyup.enter="deleteUser"
                    />

                    <input-error v-if="$page.props.auth.user.login_tipo_id === 1" :message="form.errors.password" class="mt-2 text-center" />
                </div>

                <div class="mt-6 flex justify-end">
                    <secondary-button @click="closeModal">
                        {{ $t('delete_profile.cancelar') }}
                    </secondary-button>

                    <danger-button
                        class="ml-3"
                        :class="{ 'opacity-25': form.processing }"
                        :disabled="form.processing"
                        @click="deleteUser"
                    >
                        {{ $t('delete_profile.borrar') }}
                    </danger-button>
                </div>
            </div>
        </modal>
    </section>
</template>
