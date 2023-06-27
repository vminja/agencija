import 'bootstrap-vue/dist/bootstrap-vue.css' 
import 'bootstrap/dist/css/bootstrap.css'

/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue').default;

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('example-component', require('./components/ExampleComponent.vue').default);

Vue.component('polisa', require('./components/Polisa.vue').default);

Vue.component('polisa-prikaz', require('./components/PolisaPrikaz.vue').default);

Vue.component('zaglavlje', require('./components/Zaglavlje.vue').default);

Vue.component('blog', require('./components/Blog.vue').default);

Vue.component('admin-blog', require('./components/AdminBlog.vue').default);
//prikaz blogova

Vue.component('admin-blog-kreiraj', require('./components/AdminBlogKreiraj.vue').default);

Vue.component('admin-blog-izmeni', require('./components/AdminBlogIzmeni.vue').default);

Vue.component('admin-panel', require('./components/AdminPanelComp.vue').default);

Vue.component('menu-comp', require('./components/Menu.vue').default);


/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
});

