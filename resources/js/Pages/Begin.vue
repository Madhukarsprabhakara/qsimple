<template>
  <Head title="Welcome" />
  <div class="bg-white">
    <!-- Header -->
    <header class="absolute inset-x-0 top-0 z-50">
      <nav class="flex items-center justify-between p-6 lg:px-8" aria-label="Global">
        <div class="flex lg:flex-1">
          <a href="#" class="-m-1.5 p-1.5">
            <span class="sr-only">Your Company</span>
            <img class="h-8 w-auto" src="https://tailwindui.com/img/logos/mark.svg?color=indigo&shade=600" alt="" />
          </a>
        </div>
        <div class="flex lg:hidden">
          <button type="button" class="-m-2.5 inline-flex items-center justify-center rounded-md p-2.5 text-gray-700" @click="mobileMenuOpen = true">
            <span class="sr-only">Open main menu</span>
            <Bars3Icon class="h-6 w-6" aria-hidden="true" />
          </button>
        </div>
        <!-- <div class="hidden lg:flex lg:gap-x-12">
          <a v-for="item in navigation" :key="item.name" :href="item.href" class="text-sm font-semibold leading-6 text-gray-900">{{ item.name }}</a>
        </div> -->
        <div class="hidden lg:flex lg:flex-1 lg:justify-end">
          <Link :href="route('login')" class="text-sm font-semibold leading-6 text-gray-900">Log in <span aria-hidden="true">&rarr;</span></Link>
        </div>
      </nav>
      <Dialog as="div" class="lg:hidden" @close="mobileMenuOpen = false" :open="mobileMenuOpen">
        <div class="fixed inset-0 z-50" />
        <DialogPanel class="fixed inset-y-0 right-0 z-50 w-full overflow-y-auto bg-white px-6 py-6 sm:max-w-sm sm:ring-1 sm:ring-gray-900/10">
          <div class="flex items-center justify-between">
            <a href="#" class="-m-1.5 p-1.5">
              <span class="sr-only">Your Company</span>
              <img class="h-8 w-auto" src="https://tailwindui.com/img/logos/mark.svg?color=indigo&shade=600" alt="" />
            </a>
            <button type="button" class="-m-2.5 rounded-md p-2.5 text-gray-700" @click="mobileMenuOpen = false">
              <span class="sr-only">Close menu</span>
              <XMarkIcon class="h-6 w-6" aria-hidden="true" />
            </button>
          </div>
          <div class="mt-6 flow-root">
            <div class="-my-6 divide-y divide-gray-500/10">
              <div class="space-y-2 py-6">
                <a v-for="item in navigation" :key="item.name" :href="item.href" class="-mx-3 block rounded-lg py-2 px-3 text-base font-semibold leading-7 text-gray-900 hover:bg-gray-50">{{ item.name }}</a>
              </div>
              <div class="py-6">
                <Link :href="route('login')" class="-mx-3 block rounded-lg py-2.5 px-3 text-base font-semibold leading-7 text-gray-900 hover:bg-gray-50">Log in</Link>
              </div>
            </div>
          </div>
        </DialogPanel>
      </Dialog>
    </header>

    <main class="isolate">
      <!-- Hero section -->
      <div class="relative pt-14">
        <div class="absolute inset-x-0 -top-40 -z-10 transform-gpu overflow-hidden blur-3xl sm:-top-80">
          <svg class="relative left-[calc(50%-11rem)] -z-10 h-[21.1875rem] max-w-none -translate-x-1/2 rotate-[30deg] sm:left-[calc(50%-30rem)] sm:h-[42.375rem]" viewBox="0 0 1155 678">
            <path fill="url(#9b2541ea-d39d-499b-bd42-aeea3e93f5ff)" fill-opacity=".3" d="M317.219 518.975L203.852 678 0 438.341l317.219 80.634 204.172-286.402c1.307 132.337 45.083 346.658 209.733 145.248C936.936 126.058 882.053-94.234 1031.02 41.331c119.18 108.451 130.68 295.337 121.53 375.223L855 299l21.173 362.054-558.954-142.079z" />
            <defs>
              <linearGradient id="9b2541ea-d39d-499b-bd42-aeea3e93f5ff" x1="1155.49" x2="-78.208" y1=".177" y2="474.645" gradientUnits="userSpaceOnUse">
                <stop stop-color="#9089FC" />
                <stop offset="1" stop-color="#FF80B5" />
              </linearGradient>
            </defs>
          </svg>
        </div>
        <div class="py-24 sm:py-32">
          <div class="mx-auto max-w-7xl px-6 lg:px-8">
            <div class="mx-auto max-w-2xl text-center">
              <h1 class="text-4xl font-bold tracking-tight text-gray-900 sm:text-6xl">Transform data directly in your PostgreSQL database.</h1>
              <p class="mt-6 text-lg leading-8 text-gray-600">
              Simply write your select statement and let us do the rest from table creation, to data syncs and seamless status and error reporting.</p>
              <div class="mt-10 flex items-center justify-center gap-x-6">
                <Link :href="route('register')" class="rounded-md bg-indigo-600 px-3.5 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Get started</Link>
                <a href="#" class="text-sm font-semibold leading-6 text-gray-900">Watch a demo <span aria-hidden="true">→</span></a>
              </div>
            </div>
          <!--   <div class="mt-16 flow-root sm:mt-24">
              <div class="-m-2 rounded-xl bg-gray-900/5 p-2 ring-1 ring-inset ring-gray-900/10 lg:-m-4 lg:rounded-2xl lg:p-4">
                <img src="https://tailwindui.com/img/component-images/project-app-screenshot.png" alt="App screenshot" width="2432" height="1442" class="rounded-md shadow-2xl ring-1 ring-gray-900/10" />
              </div>
            </div> -->
          </div>
        </div>
        <div class="absolute inset-x-0 top-[calc(100%-13rem)] -z-10 transform-gpu overflow-hidden blur-3xl sm:top-[calc(100%-30rem)]">
          <svg class="relative left-[calc(50%+3rem)] h-[21.1875rem] max-w-none -translate-x-1/2 sm:left-[calc(50%+36rem)] sm:h-[42.375rem]" viewBox="0 0 1155 678">
            <path fill="url(#b9e4a85f-ccd5-4151-8e84-ab55c66e5aa1)" fill-opacity=".3" d="M317.219 518.975L203.852 678 0 438.341l317.219 80.634 204.172-286.402c1.307 132.337 45.083 346.658 209.733 145.248C936.936 126.058 882.053-94.234 1031.02 41.331c119.18 108.451 130.68 295.337 121.53 375.223L855 299l21.173 362.054-558.954-142.079z" />
            <defs>
              <linearGradient id="b9e4a85f-ccd5-4151-8e84-ab55c66e5aa1" x1="1155.49" x2="-78.208" y1=".177" y2="474.645" gradientUnits="userSpaceOnUse">
                <stop stop-color="#9089FC" />
                <stop offset="1" stop-color="#FF80B5" />
              </linearGradient>
            </defs>
          </svg>
        </div>
      </div>

      <!-- Logo cloud -->
      <!-- <div class="mx-auto max-w-7xl px-6 lg:px-8">
        <div class="mx-auto grid max-w-lg grid-cols-4 items-center gap-x-8 gap-y-12 sm:max-w-xl sm:grid-cols-6 sm:gap-x-10 sm:gap-y-14 lg:mx-0 lg:max-w-none lg:grid-cols-5">
          <img class="col-span-2 max-h-12 w-full object-contain lg:col-span-1" src="https://tailwindui.com/img/logos/158x48/transistor-logo-gray-900.svg" alt="Transistor" width="158" height="48" />
          <img class="col-span-2 max-h-12 w-full object-contain lg:col-span-1" src="https://tailwindui.com/img/logos/158x48/reform-logo-gray-900.svg" alt="Reform" width="158" height="48" />
          <img class="col-span-2 max-h-12 w-full object-contain lg:col-span-1" src="https://tailwindui.com/img/logos/158x48/tuple-logo-gray-900.svg" alt="Tuple" width="158" height="48" />
          <img class="col-span-2 max-h-12 w-full object-contain sm:col-start-2 lg:col-span-1" src="https://tailwindui.com/img/logos/158x48/savvycal-logo-gray-900.svg" alt="SavvyCal" width="158" height="48" />
          <img class="col-span-2 col-start-2 max-h-12 w-full object-contain sm:col-start-auto lg:col-span-1" src="https://tailwindui.com/img/logos/158x48/statamic-logo-gray-900.svg" alt="Statamic" width="158" height="48" />
        </div>
        <div class="mt-16 flex justify-center">
          <p class="relative rounded-full px-4 py-1.5 text-sm leading-6 text-gray-600 ring-1 ring-inset ring-gray-900/10 hover:ring-gray-900/20">
            <span class="hidden md:inline">Transistor saves up to $40,000 per year, per employee by working with us.</span>
            <a href="#" class="font-semibold text-indigo-600"><span class="absolute inset-0" aria-hidden="true" /> Read our case study <span aria-hidden="true">&rarr;</span></a>
          </p>
        </div>
      </div> -->

      <!-- Feature section -->
      <div class="mx-auto mt-32 max-w-7xl px-6 sm:mt-56 lg:px-8">
        <div class="mx-auto max-w-2xl lg:text-center">
          <!-- <h2 class="text-base font-semibold leading-7 text-indigo-600">Everything you need and nothing you don't</h2> -->
          <p class="mt-2 text-3xl font-bold tracking-tight text-gray-900 sm:text-4xl">QuerySimple takes care of table creation, data syncs, scheduling and error reporting so you can focus on what matters the most your transformation query.</p>
        </div>
        <div class="mx-auto mt-16 max-w-2xl sm:mt-20 lg:mt-24 lg:max-w-4xl">
          <dl class="grid max-w-xl grid-cols-1 gap-y-10 gap-x-8 lg:max-w-none lg:grid-cols-2 lg:gap-y-16">
            <div v-for="feature in features" :key="feature.name" class="relative pl-16">
              <dt class="text-base font-semibold leading-7 text-gray-900">
                <div class="absolute top-0 left-0 flex h-10 w-10 items-center justify-center rounded-lg bg-indigo-600">
                  <component :is="feature.icon" class="h-6 w-6 text-white" aria-hidden="true" />
                </div>
                {{ feature.name }}
              </dt>
              <dd class="mt-2 text-base leading-7 text-gray-600">{{ feature.description }}</dd>
            </div>
          </dl>
        </div>
      </div>

      <!-- Testimonial section -->
      <!-- <div class="mx-auto mt-32 max-w-7xl sm:mt-56 sm:px-6 lg:px-8">
        <div class="relative overflow-hidden bg-gray-900 py-20 px-6 shadow-xl sm:rounded-3xl sm:py-24 sm:px-10 md:px-12 lg:px-20">
          <img class="absolute inset-0 h-full w-full object-cover brightness-150 saturate-0" src="https://images.unsplash.com/photo-1601381718415-a05fb0a261f3?ixid=MXwxMjA3fDB8MHxwcm9maWxlLXBhZ2V8ODl8fHxlbnwwfHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=1216&q=80" alt="" />
          <div class="absolute inset-0 bg-gray-900/90 mix-blend-multiply" />
          <svg viewBox="0 0 1097 845" aria-hidden="true" class="absolute -top-56 -left-80 w-[68.5625rem] transform-gpu blur-3xl">
            <path fill="url(#68eb76c4-2bc9-4928-860e-70adf05719f4)" fill-opacity=".45" d="M301.174 646.641 193.541 844.786 0 546.172l301.174 100.469 193.845-356.855c1.241 164.891 42.802 431.935 199.124 180.978 195.402-313.696 143.295-588.18 284.729-419.266 113.148 135.13 124.068 367.989 115.378 467.527L811.753 372.553l20.102 451.119-530.681-177.031Z" />
            <defs>
              <linearGradient id="68eb76c4-2bc9-4928-860e-70adf05719f4" x1="1097.04" x2="-141.165" y1=".22" y2="363.075" gradientUnits="userSpaceOnUse">
                <stop stop-color="#776FFF" />
                <stop offset="1" stop-color="#FF4694" />
              </linearGradient>
            </defs>
          </svg>
          <svg viewBox="0 0 1097 845" aria-hidden="true" class="hidden md:absolute md:bottom-16 md:left-[50rem] md:block md:w-[68.5625rem] md:transform-gpu md:blur-3xl">
            <path fill="url(#68eb76c4-2bc9-4928-860e-70adf05719f4)" fill-opacity=".25" d="M301.174 646.641 193.541 844.786 0 546.172l301.174 100.469 193.845-356.855c1.241 164.891 42.802 431.935 199.124 180.978 195.402-313.696 143.295-588.18 284.729-419.266 113.148 135.13 124.068 367.989 115.378 467.527L811.753 372.553l20.102 451.119-530.681-177.031Z" />
          </svg>
          <div class="relative mx-auto max-w-2xl lg:mx-0">
            <img class="h-12 w-auto" src="https://tailwindui.com/img/logos/workcation-logo-white.svg" alt="" />
            <figure>
              <blockquote class="mt-6 text-lg font-semibold text-white sm:text-xl sm:leading-8">
                <p>“Amet amet eget scelerisque tellus sit neque faucibus non eleifend. Integer eu praesent at a. Ornare arcu gravida natoque erat et cursus tortor consequat at. Vulputate gravida sociis enim nullam ultricies habitant malesuada lorem ac.”</p>
              </blockquote>
              <figcaption class="mt-6 text-base text-white">
                <div class="font-semibold">Judith Black</div>
                <div class="mt-1">CEO of Tuple</div>
              </figcaption>
            </figure>
          </div>
        </div>
      </div> -->

      <!-- Pricing section rounded-3xl -->
      <div class="py-24 sm:pt-48">
        <div class="mx-auto max-w-7xl px-6 lg:px-8">
          <div class="mx-auto max-w-4xl text-center">
            <!-- <h2 class="text-base font-semibold leading-7 text-indigo-600">Pricing</h2> -->
            <p class="mt-2 text-4xl font-bold tracking-tight text-gray-900 sm:text-5xl">Pricing plans for teams of&nbsp;all&nbsp;sizes</p>
          </div>
          <p class="mx-auto mt-6 max-w-2xl text-center text-lg leading-8 text-gray-600">We aren't here to suck the blood out of you. We are striving hard for honest pricing plan so we are able to serve you the best. What costs us money will cost you money, we will never bloat up the price artificially.</p>
          <div class="isolate mx-auto mt-16 grid max-w-md grid-cols-1 gap-y-8 sm:mt-20 lg:mx-0 lg:max-w-none lg:grid-cols-3">
            <div v-for="(tier, tierIdx) in tiers" :key="tier.id" :class="[tier.mostPopular ? 'lg:z-10 lg:rounded-b-none' : 'lg:mt-8', tierIdx === 0 ? 'lg:rounded-r-none' : '', tierIdx === tiers.length - 1 ? 'lg:rounded-l-none' : '', 'flex flex-col justify-between  bg-white p-8 ring-1 ring-gray-200 xl:p-10']">
              <div>
                <div class="flex items-center justify-between gap-x-4">
                  <h3 :id="tier.id" :class="[tier.mostPopular ? 'text-indigo-600' : 'text-gray-900', 'text-lg font-semibold leading-8']">{{ tier.name }}</h3>
                  <p v-if="tier.mostPopular" class="rounded-full bg-indigo-600/10 py-1 px-2.5 text-xs font-semibold leading-5 text-indigo-600">Most popular</p>
                </div>
                <p class="mt-4 text-sm leading-6 text-gray-600">{{ tier.description }}</p>
                <p class="mt-6 flex items-baseline gap-x-1">
                  <span class="text-4xl font-bold tracking-tight text-gray-900">{{ tier.priceMonthly }}</span>
                  <span class="text-sm font-semibold leading-6 text-gray-600">/month</span>
                </p>
                <ul role="list" class="mt-8 space-y-3 text-sm leading-6 text-gray-600">
                  <li v-for="feature in tier.features" :key="feature" class="flex gap-x-3">
                    <CheckIcon class="h-6 w-5 flex-none text-indigo-600" aria-hidden="true" />
                    {{ feature }}
                  </li>
                </ul>
              </div>
              <!-- <a :href="tier.href" :aria-describedby="tier.id" :class="[tier.mostPopular ? 'bg-indigo-600 text-white shadow-sm hover:bg-indigo-500' : 'text-indigo-600 ring-1 ring-inset ring-indigo-200 hover:ring-indigo-300', 'mt-8 block rounded-md py-2 px-3 text-center text-sm font-semibold leading-6 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600']">Buy plan</a> -->
            </div>
          </div>
        </div>
      </div>

      <!-- FAQs -->
      <div class="mx-auto max-w-2xl divide-y divide-gray-900/10 px-6 pb-8 sm:pt-12 sm:pb-24 lg:max-w-7xl lg:px-8 lg:pb-32">
        <h2 class="text-2xl font-bold leading-10 tracking-tight text-gray-900">Frequently asked questions</h2>
        <dl class="mt-10 space-y-8 divide-y divide-gray-900/10">
          <div v-for="faq in faqs" :key="faq.id" class="pt-8 lg:grid lg:grid-cols-12 lg:gap-8">
            <dt class="text-base font-semibold leading-7 text-gray-900 lg:col-span-5">{{ faq.question }}</dt>
            <dd class="mt-4 lg:col-span-7 lg:mt-0">
              <p class="text-base leading-7 text-gray-600">{{ faq.answer }}</p>
            </dd>
          </div>
        </dl>
      </div>

      <!-- CTA section -->
      <div class="relative -z-10 mt-32 px-6 lg:px-8">
        <div class="absolute inset-x-0 top-1/2 -z-10 flex -translate-y-1/2 transform-gpu justify-center overflow-hidden blur-3xl sm:right-[calc(50%-6rem)] sm:top-auto sm:bottom-0 sm:translate-y-0 sm:transform-gpu sm:justify-end">
          <svg viewBox="0 0 1108 632" aria-hidden="true" class="w-[69.25rem] flex-none">
            <path fill="url(#191ef669-4d29-44ea-9496-5d65eb27150d)" fill-opacity=".25" d="M235.233 229.055 57.541 310.091.83.615l234.404 228.44L555.251 83.11c-65.036 115.261-134.286 322.756 109.01 230.655C968.382 198.638 1031-19.583 1092.23 172.304c48.98 153.51-34.51 321.107-82.37 385.717L810.952 307.442 648.261 631.576 235.233 229.055Z" />
            <defs>
              <linearGradient id="191ef669-4d29-44ea-9496-5d65eb27150d" x1="1220.59" x2="-85.053" y1="198.898" y2="-7.05" gradientUnits="userSpaceOnUse">
                <stop stop-color="#9089FC" />
                <stop offset="1" stop-color="#FF80B5" />
              </linearGradient>
            </defs>
          </svg>
        </div>
        <div class="mx-auto max-w-2xl text-center">
          <h2 class="text-3xl font-bold tracking-tight text-gray-900 sm:text-4xl">Ready to transform your data?<br />Start using our service today.</h2>
          <!-- <p class="mx-auto mt-6 max-w-xl text-lg leading-8 text-gray-600">Incididunt sint fugiat pariatur cupidatat consectetur sit cillum anim id veniam aliqua proident excepteur commodo do ea.</p> -->
          <div class="mt-10 flex items-center justify-center gap-x-6">
            <Link :href="route('register')" class="rounded-md bg-indigo-600 px-3.5 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Try it free!</Link>
            <a href="#" class="text-sm font-semibold leading-6 text-gray-900">Questions? Get in touch <span aria-hidden="true">→</span></a>
          </div>
        </div>
        <div class="absolute left-1/2 right-0 top-full -z-10 hidden -translate-y-1/2 transform-gpu overflow-hidden blur-3xl sm:block">
          <svg viewBox="0 0 1155 678" aria-hidden="true" class="w-[72.1875rem]">
            <path fill="url(#23e1b96e-c791-45fa-975a-a04d29498207)" fill-opacity=".3" d="M317.219 518.975 203.852 678 0 438.341l317.219 80.634 204.172-286.402c1.307 132.337 45.083 346.658 209.733 145.248C936.936 126.058 882.053-94.234 1031.02 41.331c119.18 108.451 130.68 295.337 121.53 375.223L855 299l21.173 362.054-558.954-142.079Z" />
            <defs>
              <linearGradient id="23e1b96e-c791-45fa-975a-a04d29498207" x1="1155.49" x2="-78.208" y1=".177" y2="474.645" gradientUnits="userSpaceOnUse">
                <stop stop-color="#9089FC" />
                <stop offset="1" stop-color="#FF80B5" />
              </linearGradient>
            </defs>
          </svg>
        </div>
      </div>
    </main>

    <!-- Footer -->
    <!-- <div class="mx-auto mt-32 max-w-7xl px-6 lg:px-8">
      <footer aria-labelledby="footer-heading" class="relative border-t border-gray-900/10 py-24 sm:mt-56 sm:py-32">
        <h2 id="footer-heading" class="sr-only">Footer</h2>
        <div class="xl:grid xl:grid-cols-3 xl:gap-8">
          <img class="h-7" src="https://tailwindui.com/img/logos/mark.svg?color=indigo&shade=600" alt="Company name" />
          <div class="mt-16 grid grid-cols-2 gap-8 xl:col-span-2 xl:mt-0">
            <div class="md:grid md:grid-cols-2 md:gap-8">
              <div>
                <h3 class="text-sm font-semibold leading-6 text-gray-900">Solutions</h3>
                <ul role="list" class="mt-6 space-y-4">
                  <li v-for="item in footerNavigation.solutions" :key="item.name">
                    <a :href="item.href" class="text-sm leading-6 text-gray-600 hover:text-gray-900">{{ item.name }}</a>
                  </li>
                </ul>
              </div>
              <div class="mt-10 md:mt-0">
                <h3 class="text-sm font-semibold leading-6 text-gray-900">Support</h3>
                <ul role="list" class="mt-6 space-y-4">
                  <li v-for="item in footerNavigation.support" :key="item.name">
                    <a :href="item.href" class="text-sm leading-6 text-gray-600 hover:text-gray-900">{{ item.name }}</a>
                  </li>
                </ul>
              </div>
            </div>
            <div class="md:grid md:grid-cols-2 md:gap-8">
              <div>
                <h3 class="text-sm font-semibold leading-6 text-gray-900">Company</h3>
                <ul role="list" class="mt-6 space-y-4">
                  <li v-for="item in footerNavigation.company" :key="item.name">
                    <a :href="item.href" class="text-sm leading-6 text-gray-600 hover:text-gray-900">{{ item.name }}</a>
                  </li>
                </ul>
              </div>
              <div class="mt-10 md:mt-0">
                <h3 class="text-sm font-semibold leading-6 text-gray-900">Legal</h3>
                <ul role="list" class="mt-6 space-y-4">
                  <li v-for="item in footerNavigation.legal" :key="item.name">
                    <a :href="item.href" class="text-sm leading-6 text-gray-600 hover:text-gray-900">{{ item.name }}</a>
                  </li>
                </ul>
              </div>
            </div>
          </div>
        </div>
      </footer>
    </div> -->
  </div>
</template>

<script setup>
import { ref } from 'vue'
import { Head, Link } from '@inertiajs/vue3'; 
import { Dialog, DialogPanel } from '@headlessui/vue'
import {
  ArrowPathIcon,
  Bars3Icon,
  CloudArrowUpIcon,
  FingerPrintIcon,
  LockClosedIcon,
  XMarkIcon,
  ShieldExclamationIcon,
  QuestionMarkCircleIcon,
  UserGroupIcon,
  FaceSmileIcon,
} from '@heroicons/vue/24/outline'
import { CheckIcon } from '@heroicons/vue/20/solid'

const navigation = [
  { name: 'Product', href: '#' },
  { name: 'Features', href: '#' },
  { name: 'Marketplace', href: '#' },
  { name: 'Company', href: '#' },
]
const features = [
  {
    name: 'Two query types',
    description:
      '1. select statements complex or simple that get created as tables and the data syncs seamlessly. 2. insert/update/delete statements that run at a periodic schedule.',
    icon: QuestionMarkCircleIcon,
  },
  {
    name: 'Organize and Collaborate',
    description:
      'With team feature, create one or more teams to organize your transformation projects, invite one or more teammates and collaborate seamlessly.',
    icon: UserGroupIcon,
  },
  {
    name: 'Security',
    description:
      'From 2FA that protects your account to encrypted database, giving you complere peace of mind.',
    icon: LockClosedIcon,
  },
  {
    name: 'Data updates',
    description:
      'With queries running at as low as 1 hour frequency, your dashboards are kept refreshed just like that.',
    icon: ArrowPathIcon,
  },
  {
    name: 'Status and error reporting',
    description:
      'The worst thing when a query fails is not that it failed but to know it from the dashboard consumer!',
    icon: ShieldExclamationIcon,
  },
  {
    name: 'Friendly and humane support',
    description:
      'Always humans never bots. We love our customers and we will treat them the way we like being treated. Have any question? concerns? or just want to say "hi" we are always there.',
    icon: FaceSmileIcon,
  },
]
const tiers = [
  {
    name: 'Small Team',
    id: 'tier-freelancer',
    href: '#',
    priceMonthly: '$29',
    description: 'Low cost plan to help you get started without worrying about the cost.',
    features: [
      'Unlimited teams',
      'Unlimited team members',
      '10 minute query execution time per day',
      'Unlimited queries (limited by execution time)',
      'Email support',
      
    ],
    mostPopular: false,
  },
  {
    name: 'Business',
    id: 'tier-startup',
    href: '#',
    priceMonthly: '$49',
    description: 'A plan that scales with your rapidly growing business.',
    features: [
      'Unlimited teams',
      'Unlimited team members',
      '1 hour query execution time per day',
      'Unlimited queries (limited by execution time)',
      'Email and zoom support (introductory offer)',
      
    ],
    mostPopular: false,
  },
  {
    name: 'Big Business',
    id: 'tier-enterprise',
    href: '#',
    priceMonthly: '$99',
    description: 'Dedicated support and infrastructure for your company.',
    features: [
      'Unlimited teams',
      'Unlimited team members',
      '3 hour query execution time per day',
      'Unlimited queries (limited by execution time)',
      'Email and zoom support (introductory offer)',
      
    ],
    mostPopular: false,
  },
]
const faqs = [
  {
    id: 1,
    question: "Do you charge per person?",
    answer:
      "No, if you signup and create a team you will be charged based on the pan you choose. You may invite other teammates, but that doesn't cost you money. So its like an organization paying for the service. Your terammates can also create and collaborate on the queries without any additional charge.",
  },
  {
    id: 2,
    question: "What is the query execution time limit?",
    answer:
      "Its the total time taken by all of your queries to execute. So, you may run 10 queries that takes a total time of 5 minutes or it may take 20 minutes. The plan you choose should support this total time. Don't worry as you may not know this to begin with, you can just get started and we'll calculate this for you. And we won't stop your queries if it takes more time. We will let you know.",
  },
  {
    id: 3,
    question: "Do you have a free plan?",
    answer:
      "Unfortunately we don't. You may try our service for a month at no cost but we don't have a forever free plan. We are a small business and rely on your support to stay viable. ",
  },
  // More questions...
]
const footerNavigation = {
  solutions: [
    { name: 'Hosting', href: '#' },
    { name: 'Data Services', href: '#' },
    { name: 'Uptime Monitoring', href: '#' },
    { name: 'Enterprise Services', href: '#' },
  ],
  support: [
    { name: 'Pricing', href: '#' },
    { name: 'Documentation', href: '#' },
    { name: 'Guides', href: '#' },
    { name: 'API Reference', href: '#' },
  ],
  company: [
    { name: 'About', href: '#' },
    { name: 'Blog', href: '#' },
    { name: 'Jobs', href: '#' },
    { name: 'Press', href: '#' },
    { name: 'Partners', href: '#' },
  ],
  legal: [
    { name: 'Claim', href: '#' },
    { name: 'Privacy', href: '#' },
    { name: 'Terms', href: '#' },
  ],
}

const mobileMenuOpen = ref(false)
</script>