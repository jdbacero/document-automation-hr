<template>

    <Head>
        <title>Dashboard</title>
    </Head>
    <header>
        <h3 class="text-2xl font-semibold">All Documents</h3>
    </header>

    <div class="">
        <h4 class="font-bold mt-12 pb-2 border-b border-gray-200">Documents</h4>

        <div class="mt-8 grid md:grid-cols-3 gap-10">
            <!-- Content goes here -->
            <div class="table-container col-span-3">
                <table class="table-default sortable">
                    <thead class="table-default-head">
                        <tr>
                            <th class="py-3 px-6">
                                Document Name
                            </th>
                            <th class="py-3 px-6">
                                Category
                            </th>
                            <th class="py-3 px-6">
                                Visibility
                            </th>
                            <th class="py-3 px-6">
                                Permissions
                            </th>
                            <th class="py-3 px-6">
                                Action
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="table-default-row" v-for="document in documents" :key="document.id">
                            <td 
                                class="table-default-td">
                                {{document["document_title"]}}
                            </td>
                            <td class="table-default-td">
                                {{document["category"]["category"]}}
                            </td>
                            <td class="table-default-td">
                                <!-- TODO: -->
                                To be implemented
                            </td>
                            <td class="table-default-td">
                                <!-- TODO: -->
                                To be implemented
                            </td>
                            <td class="table-default-td">
                                <a href="#"
                                    class="font-medium text-blue-600 dark:text-blue-500 hover:underline pr-1">Edit</a>
                                <a href="#"
                                    class="font-medium text-blue-600 dark:text-blue-500 hover:underline pl-1">Delete</a>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <h4 class="font-bold mt-12 pb-2 border-b border-gray-200">Categories</h4>
        <div class="mt-8 grid md:grid-cols-3 gap-10">
            <!-- Content goes here -->
            <div class="table-container col-span-3">
                <table class="table-default sortable">
                    <thead class="table-default-head">
                        <tr>
                            <th scope="col" class="py-3 px-6">
                                Category Name
                            </th>
                            <th scope="col" class="py-3 px-6">
                                Enabled / Disabled
                            </th>
                            <th scope="col" class="py-3 px-6">
                                Action
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="table-default-row" v-for="category in categories" :key="category.id">
                            <td class="table-default-td">
                                {{category['category']}}
                            </td>
                            <td class="table-default-td">
                                <!-- TODO: To be implemented -->
                            </td>
                            <td class="table-default-td">
                                <a href="#"
                                    class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Delete</a>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    
    </div>
</template>

<script>
    import Layout from '../Shared/Layout.vue'
    import {
        Head
    } from '@inertiajs/inertia-vue3'
    import { store } from './../Shared/components/Store.vue'
    export default {
        components: {
            Layout,
            Head
        },
        layout: Layout,
        props: {
            documents: {
                required: true
            },
            categories: {
                required: true
            }
        }, 
        data() {
        },
        created() {
            // NOTE: Adds local script
            var scripts = [
                "/js/sorttable.js"
            ];
            scripts.forEach(script => {
                let tag = document.createElement("script");
                tag.setAttribute("src", script);
                document.head.appendChild(tag);
            });
        },
        methods: {
            deleteCategory() {

                // NOTE: Updates sidenav when deleting/editing a category/document
                store.getDocuments()
            }
        }
    }

</script>
