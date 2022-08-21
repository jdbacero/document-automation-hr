<template>

    <Head>
        <title>Company</title>
    </Head>
    <div class="flex flex-col relative" :class="isDark ? 'dark' : ''">
        <!-- Content wrapper -->
        <div class="text-gray-600 h-screen font-mono grid md:grid-cols-3 lg:grid-cols-6 dark:bg-gray-200">
            <div class="md:col-span-1 md:justify-end dark:bg-[#121D2F]">
                <SideNav />
            </div>
            <main class="px-16 py-6 bg-gray-100 lg:col-span-5 md:col-span-2 dark:bg-slate-800">
                <TopNav @darkToggle="toggleDark" />
                <slot />
            </main>
            <!-- Footer -->

            <footer class="p-4 bg-white shadow md:px-6 md:py-8 dark:bg-gray-900 md:col-span-3 lg:col-span-6">
                <div class="sm:flex sm:items-center sm:justify-between">
                    <a href="https://github.com/jdbacero/" class="flex items-center mb-4 sm:mb-0">
                        <img src="/svg/logo.svg" class="ml-5 h-12" alt="jdbacero logo">
                    </a>
                    <span class="block text-sm text-gray-500 sm:text-center dark:text-gray-400">© 2022 <a
                            href="https://github.com/jdbacero" class="hover:underline">jdbacero</a>. All Rights Reserved.
                    </span>
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
            </footer>
            <!-- Footer end -->
        </div>


    </div>

</template>

<script>
    import {
        Head
    } from '@inertiajs/inertia-vue3'
    import TopNav from './Navigation/TopNav.vue'
    import SideNav from './Navigation/SideNav.vue'
    import { store } from './components/Store.vue'
    export default{
        components: {
            Head, TopNav, SideNav, store
        },
        data() {
            return {
                isDark: store.isDark
            }
        },
        methods: {
            toggleDark() {
                store.isDark = store.isDark ? false : true
                this.isDark = store.isDark  
                console.log("Dark mode is: ", store.isDark)
            }
        }
    }
</script>
