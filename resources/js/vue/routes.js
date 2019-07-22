import Vue from 'vue'
import VueRouter from "vue-router"  
import signIn from './pages/signin/index'
import dashboard from './pages/dashboard/index'
import people from './pages/dashboard/people/index'
import store from './store'

/**
 * Config
 */
Vue.use(VueRouter)


const routes =  [
	{ 	
		path: '/', component: signIn,
		meta: {
			requiresAuth: false
		}  
	},
	{
		path: '/dashboard', 
		component: dashboard, 
		name: 'dashboard.index',
		meta: {
			requiresAuth: true
		},
		children: [
			{ path: '/', component: people },
		]
	}
];

const router = new VueRouter({
    routes 
})

router.beforeEach((to, from, next) => {
	let _accessToken = store.state.auth.token!==''
	if (to.matched.some(record => record.meta.requiresAuth) && _accessToken) {
			next()
	} else if ( to.path === '/' && _accessToken ) {
		next({
			path: '/dashboard',
			query: { redirect: to.fullPath }
		})
	} else if(to.matched.some(record => record.meta.requiresAuth) && !_accessToken){
		next({
			path: '/',
			query: { redirect: to.fullPath }
		})
	} else {
		next();
	}
})




export { router };