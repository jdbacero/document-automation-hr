<template>
    <nav class="text-right dark:bg-[#121D2F]">
        <div class="text-center">
            <h1 class="font-bold uppercase p-4 border-b border-gray-100">
                <Link href="/" class="hover:text-cyan-500" preserve-scroll="true">{{ company_name }}</Link>
            </h1>
            <div class="px-4 py-3 cursor-pointer md:hidden" id="burger" @click="showMenu">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path></svg>
            </div>
        </div>
        <ul class="text-sm mt-6 hidden md:block menu">
            <li class="nav_items" :class="{'nav__active' : $page.url.startsWith('/dashboard')}">
                <Link href="/dashboard" class="px-4 flex sm:justify-start md:justify-end md:flex-row" preserve-scroll="true">
                    <span>Home</span>
                    <svg class="w-6 h-6 ml-2 order-first md:order-last" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
                </Link>
            </li>
            <li v-if="is_admin" class="nav_items" :class="{'nav__active' : $page.url.startsWith('/users/new')}">
                <Link href="/users/new" class="px-4 flex sm:justify-start md:justify-end " preserve-scroll="true" >
                    <span>Add User</span>
                    <svg class="w-6 h-6 ml-2 order-first md:order-last" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"></path></svg>
                </Link>
            </li>
            <li v-if="is_admin" class="nav_items" :class="{'nav__active' : $page.url.startsWith('/users/list')}">
                <Link href="/users/list" class="px-4 flex sm:justify-start md:justify-end " preserve-scroll="true" >
                    <span>Users</span>
                    <svg class="w-6 h-6 ml-2 order-first md:order-last" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                </Link>
            </li>
            <li v-if="is_admin" class="nav_items" :class="{'nav__active' : $page.url.startsWith('/document/create')}">
                <Link href="/document/create" class="px-4 flex sm:justify-start md:justify-end " preserve-scroll="true" >
                    <span>New Document</span>
                    <svg class="w-6 h-6 ml-2 order-first md:order-last" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 13h6m-3-3v6m5 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                </Link>
            </li>
            <li v-if="is_admin" class="nav_items" :class="{'nav__active' : $page.url.startsWith('/document/all')}">
                <Link href="/document/all" class="px-4 flex sm:justify-start md:justify-end " preserve-scroll="true" >
                    <span>Documents</span>
                    <svg class="w-6 h-6 ml-2 order-first md:order-last" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 13h6m-3-3v6m5 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                </Link>
            </li>
        </ul>
        <hr class="mt-5"/>
        <ul class="text-sm mt-6 hidden md:block menu" style="user-select: none; -moz-user-select: none; -khtml-user-select: none; -webkit-user-select: none; -o-user-select: none;">
            <li class="text-gray-700 py-1 border-white relative" v-for="category in store.documents" :key="category.id">
                <svg :id="'icon'+category.id"
                @click="toggleHide(category['category'].replace(/\s/g,''), 'icon'+category.id)"
                class="flex w-4 h-4 left-0 absolute hover:cursor-pointer ml-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 17l-4 4m0 0l-4-4m4 4V3"></path></svg>

                <h2 class="px-4 flex sm:justify-start md:justify-end font-bold hover:cursor-default" preserve-scroll="true">
                    <span class="uppercase">{{category['category']}}</span>
                    <svg class="w-6 h-6 ml-2 order-first md:order-last" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                </h2>
                <hr class="mt-1">
                <ul :id="'documents-'+category['category'].replace(/\s/g,'')">
                    <li class="nav_items md:text-right text-left pr-2 pl-3" v-for="document in category['documents']" :class="{'nav__active' : $page.url.endsWith('/document/'+document['id'])}">
                        <Link preserve-scroll="true" :href="`/document/${document['id']}`" class="">{{document['document_title']}}</Link>
                    </li>
                </ul>
            </li>
        </ul>
    </nav>
</template>

<script>
import { Link } from '@inertiajs/inertia-vue3' 
import { usePage } from '@inertiajs/inertia-vue3'
import { store } from './../components/Store.vue'
import { computed } from 'vue'
export default {
    components: { Link },
    data() {
        return {
            store
        }
    }, 
    methods: {
        showMenu() {
            const menu = document.querySelectorAll('.menu')

            if(menu[0].classList.contains('hidden')) {
                menu[0].classList.remove('hidden')
                menu[1].classList.remove('hidden')
            } else {
                menu[0].classList.add('hidden')
                menu[1].classList.add('hidden')
            }
        },
        toggleHide(category, icon) {
            const documents = document.querySelector('#documents-'+category)
            let myicon = document.querySelector('#'+icon)
            if(documents.classList.contains('hidden')) {
                documents.classList.remove('hidden')
                myicon.innerHTML = `<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 17l-4 4m0 0l-4-4m4 4V3"></path>`
            } else {
                documents.classList.add('hidden')
                myicon.innerHTML = `<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path>`
            }
        }
    },
    mounted() {
        this.store.getDocuments(this.is_admin)
    },
    computed: {
        is_admin() {
            return this.$page.props.auth.user.is_admin
        },
        company_name() {
            return this.$page.props.company_name
        }
    }
}
</script>