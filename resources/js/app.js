/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');


import JwPagination from 'jw-vue-pagination';
Vue.component('jw-pagination', JwPagination);

Vue.component('pagination', require('laravel-vue-pagination'));

import VueRouter from 'vue-router'
Vue.use(VueRouter)


import AppMain from './components/App.vue'
import QuestionsIndex from './components/questions/Question.vue'
import QuestionCreate from './components/questions/QuestionCreate.vue'
import QuestionEdit from './components/questions/QuestionEdit.vue'
import Vue from 'vue';

import VueSweetalert2 from 'vue-sweetalert2';
import 'sweetalert2/dist/sweetalert2.min.css';
Vue.use(VueSweetalert2);


const router = new VueRouter({
    mode: 'history',
    routes :[
        {
            path: '/',
            component: QuestionsIndex,
            name: 'question.index',
        },
        {
            path: '/question/create',
            name : 'question.create',
            component: QuestionCreate,
        },
        {
            path: '/question/edit/:id',
            name : 'question.edit',
            component: QuestionEdit,
        }
    ]
  })


const app = new Vue({
    el: '#app',
    components :{
        AppMain
    }, 
    router
});
