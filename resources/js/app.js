/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require("./bootstrap");

window.Vue = require("vue").default;
// we have registered vue in admin-app
Vue.component("vue-login", require("./components/Login.vue").default);
Vue.component("vimeo-player", require("./components/VimeoPlayer.vue").default);

const app = new Vue({
    el: "#app"
});
