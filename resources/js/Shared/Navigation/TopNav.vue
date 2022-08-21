<template>
    <div class="text-primary flex justify-center md:justify-end">
        <!-- <Link href="/" class="btn border-primary md:border-2 hover:bg-primary hover:text-white transition ease-out duration-500">Login</Link> -->
        <button class="btn focus:outline-none hover:text-blue hover:bg-blue hover:bg-opacity-20" @click="$emit('darkToggle')">
            <svg v-if="this.$parent.isDark" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"></path></svg>
            <svg v-if="!this.$parent.isDark" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
        </button>
        <Link href="/logout" method="post" class="place-self-center btn ml-2 border-sky-900 md:border-2 text-black bg-cyan-200 hover:bg-cyan-500 hover:text-white transition ease-out duration-500">Logout</Link>
    </div>
</template>
<script>
import { Link } from '@inertiajs/inertia-vue3' 
export default {
    components: { Link },
}
</script>