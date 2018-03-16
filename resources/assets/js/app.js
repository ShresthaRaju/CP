/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

import Buefy from 'buefy'
Vue.use(Buefy);

// import VueRouter from 'vue-router'
// Vue.use(VueRouter);
//
// import vueRoutes from './vueRoutes'
//
// const router = new VueRouter({
//   routes: vueRoutes,
//   mode: 'history',
// });
//
// /**
//  * Next, we will create a fresh Vue application instance and attach it to
//  * the page. Then, you may begin adding components to this application
//  * or customize the JavaScript scaffolding to fit your unique needs.
//  */
//
//  Vue.component('example-component', require('./components/ExampleComponent.vue'));
//
Vue.component('users', require('./components/users/Users.vue'));

const app = new Vue({
  el: '#app',
});
