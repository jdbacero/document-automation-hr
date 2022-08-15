<template>

    <Head>
        <title>Company</title>
    </Head>
    <div class="flex flex-col relative">
        <!-- Content wrapper -->
        <div class="text-gray-600 h-screen font-mono grid md:grid-cols-3 lg:grid-cols-6">
            <div class="md:col-span-1 md:flex md:justify-end">
                <SideNav />
            </div>
            <main class="px-16 py-6 bg-gray-100 lg:col-span-5 md:col-span-2">
                <TopNav />
                <slot />
            </main>
            <!-- Footer -->

            <footer class="p-4 bg-white rounded-lg shadow md:px-6 md:py-8 dark:bg-gray-900 md:col-span-3 lg:col-span-6">
                <div class="sm:flex sm:items-center sm:justify-between">
                    <a href="https://github.com/jdbacero/" class="flex items-center mb-4 sm:mb-0">
                        <img src="/svg/logo.svg" class="ml-5 h-12" alt="jdbacero logo">
                    </a>
                    <ul class="flex flex-wrap items-center mb-6 text-sm text-gray-500 sm:mb-0 dark:text-gray-400">
                        <li>
                            <a href="#" class="mr-4 hover:underline md:mr-6 ">Github</a>
                        </li>
                        <li>
                            <a href="#" class="mr-4 hover:underline md:mr-6">Some Link</a>
                        </li>
                        <li>
                            <a href="#" class="mr-4 hover:underline md:mr-6 ">Some Link 2</a>
                        </li>
                        <li>
                            <a href="#" class="hover:underline">Contact</a>
                        </li>
                    </ul>
                </div>
                <hr class="my-6 border-gray-200 sm:mx-auto dark:border-gray-700 lg:my-8">
                <span class="block text-sm text-gray-500 sm:text-center dark:text-gray-400">© 2022 <a
                        href="https://github.com/jdbacero" class="hover:underline">jdbacero</a>. All Rights Reserved.
                </span>
            </footer>
            <!-- Footer end -->
        </div>


    </div>

</template>

<script setup>
    import {
        Head
    } from '@inertiajs/inertia-vue3'
    import TopNav from './Navigation/TopNav.vue'
    import SideNav from './Navigation/SideNav.vue'

</script>
