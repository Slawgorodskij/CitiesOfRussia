/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

import {createApp} from 'vue';

import imagesUpload from './components/admin/ImagesUpload.vue';
import deleteButton from './components/admin/DeleteButton.vue';
import adminTable from './components/admin/AdminTable.vue';
import selectRelation from './components/SelectRelation.vue';
import selectCityAcc from './components/SelectCityAcc.vue';

const app = createApp({})

app.component('images-upload', imagesUpload)
    .component('delete-button', deleteButton)
    .component('admin-table', adminTable)
    .component('select-relation', selectRelation)
    .component('select-city-acc', selectCityAcc);

app.mount("#app")
