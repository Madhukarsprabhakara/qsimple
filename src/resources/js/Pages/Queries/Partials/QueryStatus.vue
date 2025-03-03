<template>
  <div v-if="$page.props.query.status.length==0">
  	<EmptyStatus />
  </div>
  <div v-if="$page.props.query.status.length>0" class="overflow-hidden bg-white shadow sm:rounded-md">
    <ul role="list" class="divide-y divide-gray-200">
      <li v-for="status in $page.props.query.status" :key="status.id">
        <a href="#" class="block hover:bg-gray-50">
          <div class="px-4 py-4 sm:px-6">
            <div class="flex items-center justify-between">
              <p class="truncate text-sm font-medium text-gray-600">{{ status.status }}</p>
              <div v-if="status.type && !status.new_table_record_count" class="flex items-center text-sm text-gray-500 sm:mt-0">
                <CalendarIcon class="mr-1.5 h-5 w-5 flex-shrink-0 text-gray-400" aria-hidden="true" />
                <p>
                  Executed on
                  {{ ' ' }}
                  <time :datetime="status.created_at">{{ status.created_at }}</time>
                </p>
              </div>
            </div>
            <div class="mt-2 sm:flex sm:justify-between">
              <div class="sm:flex">
                <p v-if="status.new_table_record_count" class="flex items-center text-sm text-gray-500">
                  <TableCellsIcon class="mr-1.5 h-5 w-5 flex-shrink-0 text-gray-400" aria-hidden="true" />
                  {{ status.new_table_record_count }} records synced
                </p>
                <p v-if="!status.type" class="flex items-center text-sm text-red-500">
                	
                	{{ status.error }}
                </p>
                <!-- <p class="mt-2 flex items-center text-sm text-gray-500 sm:mt-0 sm:ml-6">
                  <MapPinIcon class="mr-1.5 h-5 w-5 flex-shrink-0 text-gray-400" aria-hidden="true" />
                  {{ status.type }}
                </p> -->
              </div>
              <div v-if="status.type && status.new_table_record_count" class="mt-2 flex items-center text-sm text-gray-500 sm:mt-0">
                <CalendarIcon class="mr-1.5 h-5 w-5 flex-shrink-0 text-gray-400" aria-hidden="true" />
                <p>
                  Synced on
                  {{ ' ' }}
                  <time :datetime="status.created_at">{{ status.created_at }}</time>
                </p>
              </div>
              
            </div>
          </div>
        </a>
      </li>
    </ul>
  </div>
</template>

<script setup>
import { CalendarIcon, MapPinIcon, UsersIcon, TableCellsIcon } from '@heroicons/vue/20/solid'
import EmptyStatus from '@/Pages/Queries/Partials/EmptyStatus.vue';
const positions = [
  {
    id: 1,
    title: 'Back End Developer',
    type: 'Full-time',
    location: 'Remote',
    department: 'Engineering',
    closeDate: '2020-01-07',
    closeDateFull: 'January 7, 2020',
  },
  {
    id: 2,
    title: 'Front End Developer',
    type: 'Full-time',
    location: 'Remote',
    department: 'Engineering',
    closeDate: '2020-01-07',
    closeDateFull: 'January 7, 2020',
  },
  {
    id: 3,
    title: 'User Interface Designer',
    type: 'Full-time',
    location: 'Remote',
    department: 'Design',
    closeDate: '2020-01-14',
    closeDateFull: 'January 14, 2020',
  },
]
</script>