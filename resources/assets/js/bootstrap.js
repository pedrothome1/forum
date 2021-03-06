import Vue from 'vue';
import VModal from 'vue-js-modal'
import Popper from 'popper.js';
import jQuery from 'jquery';
import 'bootstrap';
import toastr from 'toastr';
import axios from 'axios';

window.Vue = Vue;

Vue.use(VModal);

window.Popper = Popper.default;
window.$ = window.jQuery = jQuery;
window.toastr = toastr;
window.axios = axios;

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

let token = document.head.querySelector('meta[name="csrf-token"]');

if (token) {
    window.axios.defaults.headers.common['X-CSRF-TOKEN'] = token.content;
} else {
    console.error('CSRF token not found: https://laravel.com/docs/csrf#csrf-x-csrf-token');
}

toastr.options = {
    "closeButton": false,
    "debug": false,
    "newestOnTop": true,
    "progressBar": false,
    "positionClass": "toast-bottom-right",
    "preventDuplicates": false,
    "onclick": null,
    "showDuration": "0",
    "hideDuration": "0",
    "timeOut": "4000",
    "extendedTimeOut": "1000",
    "showMethod": "fadeIn",
    "hideMethod": "fadeOut"
};

window.events = new Vue();
