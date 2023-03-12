<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import CreateQueryFormv1 from '@/Pages/Queries/Partials/CreateQueryFormv1.vue';
</script>

<template>
    <AppLayout title="Create Team">
        <!-- <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Create Database
            </h2>
        </template> -->

        <div>
            <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
                <div class=" px-5 py-5">
                    <CreateQueryFormv1 />
                </div>
            </div>
        </div>
    </AppLayout>
</template>
