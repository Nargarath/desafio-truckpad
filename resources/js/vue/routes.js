import Vue from 'vue'
import VueRouter from "vue-router"  

/**
 * Config
 */
Vue.use(VueRouter)

const pageWhiteList = ['/', '/signin']

const routes =  [
    
];

const router = new VueRouter({
    routes 
})

router.beforeEach((to, from, next) => {
	let _accessToken = store.state.auth.accessToken || ''
	let _isAuthorize = store.state.auth.isAuthorize || false

	if (to.matched.some(record => record.meta.requiresAuth)) {
		if (_accessToken && _isAuthorize) {
			next()
		} else {
			next({
				path: '/signin',
				query: { redirect: to.fullPath }
			})
		}
	} else {
		if (pageWhiteList.indexOf(to.path) !== -1) {
			next()
		} else {
			if (to.path !== '/signin') {
				next()
			}
		}
	}
})

router.afterEach((to, from) => {

})

export { router };