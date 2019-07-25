import 'ant-design-vue/dist/antd.css';
import 'es6-promise/auto'
import { Vue } from './globalComponents'
import moment from 'moment'
import VueEvents from 'vue-events'
import { router } from './routes'
import store from './store'
import { sync } from 'vuex-router-sync'
import globalHelpers from './helpers/global'
import VueScrollTo from 'vue-scrollto';

Vue.config.productionTip = false

sync(store, router)
Vue.use(VueEvents)

Vue.use(VueScrollTo, {
	container: "body",
	duration: 500,
	easing: "ease",
	offset: 0,
	force: true,
	cancelable: true,
	onStart: false,
	onDone: false,
	onCancel: false,
	x: false,
	y: true
})

Vue.mixin(globalHelpers)

Vue.filter('formatDate', function (value) { 
	return moment(value).format('DD/MM/YYYY');
})
Vue.filter('sortOrder', function (value) { 
	if(value === 'ascend') {
		return 'asc'
	}
	return 'desc'
})
Vue.filter('deletePhrase', function (value) { 
	return `Are you sure to delete '${value}' record?`
})

const app = new Vue({
	el: '#app',
	router,
	store
});