import './bootstrap';

Vue.mixin({
    data() {
        return {
            app: window.App
        };
    },

    methods: {
        userOwns(model) {
            return this.app.user.id === model.user_id;
        }
    }
});

Vue.component('flash', require('./components/Flash'));
Vue.component('replies', require('./components/Replies'));
Vue.component('text-editor', require('./components/TextEditor'));
Vue.component('favorite-button', require('./components/FavoriteButton'));
Vue.component('filters-sidebar', require('./components/FiltersSidebar.vue'));

new Vue({
    el: '#app'
});
