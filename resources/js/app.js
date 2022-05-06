/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

import { createApp } from 'vue';

//import hello from './components/ExampleComponent.vue';

import city from './components/City.vue';

import carousel from './components/Carousel/Carousel.vue';



const app=createApp({})


app.component('city' , city);

app.component('carousel' , carousel);



app.mount("#app")





