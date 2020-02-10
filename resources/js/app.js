/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

import store from './store/store'

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
//layouts
Vue.component('sidebar-component', require('./components/includes/SidebarComponent.vue').default);
Vue.component('header-component', require('./components/includes/HeaderComponent.vue').default);

//Prospectos
Vue.component('index-prospecto', require('./components/prospectos/IndexProspectoComponent.vue').default);
Vue.component('create-prospecto', require('./components/prospectos/CreteProspectoComponent.vue').default);
//Llamadas
Vue.component('index-llamada', require('./components/llamadas/IndexLlamadasComponent.vue').default);
//Reuniones
Vue.component('index-reunion', require('./components/reuniones/IndexReunionesComponent').default);


/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    store,
    el: '#app',
});
