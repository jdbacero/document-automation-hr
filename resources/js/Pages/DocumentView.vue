<template>
    <Head>
        <title>Document View</title>
    </Head>
        <form>

        <editor :init="{
        // plugins: 'lists link image table code help wordcount'
        plugins: 'print preview importcss searchreplace autolink autosave save directionality code visualblocks visualchars fullscreen image link media template codesample table charmap pagebreak nonbreaking anchor insertdatetime advlist lists wordcount help charmap quickbars emoticons noneditable',
        menubar: true,
        toolbar: 'fullscreen  preview save print | undo redo | bold italic underline strikethrough | fontfamily fontsize blocks | alignleft aligncenter alignright alignjustify | outdent indent |  numlist bullist | forecolor backcolor removeformat | pagebreak | charmap emoticons | insertfile image media template link anchor codesample | ltr rtl',
        autosave_ask_before_unload: true,
        autosave_interval: '30s',
        autosave_prefix: '{path}{query}-{id}-',
        autosave_restore_when_empty: false,
        autosave_retention: '2m',
        height: 500,
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
        noneditable_class: 'mceNonEditable',
        save_enablewhendirty: true,
        save_onsavecallback: (data) => {
            this.save(data)
        },
        setup: (editor) => {
                editor.on('init', function (e) {
                editor.setContent(setDocumentContent())
                
                // editor.mode.set('readonly')
            })
        }
      }" :api-key="tinymce_key"
      />
    </form>
</template>
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
            document: {
                required: true
            }
        },
        methods: {
            setDocumentContent() {
                return this.document.document_body
            },
            uploadImage(cb, value, meta) {
                            const input = document.createElement('input');
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