<template>
    <Head>
        <title>Kamusta, mundo</title>
    </Head>
    <h1 class="text-xl">Hello, World</h1>
    <h1 class="text-l">World</h1>
</template>

<script>
import Layout from '../Shared/Layout.vue'
import { Head } from '@inertiajs/inertia-vue3'
export default {
    layout: Layout,
    components: {
        Head
    }
}
</script>