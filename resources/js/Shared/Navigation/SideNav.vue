<template>
    <nav class="text-right">
        <div class="text-center">
            <h1 class="font-bold uppercase p-4 border-b border-gray-100">
                <Link href="/" class="hover:text-cyan-500" preserve-scroll="true">Company Name</Link>
            </h1>
            <div class="px-4 cursor-pointer md:hidden" id="burger" @click="showMenu">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path></svg>
            </div>
        </div>
        <ul class="text-sm mt-6 hidden md:block menu">
            <li class="text-gray-800 font-bold py-1 border-r-4" :class="{'nav__active' : $page.url.startsWith('/dashboard')}">
                <Link href="/dashboard" class="px-4 flex justify-end" preserve-scroll="true">
                    <span>Home</span>
                    <svg class="w-6 h-6 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
                </Link>
            </li>
            <li class="text-gray-800 py-1 border-r-4 " :class="{'nav__active' : $page.url.startsWith('/document/create')}">
                <Link href="/document/create" class="px-4 flex justify-end" preserve-scroll="true" >
                    <span>Create</span>
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 13h6m-3-3v6m5 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                </Link>
            </li>
            <li class="text-gray-800 py-1 border-r-4 " :class="{'nav__active' : $page.url.startsWith('/site/settings')}">
                <Link href="/site/settings" class="px-4 flex justify-end" preserve-scroll="true" >
                    <span>Settings</span>
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 13h6m-3-3v6m5 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                </Link>
            </li>
        </ul>
        <hr class="mt-5"/>
        <ul class="text-sm mt-6 hidden md:block menu" >
            <li class="text-gray-700 py-1 border-r-4 border-white" v-for="category in categories" :key="category.id">
                <h2 href="" class="px-4 flex justify-end font-bold hover:cursor-default" preserve-scroll="true">
                    <span>{{category['category']}}</span>
                    <svg class="w-6 h-6 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                </h2>
                
                <ul>
                    <li v-for="document in category['documents']">
                        <Link class="hover:font-semibold hover:underline hover:text-teal-400">{{document['document_title']}}</Link>
                    </li>
                </ul>

            </li>
        </ul>
    </nav>
</template>

<script>
import { Link } from '@inertiajs/inertia-vue3' 
import axios from 'axios'
export default {
    components: { Link },
    props: {
        documents : {
            type: String,
            default: []
        }
    },
    data() {
        return {
            categories: []
        }
    }, 
    methods: {
        showMenu() {
            const menu = document.querySelector('.menu')
            console.log(menu)
            if(menu[0].classList.contains('hidden')) {
                menu[0].classList.remove('hidden')
                menu[1].classList.remove('hidden')
            } else {
                menu[0].classList.add('hidden')
                menu[1].classList.add('hidden')
            }
        },
    },
    mounted() {
        // TODO: Fetch categories with documents
        axios.post('/api/document/categories')
        .then(response => {
            this.categories = response.data
            tester = response.data
            console.log(response.data)
        })
    }
}
</script>