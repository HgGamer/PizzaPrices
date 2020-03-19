
/**
 * First, we will load all of this project's Javascript utilities and other
 * dependencies. Then, we will be ready to develop a robust and powerful
 * application frontend using useful Laravel and JavaScript libraries.
 */

import "./bootstrap"

import ProcessComponent from "./components/ProcessComponent.vue"
import router from "./router"
import store from "./store"
import Vue from "vue"


Vue.component('Process', ProcessComponent)
window.onload = function () {
    new Vue({
        router,
        store,

        el: '#app'
    })
}
