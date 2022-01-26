/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

// require('./bootstrap')

import Vue from "vue";

window.Vue = require('vue').default;
Vue.mixin(require('./trans'));

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

//user
Vue.component('user-list', require('./components/users/UserList.vue').default);
Vue.component('user-edit', require('./components/users/modals/UserEdit.vue').default);
Vue.component('user-show', require('./components/users/modals/UserShow.vue').default);

//category
Vue.component('category-list', require('./components/categories/CategoryList.vue').default);
Vue.component('category-add', require('./components/categories/modals/CategoryAdd.vue').default);
Vue.component('category-show', require('./components/categories/modals/CategoryShow.vue').default);
Vue.component('category-edit', require('./components/categories/modals/CategoryEdit.vue').default);
Vue.component('modal', require('./components/Modal.vue').default);

//Products
Vue.component('product-list', require('./components/products/ProductList.vue').default);


/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
});

