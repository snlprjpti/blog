
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');
import { Form, HasError, AlertError } from 'vform'

window.Form = Form;
Vue.component(HasError.name, HasError)
Vue.component(AlertError.name, AlertError)
Vue.use(VueRouter)

import VueRouter from 'vue-router'
import moment from 'moment'
import VueProgressBar from 'vue-progressbar'
import swal from 'sweetalert2'
window.swal = swal;


let routes = [
    { path: '/dashboard', component: require('./components/Dashboard.vue') },
    { path: '/profile', component: require('./components/Profile.vue') },
    { path: '/users', component: require('./components/Users.vue') }
]
Vue.component('example-component', require('./components/ExampleComponent.vue'));

const router = new VueRouter({
    routes, // short for `routes: routes`
     mode: 'history'
})


Vue.filter('upText', function(text){
return text.charAt(0).toUpperCase()+ text.slice(1)
});

Vue.filter('dateFormat', function(date){
return moment(date).format('MMMM Do YYYY, h:mm:ss a');
});


// Progressbar
const options = {
    color: 'green',
    failedColor: '#874b4b',
    thickness: '5px',
    transition: {
        speed: '2s',
        opacity: '0.6s',
        termination: 300
    },
    autoRevert: true,
    location: 'top',
    inverse: false
}
window.Fire = new Vue();

// sweet alert
const toast = swal.mixin({
    position: 'top-end',
    type: 'success',
    title: 'Your work has been saved',
    showConfirmButton: false,
    timer: 1500
});
window.toast = toast;

Vue.use(VueProgressBar, options)

const app = new Vue({
    el: '#app',
    router


});