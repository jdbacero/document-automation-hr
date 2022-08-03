<template>

    <Head>
        <title>Kamusta, mundo</title>
    </Head>
    <form>
        <!-- <label for="document-category">Document Category</label> -->
        <input name="document-category" placeholder="Document Category" list="document-category" class="mb-4 rounded-full text-center focus:outline-cyan-600 border-solid hover:border-cyan-300 border-2">
        <datalist id="document-category">
            <!-- TODO: LOOP CATEGORIES FROM APPROPRIATE VARIABLE -->
            <option v-for="document_category in document_categories" :key="document_category.id">{{document_category}}</option>
        </datalist>
        <editor :init="{
        // plugins: 'lists link image table code help wordcount'
          plugins: 'save print preview importcss searchreplace autolink autosave save directionality code visualblocks visualchars fullscreen image link media template codesample table charmap pagebreak nonbreaking anchor insertdatetime advlist lists wordcount help charmap quickbars emoticons',
        menubar: 'file edit view insert format tools table help',
        toolbar: 'save print | undo redo | bold italic underline strikethrough | fontfamily fontsize blocks | alignleft aligncenter alignright alignjustify | outdent indent |  numlist bullist | forecolor backcolor removeformat | pagebreak | charmap emoticons | fullscreen  preview save print | insertfile image media template link anchor codesample | ltr rtl',
        autosave_ask_before_unload: true,
        autosave_interval: '30s',
        autosave_prefix: '{path}{query}-{id}-',
        autosave_restore_when_empty: false,
        autosave_retention: '2m',
        height: 500,
        save_enablewhendirty: true,
        save_onsavecallback: (data) => {
            this.save()
        }


      }" :api-key="tinymce_key" />

    </form>
    <h1 class="text-xl">Hello, World</h1>
</template>

<style scoped>
    input::-webkit-calendar-picker-indicator {
        display: none !important;
    }
</style>

<script>
    import Layout from '../Shared/Layout.vue'
    import {
        Head
    } from '@inertiajs/inertia-vue3'
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
            },
            // TODO: Replace document category variable data source from db
        },
        methods: {
            save(data) {
                // TODO: Get data from editor and save it to DB
                console.log("saved")
                console.log(data)

                // TODO: Show toast that save was successful
            }
        },
        data() {
            return {
                content: '',
                // FIXME: Remove me after implementing the right prop
                document_categories: ['Sample Category', 'Sample Category 2', 'Sample Category 3']
            }
        }
    }

</script>
