<template>

    <Head>
        <title>Document Creator</title>
    </Head>
    <form>
        <div class="input-group">
            <label for="document-category" class="label-input">Document Category</label>
            <input name="document-category" id="document_category" placeholder="Document Category"
                list="document-category" class="mb-4 rounded-text-input motion-safe:animate-pulse">
            <datalist id="document-category">
                <!-- TODO: LOOP CATEGORIES FROM APPROPRIATE VARIABLE -->
                <option v-for="document_category in document_categories" :key="document_category.id">
                    {{document_category}}</option>
            </datalist>
            <input id="view_permission" type="checkbox" value="1"
                class="ml-3 w-4 h-4 text-blue-600 bg-gray-100 rounded border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600 align-middle">
            <label for="view_permission"
                class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300 align-middle">Viewable by admin
                only</label>
        </div>
        <!-- NOTE: This commented div is supposed to be for document title. Going for JS alert instead temporarily. -->
        <!-- <div class="input-group ml-3">
            <label for="document_title" class="label-input">Document Title</label>
            <input type="text" placeholder="Document Title" name="document_title" class="rounded-text-input motion-safe:animate-pulse">
        </div> -->
        <editor :init="{
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
        setup: (editor) => {
                editor.on('init', function (e) {
                    // NOTE: If editing, set document body.
                    if(document) {
                        document.document_body = document.document_body.replaceAll(`<span class='mceEditable' style='display:inline-block; min-width:15px'>`, '\{\{').replaceAll('<span/>', '}}')
                        editor.setContent(document.document_body)
                    }                
            })
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
    import {
        store
    } from './../Shared/components/Store.vue'
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
            },
            document: {
                default: false,
                required: false
            }
        },
        data() {
            return {

            }
        },
        methods: {
            save() {
                let document_title = this.document ? this.document['document_title'] : ''

                // NOTE: This sets the title of the document.
                do {
                    document_title = prompt('What is the name of this document?', document_title ? document_title :
                        'My New Document')
                } while (!document_title)

                tinymce.activeEditor.dom.addClass(tinymce.activeEditor.dom.select('*'), 'mceNonEditable')
                // NOTE: This gets the content and then converts double brackets to editable spans.
                let document_body = tinymce.activeEditor.getContent().concat('<p class="mceEditable"></p>')

                // FEATURE: Gets all the curly braces and sets them to an editable class with minimum width so that if user clears span content, it's still visible. 
                document_body = document_body.replaceAll('{{',
                    `<span class='mceEditable' style='display:inline-block; min-width:15px'>`).replaceAll('}}',
                    '<span/>')

                let document_data = {
                    document_body: document_body,
                    document_title: document_title,
                    document_category: document.getElementById('document_category').value,
                    admin_only: document.getElementById('view_permission').checked ? 1 : 0
                }


                if (this.document) {
                    // NOTE: Update if on editing mode
                    axios.put(`/api/document/update/${this.document['id']}`, document_data)
                        .then(response => {
                            this.successOrFail(response.data)
                            // NOTE: Updates the global store.documents and then subsequently updates side nav
                            store.getDocuments(true)
                        })
                        // .catch(error => {
                        //     // FAIL: HTTP Request error
                        //     alert('An error has occured. Please try again or notify the developers.')
                        //     console.error(error.data)
                        // })
                } else {
                    // NOTE: Save if creating new document
                    axios.post('/api/document/save', document_data)
                        .then(response => {
                            this.successOrFail(response.data)
                            // NOTE: Updates the global store.documents and then subsequently updates side nav
                            store.getDocuments(true)
                        })
                        // .catch(error => {
                        //     // FAIL: HTTP Request error
                        //     alert('An error has occured. Please try again or notify the developers.')
                        //     console.error(error.data)
                        // })
                }
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
                        const blobCache = tinymce.activeEditor.editorUpload.blobCache;
                        const base64 = reader.result.split(',')[1];
                        const blobInfo = blobCache.create(id, file, base64);
                        blobCache.add(blobInfo);

                        /* call the callback and populate the Title field with the file name */
                        cb(blobInfo.blobUri(), {
                            title: file.name
                        });
                    });
                    reader.readAsDataURL(file);
                });

                input.click();
            },
            successOrFail(response) {
                // OPTIONAL: Show toast if error or successful on save
                if (response) {
                    // SUCCESS: If successfully saved
                    alert(`Document saved.`)

                    // Clean/clear variables and inputs
                    document_data = null
                    document_title = null
                    tinymce.activeEditor.setContent('')
                    document.getElementById('document_category').value = ""
                } else {
                    // FAIL: If there was a problem with saving
                    alert('An error has occured. Please try again or notify the developers.')
                    console.log(response)
                }
            }
        },
        mounted() {
            if (this.document) {
                let category_el = document.querySelector('#document_category')
                category_el.value = this.document['category']['category']
            }
        }
    }

</script>
