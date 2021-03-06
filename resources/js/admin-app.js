/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */
require("./bootstrap");
import VueToast from "vue-toast-notification";
// Import one of the available themes
//import 'vue-toast-notification/dist/theme-default.css';
import "vue-toast-notification/dist/theme-sugar.css";

window.Vue = require("vue").default;

Vue.use(VueToast, {
    position: "top-right"
});

window.handleAxiosErrors = error => {
    console.log(error);
    if (error.response.status === 422) {
        Vue.$toast.error("You have some validation error");
    }

    Vue.$toast.error(
        "Something went wrong. Please refresh the page and try again"
    );
};

Vue.component("vue-lesssons", require("./components/Lessons.vue").default);

const app = new Vue({
    el: "#admin-app"
});
