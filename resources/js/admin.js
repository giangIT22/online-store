require('./bootstrap');

window.Vue = require('vue').default;

//support vuex
import Vuex from 'vuex'
Vue.use(Vuex)

import ListCategory from '../js/admin/components/category/ListCategories.vue';
import SubCategory from '../js/admin/components/category/SubCategory.vue';
import ListProduct from '../js/admin/components/product/ListProduct.vue';
import ListSlider from '../js/admin/components/slider/ListSlider.vue';

Vue.component('ListCategory', ListCategory);
Vue.component('SubCategory', SubCategory);
Vue.component('ListProduct', ListProduct);
Vue.component('ListSlider', ListSlider);

const app = new Vue({
    el: '#admin',
});