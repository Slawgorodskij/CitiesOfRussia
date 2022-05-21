/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

import {createApp} from 'vue';

import city from './components/City.vue';
import carousel from './components/Carousel/Carousel.vue';
import SelectCity from './components/SelectCity.vue';
import SelectCityAcc from './components/SelectCityAcc.vue';

const app = createApp({})

app.component('city', city)
    .component('carousel', carousel)
    .component('selectCity', SelectCity)
    .component('selectCityAcc', SelectCityAcc);


app.mount("#app")





