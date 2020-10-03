
require('./bootstrap');

window.Vue = require('vue');

//Front libs 
import BootstrapVue from 'bootstrap-vue' //Importing
Vue.use(BootstrapVue)

//components
Vue.component('customers-table', require('./components/CustomersTableComponent.vue').default);



window.onload = function () {
    const app = new Vue({
        el: '#app',
    });
}
