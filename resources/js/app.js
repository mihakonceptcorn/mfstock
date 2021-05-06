require('./bootstrap');

window.Vue = require('vue').default;

let userRolesValue = null;
let userRolesElem = document.querySelector("meta[name='user-roles']");
if (userRolesElem) {
    userRolesValue = userRolesElem.getAttribute('content');
}

let userIdValue = null;
let userIdElem = document.querySelector("meta[name='user-id']");
if (userIdElem) {
    userIdValue = userIdElem.getAttribute('content');
}

let userNameValue = null;
let userNameElem = document.querySelector("meta[name='user-name']");
if (userNameElem) {
    userNameValue = userNameElem.getAttribute('content');
}

Vue.component('v-header', require('./components/Header.vue').default);
Vue.component('v-footer', require('./components/Footer.vue').default);
Vue.component('pagination', require('laravel-vue-pagination'));

Vue.prototype.$userId = userIdValue ? userIdValue : null;
Vue.prototype.$userRoles = userRolesValue ? JSON.parse(userRolesValue) : null;
Vue.prototype.$userName = userNameValue ? userNameValue : null;

import router from "./router";

const app = new Vue({
    el: '#app',
    router: router
});
