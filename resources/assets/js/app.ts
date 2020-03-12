
/**
 * First, we will load all of this project's Javascript utilities and other
 * dependencies. Then, we will be ready to develop a robust and powerful
 * application frontend using useful Laravel and JavaScript libraries.
 */

import "./bootstrap"
import Vue from "vue"
import ProcessComponent from "./components/ProcessComponent.vue"
import router from "./router"
import store from "./store"
import axios from "axios"

window.Vue = Vue;

Vue.component('Process', ProcessComponent)
window.onload = function () {
    new Vue({
        router,
        store,

        el: '#app'
    })
}
