<template>
    <Head>
        <title>Document Creator</title>
    </Head>
    <form>
        <div class="input-group">
            <label for="document-category" class="label-input">Document Category</label>
            <input name="document-category" id="document_category" placeholder="Document Category" list="document-category" class="mb-4 rounded-text-input motion-safe:animate-pulse">
            <datalist id="document-category">
                <!-- TODO: LOOP CATEGORIES FROM APPROPRIATE VARIABLE -->
                <option v-for="document_category in document_categories" :key="document_category.id">{{document_category}}</option>
            </datalist>
        </div>
        <!-- NOTE: This commented div is supposed to be for document title. Going for JS alert instead temporarily. -->
        <!-- <div class="input-group ml-3">
            <label for="document_title" class="label-input">Document Title</label>
            <input type="text" placeholder="Document Title" name="document_title" class="rounded-text-input motion-safe:animate-pulse">
        </div> -->
        <editor :init="{
        // plugins: 'lists link image table code help wordcount'
          plugins: 'save print preview importcss searchreplace autolink autosave save directionality code visualblocks visualchars fullscreen image link media template codesample table charmap pagebreak nonbreaking anchor insertdatetime advlist lists wordcount help charmap quickbars emoticons',
        menubar: 'file edit view insert format tools table help',
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
                type: String,
                required: true
            },
            // NOTE: document_categories gets data from DB, otherwise set as default
            document_categories: {
                default: ['Onboarding', 'Hiring', 'Management'],
                required: false
            }
        },
        methods: {
            save(data) {
                // NOTE: This sets the title of the document.
                let document_title 
                while(!document_title) {
                    document_title = prompt('What is the name of this document?', 'My New Document')
                }
                // NOTE: This gets the content and then converts double brackets to editable spans.
                let document_body = tinymce.activeEditor.getContent()
                document_body = document_body.replaceAll('{{', '<span class="mceEditable">').replaceAll('}}', '<span/>')
                let document_data = {
                    document_body: document_body,
                    document_title: document_title,
                    document_category: document.getElementById('document_category').value
                }
                console.log(document_data)

                axios.post('/api/document/save', document_data)
                .then(response => {
                        // OPTIONAL: Show toast if error or successful on save
                    console.log(response.data)
                    if(response.data) {
                        // SUCCESS: If successfully saved
                        alert(`Document saved.`)
                        location.reload()
                    } else {
                        // FAIL: If there was a problem with saving
                        alert('An error has occured. Please try again or notify the developers.')
                    }
                })
                .catch(error => {
                    // FAIL: If there was a problem with saving
                    alert('An error has occured. Please try again or notify the developers.')
                    console.log(error)
                })
            }
        },
        data() {
            return {
            }
        }
    }

</script>
