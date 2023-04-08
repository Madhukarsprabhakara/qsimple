<template>
	<AppLayout title="Queries">
        <!-- <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Dashboard
            </h2>
        </template> -->

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    
				  	<QueryEmptyState v-if="$page.props.databases.length!=0 && $page.props.queries.length==0" />
				  	<DatabaseEmptyState v-if="$page.props.databases.length==0" />
                    <QueryList v-if="$page.props.queries.length!=0" />

                </div>
            </div>
        </div>
    </AppLayout>
</template>

<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import QueryEmptyState from '@/Pages/Queries/QueryEmptyState.vue';
import DatabaseEmptyState from '@/Pages/Databases/DatabaseEmptyState.vue';
import QueryList from '@/Pages/Queries/Partials/QueryList.vue';
import { init, track } from '@amplitude/analytics-browser';
import { usePage } from '@inertiajs/vue3'; 
const eventProperties = {
  user: usePage().props.auth.user.email,
  team: usePage().props.auth.user.current_team.id,
};
track('List queries', eventProperties);
</script>