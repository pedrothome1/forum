import './bootstrap';

Vue.component('flash', require('./components/Flash'));
Vue.component('filters-sidebar', require('./components/FiltersSidebar.vue'));

new Vue({
    el: '#app'
});
