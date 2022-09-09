<template>
    <!-- Paginator -->
    <div
        class="flex items-center justify-between border-t border-gray-200 bg-white px-4 py-3 sm:px-6 dark:bg-slate-600">
        <div class="flex flex-1 justify-between sm:hidden">
            <a href="#"
                class="relative inline-flex items-center rounded-md border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50">Previous</a>
            <a href="#"
                class="relative ml-3 inline-flex items-center rounded-md border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50">Next</a>
        </div>
        <div class="hidden sm:flex sm:flex-1 sm:items-center sm:justify-between">
            <div>
                <p class="text-sm text-gray-700">
                    Showing
                    <span class="font-medium">{{this.items.from}}</span>
                    to
                    <span class="font-medium">{{this.items.to}}</span>
                    of
                    <span class="font-medium">{{ this.items.total }}</span>
                    results
                </p>
            </div>
            <div>
                <nav class="isolate inline-flex -space-x-px rounded-md shadow-sm" aria-label="Pagination">
                    <Component v-for="(link, index) in items.links" :is="link.url ? 'Link' : 'span'"
                        :href="link.url"
                        class="relative inline-flex items-center border border-gray-300 dark:bg-slate-800 bg-white px-2 py-2 text-sm font-medium text-gray-500 hover:bg-gray-50 focus:z-20"
                        :class="[link.active ? 'z-10 border-indigo-500 bg-indigo-50 text-indigo-600 ' : '',
                                        (index == 0) ? 'rounded-l-md' : '', (index == items.links.length-1) ? 'rounded-r-md' : '']">
                        <svg v-if="index == 0" class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                            fill="currentColor" aria-hidden="true">
                            <path fill-rule="evenodd"
                                d="M12.79 5.23a.75.75 0 01-.02 1.06L8.832 10l3.938 3.71a.75.75 0 11-1.04 1.08l-4.5-4.25a.75.75 0 010-1.08l4.5-4.25a.75.75 0 011.06.02z"
                                clip-rule="evenodd" />
                        </svg>

                        <span v-if="index > 0 && index < items.links.length-1" class="px-2">{{link.label}}</span>

                        <svg v-if="index == items.links.length-1" class="h-5 w-5" xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                            <path fill-rule="evenodd"
                                d="M7.21 14.77a.75.75 0 01.02-1.06L11.168 10 7.23 6.29a.75.75 0 111.04-1.08l4.5 4.25a.75.75 0 010 1.08l-4.5 4.25a.75.75 0 01-1.06-.02z"
                                clip-rule="evenodd" />
                        </svg>
                    </Component>
                </nav>
            </div>
        </div>
    </div>
</template>

<script>
    import { Link } from '@inertiajs/inertia-vue3';
    export default {
        components: {
            Link
        },
        props: {
            items: {
                required: true
            }
        }
    }
</script>
