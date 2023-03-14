<template>
  <div class="px-4 sm:px-6 mt-4 lg:px-8">
    <div class="sm:flex sm:items-center">
      <div class="sm:flex-auto">
        <h1 class="text-base font-semibold leading-6 text-gray-900">Queries</h1>
        <p class="mt-2 text-sm text-gray-700">A list of queries created and scheduled in {{$page.props.auth.user.current_team.name}}.</p>
      </div>
      <div class="mt-4 sm:mt-0 sm:ml-16 sm:flex-none">
      	<Link   :href="route('queries.create')" class="text-sm text-gray-700 underline">
        	<button type="button" class="block rounded-md bg-indigo-600 py-2 px-3 text-center text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Create and schedule a query</button>
        </Link>	
      </div>
    </div>
    <div class="mt-8 flow-root">
      <div class="-my-2 -mx-4 overflow-x-auto sm:-mx-6 lg:-mx-8">
        <div class="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8">
          <table class="min-w-full divide-y divide-gray-300">
            <thead>
              <tr>
                
                <th scope="col" class="whitespace-nowrap px-2 py-3.5 text-left text-sm font-semibold text-gray-900">Title</th>
                <th scope="col" class="whitespace-nowrap px-2 py-3.5 text-left text-sm font-semibold text-gray-900">Frequency</th>
                <th scope="col" class="whitespace-nowrap px-2 py-3.5 text-left text-sm font-semibold text-gray-900">Schema</th>
                <th scope="col" class="whitespace-nowrap px-2 py-3.5 text-left text-sm font-semibold text-gray-900">Table</th>
                <th scope="col" class="whitespace-nowrap px-2 py-3.5 text-left text-sm font-semibold text-gray-900">Database</th>
                <th scope="col" class="relative whitespace-nowrap py-3.5 pl-3 pr-4 sm:pr-0">
                  <span class="sr-only">Edit</span>
                </th>
              </tr>
            </thead>
            <tbody class="divide-y divide-gray-200 bg-white">
              <tr v-for="query in $page.props.queries" :key="query.id">
                
                <td class="whitespace-nowrap px-2 py-2 text-sm font-medium text-gray-900">{{ query.query_title }}</td>
                <td class="whitespace-nowrap px-2 py-2 text-sm text-gray-900">{{ query.schedule }}</td>
                <td class="whitespace-nowrap px-2 py-2 text-sm text-gray-500">{{ query.schema_name }}</td>
                <td class="whitespace-nowrap px-2 py-2 text-sm text-gray-500">{{ query.table_name }}</td>
                <td class="whitespace-nowrap px-2 py-2 text-sm text-gray-500">{{ query.database.name }}</td>
                <td class="relative whitespace-nowrap py-2 pl-3 pr-4 text-right text-sm font-medium sm:pr-0">
                  <a href="#" class="text-indigo-600 hover:text-indigo-900"
                    >Edit<span class="sr-only">, {{ query.id }}</span></a
                  >
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { Head, Link } from '@inertiajs/vue3'; 
const transactions = [
  {
    id: 'AAPS0L',
    company: 'Chase & Co.',
    share: 'CAC',
    commission: '+$4.37',
    price: '$3,509.00',
    quantity: '12.00',
    netAmount: '$4,397.00',
  },
  // More transactions...
]
</script>