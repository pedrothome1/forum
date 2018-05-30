import './bootstrap';

Vue.mixin({
    data() {
        return {
            app: window.App
        };
    }
});

Vue.component('flash', require('./components/Flash'));
Vue.component('text-editor', require('./components/TextEditor'));
Vue.component('favorite-button', require('./components/FavoriteButton'));
Vue.component('filters-sidebar', require('./components/FiltersSidebar.vue'));

new Vue({
    el: '#app'
});
