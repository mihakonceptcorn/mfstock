require('./bootstrap');

window.Vue = require('vue').default;
let userRolesValue = document.querySelector("meta[name='user-roles']").getAttribute('content');

Vue.component('v-header', require('./components/Header.vue').default);
Vue.component('v-footer', require('./components/Footer.vue').default);
Vue.prototype.$userId = document.querySelector("meta[name='user-id']").getAttribute('content');
Vue.prototype.$userRoles = userRolesValue ? JSON.parse(userRolesValue) : null;
Vue.prototype.$userName = document.querySelector("meta[name='user-name']").getAttribute('content');

import router from "./router";

const app = new Vue({
    el: '#app',
    router: router
});
