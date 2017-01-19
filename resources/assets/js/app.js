/**
 * First we will load all of this project's JavaScript dependencies which
 * include Vue and Vue Resource. This gives a great starting point for
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('task-list', require('./components/task-list.vue'));
Vue.component('task', require('./components/task.vue'));
Vue.component('message', require('./components/message.vue'));
Vue.component('modal', require('./components/modal.vue'));
Vue.component('tab', require('./components/tabs.vue'));
Vue.component('tabs', {
    template: '<div><slot></slot></div>',

    props: {
        name: {required: true},
        selected: { default: false}
    },
    data() {
        return {
            isActive: false,
        }
    },
    mounted() {
        this.isActive = this.selected;
    }
});

let data = {
    message: 'test vue message',
    newName: '',
    btnTitle: 'title of the btn',
    isLoading: false,
    showModal: false,
    tasks: [
        {description: 'description 1 ', completed: false},
        {description: 'description 2 ', completed: true},
        {description: 'description 3 ', completed: false},
        {description: 'description 4 ', completed: false},
        {description: 'description 5 ', completed: true},
    ],
}
var app = new Vue({
    el: '#app',
    data,
    mounted() {
        console.log('app mounted');
    },
    methods: {
        toggleLoadingClass() {
            !this.isLoading ? this.isLoading = true : this.isLoading = false;
        },
        toggleModal() {
            this.showModal = true;
        }
    }
})

