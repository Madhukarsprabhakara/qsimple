<template>
	<AppLayout title="Query">
        <!-- <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Dashboard
            </h2>
        </template> -->

        <div class="py-2">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="">
                        <QueryShowTitle />
                </div>
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    
				  	<QueryShowTabs />

                </div>
            </div>
        </div>
    </AppLayout>
</template>

<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import QueryShowTitle from '@/Pages/Queries/Partials/QueryShowTitle.vue';
import QueryShowTabs from '@/Pages/Queries/Partials/QueryShowTabs.vue';

</script>