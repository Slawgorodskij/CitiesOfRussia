/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

import { createApp } from 'vue';

import selectArticleable from './components/admin/SelectArticleable.vue';
import selectImageable from './components/admin/SelectImageable.vue';
import imagesUpload from './components/admin/ImagesUpload.vue';
import deleteButton from './components/admin/DeleteButton.vue';

const app = createApp({})

app.component('select-articleable', selectArticleable)
    .component('select-imageable', selectImageable)
    .component('images-upload', imagesUpload)
    .component('delete-button', deleteButton);

app.mount("#app")
