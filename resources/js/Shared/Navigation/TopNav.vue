<template>
    <div class="text-primary flex justify-center md:justify-end">
        <!-- <Link href="/" class="btn border-primary md:border-2 hover:bg-primary hover:text-white transition ease-out duration-500">Login</Link> -->
        <Link href="/logout" method="post" class="btn ml-2 border-sky-900 md:border-2 text-black bg-cyan-200 hover:bg-cyan-500 hover:text-white transition ease-out duration-500">Logout</Link>
    </div>
</template>
<script>
import { Link } from '@inertiajs/inertia-vue3' 
export default {
    components: { Link }
}
</script>