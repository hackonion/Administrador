
require('./bootstrap');

window.Vue = require('vue');
import DynamicSelect from 'vue-dynamic-select'
import vSelect from 'vue-select';
import Vue from "vue";
Vue.use(DynamicSelect)
import "vue-select/dist/vue-select.css";
import 'vue-search-select/dist/VueSearchSelect.css'


Vue.component('tarea', require('./components/tareaComponent.vue').default);
Vue.component('configuracion', require('./components/configuracion.vue').default);
Vue.component('asignacion', require('./components/asignacion.vue').default);
Vue.component('equipo', require('./components/equipo.vue').default);
Vue.component('v-select', vSelect);
Vue.component('dynamic-select',DynamicSelect)

const app = new Vue({
    el: '#app',

    
});




