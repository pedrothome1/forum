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

Vue.component('login-view', require('./views/Login'));
Vue.component('thread-view', require('./views/Thread'));
Vue.component('register-view', require('./views/Register'));

Vue.component('flash', require('./components/Flash'));
Vue.component('replies', require('./components/Replies'));
Vue.component('paginator', require('./components/Paginator'));
Vue.component('text-editor', require('./components/TextEditor'));
Vue.component('favorite-button', require('./components/FavoriteButton'));

new Vue({
    el: '#app'
});
