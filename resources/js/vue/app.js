import 'ant-design-vue/dist/antd.css';
import 'es6-promise/auto'

import { Vue } from './globalComponents'
import VueEvents from 'vue-events'


import { router } from './routes'
import store from './store'
import { sync } from 'vuex-router-sync'

import globalHelpers from './helpers/global';


sync(store, router)

Vue.use(VueEvents)
Vue.mixin(globalHelpers)


const app = new Vue({
	el: '#app'
});