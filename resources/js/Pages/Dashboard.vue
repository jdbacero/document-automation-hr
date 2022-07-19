<template>
<Head>
    <title>Dashboard</title>
</Head>
<header>
    <h2 class="text-6xl font-semibold">Welcome,</h2>
        <h3 class="text-2xl font-semibold">{{name}}</h3>
</header>

<div>
    <h4 class="font-bold mt-12 pb-2 border-b border-gray-200">Some header</h4>
    
    <div class="mt-8 grid md:grid-cols-3 gap-10">
        <!-- Content goes here -->
        <div class="card hover:shadow-xl">
            <img src= "https://unsplash.it/600/400" class="w-full h-32 sm:h-48 object-cover"/>
            <div class="m-4">
                <span class="font-bold">Image Title</span>
                <span class="block text-gray-500 text-sm">Taken by Jorex</span>
            </div>
            <div class="bg-secondary-100 text-secondary-200 text-xs uppercase font-bold rounded-full p-2 absolute top-0 ml-2 mt-2">
                <svg class="w-5 h-5 inline-block mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                <span>25 mins</span>
            </div>
        </div>
        <div class="card hover:shadow-xl">
            <img src= "https://unsplash.it/600/400" class="w-full h-32 sm:h-48 object-cover"/>
            <div class="m-4">
                <span class="font-bold">Image Title</span>
                <span class="block text-gray-500 text-sm">Taken by Jorex</span>
            </div>
            <div class="bg-secondary-100 text-secondary-200 text-xs uppercase font-bold rounded-full p-2 absolute top-0 ml-2 mt-2">
                <svg class="w-5 h-5 inline-block mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                <span>25 mins</span>
            </div>
        </div>
        <div class="card hover:shadow-xl">
            <img src= "https://unsplash.it/600/400" class="w-full h-32 sm:h-48 object-cover"/>
            <div class="m-4">
                <span class="font-bold">Image Title</span>
                <span class="block text-gray-500 text-sm">Taken by Jorex</span>
            </div>
            <div class="bg-secondary-100 text-secondary-200 text-xs uppercase font-bold rounded-full p-2 absolute top-0 ml-2 mt-2">
                <svg class="w-5 h-5 inline-block mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                <span>25 mins</span>
            </div>
        </div>
    </div>

    <h4 class="font-bold mt-12 pb-2 border-b border-gray-200">Another header</h4>

    <div class="mt-8">
        <!-- Content goes here -->
    </div>

    <div class="flex justify-center">
        <div class="bg-secondary-100 text-secondary-200 btn hover:shadow-inner transform hover:scale-125 hover:bg-opacity-50">Load more..</div>
    </div>
</div>
</template>

<script>
import Layout from '../Shared/Layout.vue'
import { Head } from '@inertiajs/inertia-vue3'
export default {
    components: { Layout, Head },
    layout: Layout,
    props: {
        name: {
            type: String
        }
    }
}
</script>