import './bootstrap';

Vue.mixin({
    data() {
        return {
            app: window.App
        };
    },

    methods: {
        userOwns(model) {
            return this.app.signedIn ? this.app.user.id === model.user_id : false;
        }
    }
});

Vue.component('thread-view', require('./views/Thread'));

Vue.component('flash', require('./components/Flash'));
Vue.component('replies', require('./components/Replies'));
Vue.component('paginator', require('./components/Paginator'));
Vue.component('text-editor', require('./components/TextEditor'));
Vue.component('favorite-button', require('./components/FavoriteButton'));
Vue.component('filters-sidebar', require('./components/FiltersSidebar.vue'));

new Vue({
    el: '#app'
});
