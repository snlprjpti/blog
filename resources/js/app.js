
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');
import { Form, HasError, AlertError } from 'vform'

window.Form = Form;
Vue.component(HasError.name, HasError);
Vue.component(AlertError.name, AlertError);
window.Vue.use(VueRouter);

import VueRouter from 'vue-router';
import moment from 'moment';
import VueProgressBar from 'vue-progressbar';
import swal from 'sweetalert2';
import { VueEditor, Quill } from 'vue2-editor';
import createBlog from './components/blogs/createBlog.vue';

window.swal = swal;

const routes = [
    { path: '/dashboard', component: require('./components/Dashboard.vue') },
    { path: '/profile', component: require('./components/Profile.vue') },
    { path: '/users', component: require('./components/Users.vue') },
    { path: '/author', component: require('./components/passport/index.vue') },
    { path: '/blogs', component: require('./components/blogs/Blogs.vue'), name:'blogsIndex' },
    { path: '/blogs/create', component: createBlog, name: 'createBlog' },
    { path: '/blogs/:id', component: require('./components/blogs/BlogDetail.vue'),name: 'blogView' },
    { path: '/blogs/edit/:id', component: require('./components/blogs/BlogEdit.vue'),name: 'blogEdit' }
]

Vue.component(
    'passport-clients',
    require('./components/passport/Clients.vue')
);

Vue.component(
    'passport-authorized-clients',
    require('./components/passport/AuthorizedClients.vue')
);

Vue.component(
    'passport-personal-access-tokens',
    require('./components/passport/PersonalAccessTokens.vue')
);

const router = new VueRouter({
    routes // short for `routes: routes`
})

Vue.filter('upText', function(text){
return text.charAt(0).toUpperCase()+ text.slice(1)
});

Vue.filter('strLimit', function(text){
return text.slice(0,20)
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

Vue.component('pagination', require('laravel-vue-pagination'));

const app = new Vue({
    el: '#app',
    router


});