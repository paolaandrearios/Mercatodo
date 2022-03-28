/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

// require('./bootstrap')

import Vue from "vue";

window.Vue = require('vue').default;
Vue.mixin(require('./helper'));

window.axios = require('axios');

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
window.axios.defaults.headers.common['locale'] = window._locale;
if(window._token !== ''){
    window.axios.defaults.headers.common['Authorization'] = 'Bearer ' + window._token;
}


/**
 * The following block of codeL may be used to automatically register your
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
Vue.component('category-list-client', require('./components/categories/CategoryListClient.vue').default);

//Products
Vue.component('product-list', require('./components/products/ProductList.vue').default);
Vue.component('product-add', require('./components/products/modals/ProductAdd.vue').default);
Vue.component('product-edit', require('./components/products/modals/ProductEdit.vue').default);
Vue.component('product-show', require('./components/products/modals/ProductShow.vue').default);

Vue.component('product-grid', require('./components/products/ProductGrid.vue').default);
Vue.component('product-detail', require('./components/products/ProductDetail.vue').default);
Vue.component('add-cart-modal', require('./components/products/modals/AddToCartModal.vue').default);

//orders
Vue.component('order-cart', require('./components/orders/Cart.vue').default);
Vue.component('cart-button', require('./components/orders/CartButton.vue').default);
Vue.component('cart-items', require('./components/orders/CartItems.vue').default);
Vue.component('order-checkout', require('./components/orders/Checkout.vue').default);
Vue.component('order-summary', require('./components/orders/OrderSummary.vue').default);
Vue.component('checkout-modal', require('./components/orders/modals/CheckoutModal.vue').default);
Vue.component('order-history', require('./components/orders/OrderHistory.vue').default);
Vue.component('order-index', require('./components/orders/OrderIndex.vue').default);
Vue.component('order-history-modal', require('./components/orders/modals/OrderHistoryModal.vue').default);
Vue.component('order-edit-modal', require('./components/orders/modals/OrderEditModal.vue').default);
Vue.component('order-index-modal', require('./components/orders/modals/OrderIndexModal.vue').default);
Vue.component('payment-thanks', require('./components/orders/PaymentThanks').default);

//Home page
Vue.component('home-page', require('./components/pages/homePage/HomePage.vue').default);
Vue.component('header-home-page', require('./components/pages/homePage/HeaderHomePage.vue').default);
Vue.component('banner-home-page', require('./components/pages/homePage/BannerHomePage.vue').default);

Vue.component('category-home-page', require('./components/pages/homePage/CategoryHomePage.vue').default);
//utils
Vue.component('modal', require('./components/utils/Modal.vue').default);
Vue.component('error', require('./components/utils/Error.vue').default);
Vue.component('pagination', require('./components/utils/Pagination.vue').default);
Vue.component('logo', require('./components/utils/Logo.vue').default);
Vue.component('searcher', require('./components/utils/Searcher.vue').default);
Vue.component('footer-page', require('./components/utils/FooterPage.vue').default);
Vue.component('logo-and-home', require('./components/utils/LogoAndHome.vue').default);
Vue.component('dropdown', require('./components/utils/Dropdown.vue').default);
Vue.component('dropdown-admin', require('./components/utils/DropdownAdmin.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
});

