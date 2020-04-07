declare const window: any;
/**
 * We'll load the axios HTTP library which allows us to easily issue requests
 * to our Laravel back-end. This library automatically handles sending the
 * CSRF token as a header based on the value of the "XSRF" token cookie.
 */

import * as lodash from 'lodash';
import * as jquery from 'jquery';
import * as bootstrap from 'bootstrap';
import Vue from "vue"
import axios from "axios"
import * as popper from 'popper.js'

window.popper = popper;
window.Vue = Vue;
window.axios = axios;
window.bootstrap = bootstrap;
window._ = lodash;
window.$ = jquery;
window.jquery = jquery;
axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
import 'bootstrap-notify';
/**
 * Next we will register the CSRF Token as a common header with Axios so that
 * all outgoing HTTP requests automatically have it attached. This is just
 * a simple convenience so we don't have to attach every token manually.
 */

let token: HTMLMetaElement | null = document.head.querySelector('meta[name="csrf-token"]');

if (token) {
    axios.defaults.headers.common['X-CSRF-TOKEN'] = token.content;
} else {
    console.error('CSRF token not found: https://laravel.com/docs/csrf#csrf-x-csrf-token');
}

