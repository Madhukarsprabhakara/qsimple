<template>
  <div class="border-l-4 border-yellow-400 bg-yellow-50 p-4">
    <div class="flex">
      <div class="flex-shrink-0">
        <ExclamationTriangleIcon class="h-5 w-5 text-yellow-400" aria-hidden="true" />
      </div>
      <div class="ml-3">
        <p class="text-sm text-yellow-700">
          Querysimple will always connect to your database from the following IPs -
          {{ ' ' }}
          
        </p>
        <p class="font-medium text-yellow-700 underline hover:text-yellow-600">54.215.217.48, 52.52.144.120 </p>
        <p class="text-yellow-700  hover:text-yellow-600">Please allow this in your firewall/security group</p>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ExclamationTriangleIcon } from '@heroicons/vue/20/solid'
</script>