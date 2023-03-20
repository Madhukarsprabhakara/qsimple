<script setup>
import { useForm, Link, usePage } from '@inertiajs/vue3';
import FormSection from '@/Components/FormSection.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';

const form = useForm({
    name: usePage().props.database.name,
    username:usePage().props.database.username,
    password:'',
    port:usePage().props.database.port,
    display_name:usePage().props.database.display_name,
    host:usePage().props.database.host,

});

const updateDatabase = () => {
    form.put(route('databases.update', usePage().props.database.id), {
        errorBag: 'updateDatabase',
        preserveScroll: false,
    });
};
</script>

<template>
    <FormSection @submitted="updateDatabase">
        <template #title>
            Database Details
        </template>

        <template #description>
            Connect to a new database to start querying the data in it.
        </template>

        <template #form>
            <!-- <div class="col-span-6">
                <InputLabel value="Team Owner" />

                <div class="flex items-center mt-2">
                    <img class="object-cover w-12 h-12 rounded-full" :src="$page.props.auth.user.profile_photo_url" :alt="$page.props.auth.user.name">

                    <div class="ml-4 leading-tight">
                        <div class="text-gray-900">{{ $page.props.auth.user.name }}</div>
                        <div class="text-sm text-gray-700">
                            {{ $page.props.auth.user.email }}
                        </div>
                    </div>
                </div>
            </div> -->

            <div class="col-span-6 sm:col-span-4">
                <InputLabel for="name" value="Database Name" />
                <TextInput
                    id="name"
                    v-model="form.name"
                    type="text"
                    class="block w-full mt-1"
                    autofocus
                    required
                />
                <InputError :message="form.errors.name" class="mt-2" />
            </div>

            
            <div class="col-span-6 sm:col-span-4">
                <InputLabel for="host" value="Host" />
                <TextInput
                    id="host"
                    v-model="form.host"
                    type="text"
                    class="block w-full mt-1"
                    required
                />
                <InputError :message="form.errors.host" class="mt-2" />
            </div>
            <div class="col-span-6 sm:col-span-4">
                <InputLabel for="port" value="Port" />
                <TextInput
                    id="port"
                    v-model="form.port"
                    type="number"
                    class="block w-full mt-1"
                    required
                />
                <InputError :message="form.errors.port" class="mt-2" />
            </div>
            <div class="col-span-6 sm:col-span-4">
                <InputLabel for="username" value="Username" />
                <TextInput
                    id="username"
                    v-model="form.username"
                    type="text"
                    class="block w-full mt-1"
                    required
                />
                <InputError :message="form.errors.username" class="mt-2" />
            </div>
            <div class="col-span-6 sm:col-span-4">
                <InputLabel for="password" value="Password" />
                <TextInput
                    id="password"
                    v-model="form.password"
                    type="password"
                    class="block w-full mt-1"
                    
                />
                <InputError :message="form.errors.password" class="mt-2" />
            </div>
            <div class="col-span-6 sm:col-span-4">
                <InputLabel for="display_name" value="Display Name" />
                <TextInput
                    id="display_name"
                    v-model="form.display_name"
                    type="text"
                    class="block w-full mt-1"
                    required
                />
                <InputError :message="form.errors.display_name" class="mt-2" />
            </div>
        </template>

        <template #actions>
        	<Link :href="$page.props.previous_url" class="underline mr-6" preserve-scroll>Never mind</Link>
            <PrimaryButton :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                Update and test connection
            </PrimaryButton>
        </template>
    </FormSection>
</template>
