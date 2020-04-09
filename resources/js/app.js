
require('./bootstrap');

window.Vue = require('vue');
import Vue from "vue";
import VueFlashMessage from 'vue-flash-message';
Vue.use(VueFlashMessage);
Vue.use(VueFlashMessage, { method: 'iPreferQuickSilver' });
require('vue-flash-message/dist/vue-flash-message.min.css');
import FlashMessage from '@smartweb/vue-flash-message';
Vue.use(FlashMessage);

Vue.component('tarea', require('./components/tareaComponent.vue').default);
Vue.component('configuracion', require('./components/configuracion.vue').default);
Vue.component('asignacion', require('./components/asignacion.vue').default);
Vue.component('equipo', require('./components/equipo.vue').default);




const app = new Vue({
    el: '#app',

    
});




