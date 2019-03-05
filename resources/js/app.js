
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

import VueContentPlaceholders from 'vue-content-placeholders';
import Toasted from 'vue-toasted';
import VueSweetalert2 from 'vue-sweetalert2';
import Multiselect from 'vue-multiselect';
import VueHolder from 'vue-holderjs';

const moment = require('moment');
require('moment/locale/pt-br');
require('./bootstrap');

window.Vue = require('vue');
window.axios = require('axios');

Vue.component('multiselect', Multiselect);
Vue.use(VueContentPlaceholders)
Vue.use(Toasted);
Vue.use(VueSweetalert2);
Vue.use(require('vue-moment'), {moment});
Vue.use(VueHolder);

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i);
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default));

Vue.component('noticias-create',  require('./components/noticias/Create.vue').default);
Vue.component('noticias-edit',    require('./components/noticias/Edit.vue').default);
Vue.component('noticias-index',   require('./components/noticias/Index.vue').default);
Vue.component('noticias-show',    require('./components/noticias/Show.vue').default);
Vue.component('noticias-ver',     require('./components/noticias/Ver.vue').default);

Vue.component('categorias-create',  require('./components/categorias/Create.vue').default);
Vue.component('categorias-edit',    require('./components/categorias/Edit.vue').default);
Vue.component('categorias-index',   require('./components/categorias/Index.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app'
});
