<!--
  This example requires some changes to your config:
  
  ```
  // tailwind.config.js
  module.exports = {
    // ...
    plugins: [
      // ...
      require('@tailwindcss/forms'),
    ],
  }
  ```
-->
<template>
  <form @submitted="storeQuery" class="space-y-8 divide-y divide-gray-200">
    <div class="space-y-8 divide-y divide-gray-200">
      <div>
        <div class="sm:col-span-4 mb-2">
            <label for="email" class="block text-sm font-medium leading-6 text-gray-900">Title</label>
            <div class="mt-2">
              <input id="email" v-model="form.query_title" name="email" type="text" autocomplete="email" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" />
            </div>
        </div>
        <div>

          <div class="sm:col-span-3">
            <label for="country" class="block text-sm font-medium leading-6 text-gray-900">Database</label>

            <div class="mt-2">
              <select id="database" name="database" v-model="form.database_id" class="block w-1/2 rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                <option disabled >Please select a database</option>
                <option :value="database.id" v-for="database in $page.props.databases">{{database.display_name}}</option>
                
              </select>
              <!-- <div>Selected: {{ form.database_id }}</div> -->
            </div>
            <p class="mt-2 text-sm text-gray-500">This is where the query will run.</p>
          </div>
        </div>

        <div class="mt-6 grid grid-cols-1 gap-y-6 gap-x-4 sm:grid-cols-6">
          

          <div class="sm:col-span-6">
            <label for="about" class="block text-sm font-medium leading-6 text-gray-900">Query</label>
            <div class="mt-2">
              <textarea placeholder="Paste your query here" v-model="form.query" id="about" name="about" rows="8" class="block w-full rounded-md border-0 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:py-1.5 sm:text-sm sm:leading-6" />
            </div>
            <p class="mt-2 text-sm text-gray-500">Test the query before scheduling it.</p>
          </div>
          
       
          <div class="sm:col-span-6 px-2 py-2 bg-gray-100">
            <div class="relative flex items-start">
              <div class="flex h-6 items-center">
                <input id="select_stmt" aria-describedby="comments-description" v-model="select_stmt" name="comments" type="checkbox" class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-600">
              </div>
              <div class="ml-3">
                <label for="select_stmt" class="text-sm font-medium leading-6 text-gray-900">Query is a select statement</label>
              </div>
            </div>
            <label v-if="select_stmt" for="email" class="block text-sm font-medium leading-6 text-gray-900 mt-2">Table name</label>
            <div v-if="select_stmt" class="mt-2">
              <input id="table_name" name="table_name" type="text" autocomplete="email" v-model="form.table_name" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" />
            </div>
            <p v-if="select_stmt" class="mt-2 text-sm text-gray-500">Results will be stored on this table and subsequent data syncs will happen on this table as well.</p>
          </div>

        </div>
        <!-- <p class="text-sm text-gray-500">Simply schedule a query to run or want the system to create a table and keep data in sync</p> -->
        <div class="sm:col-span-3 mt-4">
            <label for="country" class="block text-sm font-medium leading-6 text-gray-900">Frequency</label>

            <div class="mt-2">
              <select id="schedule" v-model="form.schedule" name="schedule"  class="block w-1/2 rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                <option value="manual">Manual</option>
                <option value="every_24_hours">Every 24 hours</option>
                <option value="every_12_hours">Every 12 hours</option>
                <option value="every_6_hours">Every 6 hours</option>
                <option value="every_1_hour">Every hour</option>
              </select>
            </div>
            
          </div>
      </div>
    </div>

    <div class="pt-5">
      <div class="flex justify-end">
        <button type="button" class="rounded-md bg-white py-2 px-3 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50">Never mind</button>
        <button type="submit" class="ml-3 inline-flex justify-center rounded-md bg-indigo-600 py-2 px-3 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Save</button>
      </div>
    </div>
  </form>
</template>
<script setup>
import { useForm, Link } from '@inertiajs/vue3';
import { ref } from 'vue';
const form = useForm({
    query_title: '',
    database_id:'',
    query:'',
    table_name:'',
    schedule:'',
    

});
const select_stmt = ref(false)
const storeQuery = () => {
    form.post(route('queries.store'), {
        errorBag: 'storeQuery',
        preserveScroll: true,
    });
};
</script>
