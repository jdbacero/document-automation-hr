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
            <input id="view_permission" type="checkbox" value="1" class="ml-3 w-4 h-4 text-blue-600 bg-gray-100 rounded border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600 align-middle">
            <label for="view_permission" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300 align-middle">Viewable by admin only</label>
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
        },
        
        /* enable automatic uploads of images represented by blob or data URIs*/
        automatic_uploads: true,
        /*
            URL of our upload handler (for more details check: https://www.tiny.cloud/docs/configure/file-image-upload/#images_upload_url)
            images_upload_url: 'postAcceptor.php',
            here we add custom filepicker only to Image dialog
        */
        file_picker_types: 'image',
        /* and here's our custom image picker*/
        file_picker_callback: (cb, value, meta) => {
            uploadImage(cb, value, meta)
        },
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
    import { store } from './../Shared/components/Store.vue'
    export default {
        layout: Layout, 
        components: {
            Head,
            'editor': Editor,
            store
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
            save() {
                // NOTE: This sets the title of the document.
                let document_title 
                while(!document_title) {
                    document_title = prompt('What is the name of this document?', 'My New Document')
                }

                tinymce.activeEditor.dom.addClass(tinymce.activeEditor.dom.select('*'), 'mceNonEditable')
                // NOTE: This gets the content and then converts double brackets to editable spans.
                let document_body = tinymce.activeEditor.getContent().concat('<p class="mceEditable"></p>')
                
                // FEATURE: Gets all the curly braces and sets them to an editable class with minimum width so that if user clears span content, it's still visible. 
                document_body = document_body.replaceAll('{{', `<span class="mceEditable" style="display:inline-block; min-width:15px">`).replaceAll('}}', '<span/>')

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
                        
                        // NOTE: Updates the global store.documents and then subsequently updates side nav
                        store.getDocuments()

                        // Clean/clear variables and inputs
                        document_data = null
                        document_title = null
                        tinymce.activeEditor.setContent('')
                        document.getElementById('document_category').value = ""
                    } else {
                        // FAIL: If there was a problem with saving
                        alert('An error has occured. Please try again or notify the developers.')
                    }
                })
                .catch(error => {
                    // FAIL: If there was a problem with saving
                    alert('An error has occured. Please try again or notify the developers.')
                    console.error(error)
                })
            },
            uploadImage(cb, value, meta) {
                const input = document.createElement('iQnput');
                input.setAttribute('type', 'file');
                input.setAttribute('accept', 'image/*');

                input.addEventListener('change', (e) => {
                    const file = e.target.files[0];

                    const reader = new FileReader();
                    reader.addEventListener('load', () => {
                    /*
                        Note: Now we need to register the blob in TinyMCEs image blob
                        registry. In the next release this part hopefully won't be
                        necessary, as we are looking to handle it internally.
                        */
                        const id = 'blobid' + (new Date()).getTime();
                        const blobCache =  tinymce.activeEditor.editorUpload.blobCache;
                        const base64 = reader.result.split(',')[1];
                        const blobInfo = blobCache.create(id, file, base64);
                        blobCache.add(blobInfo);

                        /* call the callback and populate the Title field with the file name */
                        cb(blobInfo.blobUri(), { title: file.name });
                    });
                reader.readAsDataURL(file);
            });

            input.click();
            }
        }
    }

</script>
