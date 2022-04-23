/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

import { createApp } from 'vue';

import CKEditor from '@ckeditor/ckeditor5-vue';
import ClassicEditor from "@ckeditor/ckeditor5-build-classic";
import "@ckeditor/ckeditor5-build-classic/build/translations/ru";

const app = createApp({
    name: "app",
    data() {
        return {
            editor: ClassicEditor,
            editorData: "",
            editorConfig: {
                // Run the editor with the Russian UI.
                language: "ru",
            },
        };
    },
});

app.use(CKEditor);
console.log(document.getElementById('app'));
app.mount("#app");
