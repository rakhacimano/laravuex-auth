require('./bootstrap');
 
import Vue from 'vue';
import VueRouter from 'vue-router';
import axios from 'axios';
import VueAxios from 'vue-axios';
 
import App from './App.vue';
 
import { routes } from "./routes.js";
import { store } from "./store.js";
 
Vue.use(VueRouter);
Vue.use(VueAxios,axios);
 
const router = new VueRouter({
    routes,
    mode : 'history'
})
 
const app = new Vue({
    el: '#app',
    router,
    store,
    render : h => h(App)
});
