<script setup>
import { useForm, Link } from '@inertiajs/vue3';
import FormSection from '@/Components/FormSection.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import Dropdown from '@/Components/Dropdown.vue';
import Checkbox from '@/Components/Checkbox.vue';
import { ref } from 'vue';
const form = useForm({
    query_title: '',
    database_id:'',
    query:'',
    table_name:'',
    schema_name:'',
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

<template>
    <FormSection @submitted="storeQuery">
        <template #title>
            Query details
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
                <InputLabel for="query_title" value="Title" />
                <TextInput
                    id="query_title"
                    v-model="form.query_title"
                    type="text"
                    class="block w-full mt-1"
                    autofocus
                    required
                />
                <InputError :message="form.errors.query_title" class="mt-2" />
            </div>

            <div class="col-span-6 sm:col-span-4">
                <label for="database" class="block text-sm font-medium leading-6 text-gray-900">Database</label>
                <select id="database" name="database" v-model="form.database_id" class="block w-1/2 rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" required>
                <option disabled >Please select a database</option>
                <option :value="database.id" v-for="database in $page.props.databases">{{database.display_name}}</option>
                
              </select>
              <p class="mt-2 text-sm text-gray-500">This is where the query will run.</p>
                <InputError :message="form.errors.database_id" class="mt-2" />
            </div>
            <div class="col-span-6 sm:col-span-4">
                <label for="about" class="block text-sm font-medium leading-6 text-gray-900">Query</label>
                <div class="mt-2">
                  <textarea placeholder="Paste your query here" v-model="form.query" id="about" name="about" rows="8" class="block w-full rounded-md border-0 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:py-1.5 sm:text-sm sm:leading-6" required/>
                </div>
                <p class="mt-2 text-sm text-gray-500">Test the query before scheduling it.</p>
                <InputError :message="form.errors.query" class="mt-2" />
            </div>
            <div class="col-span-6 sm:col-span-4">
                <div class="relative flex items-start">
                  <div class="flex h-6 items-center">
                    <input id="select_stmt" aria-describedby="comments-description" v-model="select_stmt" name="comments" type="checkbox" class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-600">
                  </div>
                  <div class="ml-3">
                    <label for="select_stmt" class="text-sm font-medium leading-6 text-gray-900">Query is a select statement</label>
                  </div>
                </div>
                
                <div class="grid grid-cols-2 gap-4">
                    
                    <div v-if="select_stmt" class="mt-2">
                        <label v-if="select_stmt" for="select_stmt" class="block text-sm font-medium leading-6 text-gray-900 mt-2">Table name</label>
                      <input v-if="select_stmt" id="table_name" name="table_name" type="text"  v-model="form.table_name" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" required/>
                    </div>

                    <div v-if="select_stmt" class="mt-2">
                        <label v-if="select_stmt" for="select_stmt" class="block text-sm font-medium leading-6 text-gray-900 mt-2">Schema name</label>
                      <input v-if="select_stmt" id="schema_name" name="schema_name" type="text"  v-model="form.schema_name" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" required/>
                    </div>

                </div>

                <p v-if="select_stmt" class="mt-2 text-sm text-gray-500">Results will be stored in this table and subsequent data syncs will happen in this table.</p>
            </div>
            <div class="col-span-6 sm:col-span-4">
                <InputLabel for="frequency" value="Frequency" />
                <select id="schedule" v-model="form.schedule" name="schedule"  class="block w-1/2 rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" required>
                    <option value="manual">Manual</option>
                    <option value="every_24_hours">Every 24 hours</option>
                    <option value="every_12_hours">Every 12 hours</option>
                    <option value="every_6_hours">Every 6 hours</option>
                    <option value="every_1_hour">Every hour</option>
                  </select>
                <InputError :message="form.errors.schedule" class="mt-2" />
            </div>
            
            
        </template>

        <template #actions>
        	<Link :href="$page.props.previous_url" class="underline mr-6" preserve-scroll>Never mind</Link>
            <PrimaryButton :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                Save and Schedule Query
            </PrimaryButton>
        </template>
    </FormSection>
</template>
