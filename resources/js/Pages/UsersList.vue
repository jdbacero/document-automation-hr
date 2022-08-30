<template>
    <Head>
        <title>Users List</title>
    </Head>
    <div class="">
        <h4 class="font-bold mt-12 pb-2 border-b border-gray-200">Users</h4>
        <div class="mt-8 grid md:grid-cols-3 gap-10">
            <!-- Content goes here -->
            <div class="table-container col-span-3">
                <table class="table-default sortable">
                    <thead class="table-default-head">
                        <tr>
                            <th scope="col" class="py-3 px-6">
                                Name
                            </th>
                            <th scope="col" class="py-3 px-6">
                                User Type
                            </th>
                            <th scope="col" class="py-3 px-6">
                                Action
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="table-default-row" v-for="user in users" :key="user.id">
                            <td class="table-default-td">
                                {{user['name']}}
                            </td>
                            <td class="table-default-td" v-if="user['is_admin']">
                                Admin
                            </td>
                            <td class="table-default-td" v-else>
                                User
                            </td>
                            <td class="table-default-td">
                                <a 
                                    class="font-medium text-blue-600 dark:text-blue-500 hover:underline pr-3">Edit</a>
                                <a href="#"
                                    class="font-medium text-red-600 dark:text-red-500 hover:underline pl-3">Delete</a>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    
    </div>
</template>
<style>
    .tox-statusbar__branding {
        display: none;
    }
</style>
<script>
    import Layout from '../Shared/Layout.vue'
    import {
        Head
    } from '@inertiajs/inertia-vue3'

    export default {
        layout: Layout,
        components: {
            Head
        },
        props: {
            users: {
                required: true
            }
        },
        methods: {

        }
    }
</script>