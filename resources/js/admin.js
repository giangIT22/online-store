require('./bootstrap');

window.Vue = require('vue').default;

//support vuex
import Vuex from 'vuex'
Vue.use(Vuex)

import ListCategory from '../js/admin/components/category/ListCategories.vue';
import SubCategory from '../js/admin/components/category/SubCategory.vue';
import ListProduct from '../js/admin/components/product/ListProduct.vue';
import ListSlider from '../js/admin/components/slider/ListSlider.vue';
import ListBlog from '../js/admin/components/blog/ListBlog.vue';
import PendingReview from '../js/admin/components/review/PendingReview.vue';
import PublishReview from '../js/admin/components/review/PublishReview.vue';
import ListCoupon from '../js/admin/components/coupon/ListCoupon.vue';
import ListOrder from '../js/admin/components/order/ListOrder.vue';
import ListUser from '../js/admin/components/user/ListUser.vue';
import ListEmployee from '../js/admin/components/employee/ListEmployee.vue';

Vue.component('ListCategory', ListCategory);
Vue.component('SubCategory', SubCategory);
Vue.component('ListProduct', ListProduct);
Vue.component('ListSlider', ListSlider);
Vue.component('ListBlog', ListBlog);
Vue.component('PendingReview', PendingReview);
Vue.component('PublishReview', PublishReview);
Vue.component('ListCoupon', ListCoupon);
Vue.component('ListOrder', ListOrder);
Vue.component('ListUser', ListUser);
Vue.component('ListEmployee', ListEmployee);

const app = new Vue({
    el: '#admin',
});