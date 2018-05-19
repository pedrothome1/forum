import './bootstrap';

Vue.component('example-component', require('./components/ExampleComponent.vue'));

new Vue({
    el: '#app'
});
