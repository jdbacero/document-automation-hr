<template>

    <Head>
        <title>Document Creator</title>
    </Head>
    <form>
        <div class="input-group">
            <label for="document-category" class="label-input">Document Category</label>
            <input name="document-category" placeholder="Document Category" list="document-category" class="mb-4 rounded-text-input motion-safe:animate-pulse">
        </div>
        <div class="input-group ml-3">
            <label for="document_title" class="label-input">Document Title</label>
            <datalist id="document-category">
                <!-- TODO: LOOP CATEGORIES FROM APPROPRIATE VARIABLE -->
                <option v-for="document_category in document_categories" :key="document_category.id">{{document_category}}</option>
            </datalist>
            <input type="text" placeholder="Document Title" name="document_title" class="rounded-text-input motion-safe:animate-pulse">
        </div>
        <editor :init="{
        // plugins: 'lists link image table code help wordcount'
          plugins: 'save print preview importcss searchreplace autolink autosave save directionality code visualblocks visualchars fullscreen image link media template codesample table charmap pagebreak nonbreaking anchor insertdatetime advlist lists wordcount help charmap quickbars emoticons',
        menubar: 'edit view insert format tools table help',
        toolbar: 'fullscreen  preview save print | undo redo | bold italic underline strikethrough | fontfamily fontsize blocks | alignleft aligncenter alignright alignjustify | outdent indent |  numlist bullist | forecolor backcolor removeformat | pagebreak | charmap emoticons | insertfile image media template link anchor codesample | ltr rtl',
        autosave_ask_before_unload: true,
        autosave_interval: '30s',
        autosave_prefix: '{path}{query}-{id}-',
        autosave_restore_when_empty: false,
        autosave_retention: '2m',
        height: 500,
        save_enablewhendirty: true,
        save_onsavecallback: (data) => {
            this.save(data)
        }
      }" :api-key="tinymce_key" />
    </form>

</template>

<!-- Removes arrow from datalist -->
<style scoped>
    input::-webkit-calendar-picker-indicator {
        display: none !important;
    }
</style>
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
    import Editor from '@tinymce/tinymce-vue'
    import axios from 'axios'
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
                // TODO: Get data from editor and save it to 
                
                // This gets the content and then converts double brackets to editable spans later on
                let document_content = tinymce.activeEditor.getContent()
                document_content = document_content.replaceAll('{{', '<span class="mceEditable">').replaceAll('}}', '<span/>')
                axios.post('/')
                // TODO: Show toast that save was successful
            }
        },
        data() {
            return {
                // FIXME: Remove me after implementing the right prop
                document_categories: ['Sample Category', 'Sample Category 2', 'Sample Category 3']
            }
        }
    }

</script>
