<template>
    <Head>
        <title>Kamusta, mundo</title>
    </Head>
        <editor
      :init="{
        // plugins: 'lists link image table code help wordcount'
          plugins: 'save print preview importcss searchreplace autolink autosave save directionality code visualblocks visualchars fullscreen image link media template codesample table charmap pagebreak nonbreaking anchor insertdatetime advlist lists wordcount help charmap quickbars emoticons',
        menubar: 'file edit view insert format tools table help',
        toolbar: 'save print | undo redo | bold italic underline strikethrough | fontfamily fontsize blocks | alignleft aligncenter alignright alignjustify | outdent indent |  numlist bullist | forecolor backcolor removeformat | pagebreak | charmap emoticons | fullscreen  preview save print | insertfile image media template link anchor codesample | ltr rtl',
        autosave_ask_before_unload: true,
        autosave_interval: '30s',
        autosave_prefix: '{path}{query}-{id}-',
        autosave_restore_when_empty: false,
        autosave_retention: '2m',
        height: 500


      }"
      :api-key="tinymce_key"
    />
    <h1 class="text-xl">Hello, World</h1>
</template>

<script>
import Layout from '../Shared/Layout.vue'
import { Head } from '@inertiajs/inertia-vue3'
import Editor from '@tinymce/tinymce-vue'
export default {
    layout: Layout,
    components: {
        Head,
        'editor': Editor
    },
    props: {
        tinymce_key: {
            type: String
        }
    },
}
</script>