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
Vue.component('Users', require('./components/users/Users.vue'));
Vue.component('Channels', require('./components/channels/Channels.vue'));
Vue.component('Discussions', require('./components/discussions/Discussions.vue'));
Vue.component('creatediscussion', require('./components/discussions/CreateDiscussion.vue'));
Vue.component('editdiscussion', require('./components/discussions/EditDiscussion.vue'));
Vue.component('discussiondesc', require('./components/discussions/DiscussionDescription.vue'));
Vue.component('Favorite', require('./components/discussions/FavoriteDiscussion.vue'));
Vue.component('Profile', require('./components/Profile.vue'));
Vue.component('editprofile', require('./components/EditProfile.vue'));
Vue.component('Tab', require('./components/Tab.vue'));
Vue.component('Notification', require('./components/Notifications/Notification.vue'));

const app = new Vue({
  el: '#app',
});

// disable Vue devtool in production mode
Vue.config.devtools = false
Vue.config.debug = false
Vue.config.silent = true
