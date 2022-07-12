<template>
<!-- Content wrapper -->
<div class="text-gray-600 h-screen font-mono grid md:grid-cols-3 lg:grid-cols-6">
    <div class="md:col-span-1 md:flex md:justify-end">
        <SideNav />
    </div>
    <main class="px-16 py-6 bg-gray-100 lg:col-span-5 md:col-span-2">
        <TopNav />
        <slot />
    </main>
</div>
<!-- Footer -->
<footer class="inset-x-0 bottom-0">
    <div class="text-gray-700 text-center p-4" style="background-color: rgba(0, 0, 0, 0.2);">
        © 2021 Copyright:
        <a class="text-gray-800" href="">jdbacero</a>
    </div>
</footer>
<!-- Footer end -->

</template>

<script>
import TopNav from './Navigation/TopNav.vue'
import SideNav from './Navigation/SideNav.vue'
export default {
    components: { SideNav, TopNav }
}
</script>