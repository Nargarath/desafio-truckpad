import Vue from 'vue'
import VueRouter from "vue-router"  
import signIn from './pages/signin/index'
import dashboard from './pages/dashboard/index'
import people from './pages/dashboard/people/index'
import store from './store'
import { JWT_REFRESH } from './store/modules/auth/actions.type';
import { SET_TOKEN } from './store/modules/auth/mutations.type';

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
	const _accessToken = store.state.auth.token;

	if( _accessToken ) {
		store.dispatch(JWT_REFRESH)
		.then(
			data => {
				store.commit(SET_TOKEN,data);
				if(to.path !== '/') {
					next()
				} else {
					next({
						path: '/dashboard',
						query: { redirect: to.fullPath }
					})
				}
			}
		)
		.catch(
			error => {
				store.commit(SET_TOKEN,{token: ''});
				if(to.path !== '/') {
					next({
						path: '/',
						query: { redirect: to.fullPath }
					})
				}else{
					next()
				}
			}
		)
	} else {
		if(to.path !== '/') {
			next({
				path: '/',
				query: { redirect: to.fullPath }
			})
		} else {
			next()
		}
	}
	
			
			
	}
);
	/*
	if (to.matched.some(record => record.meta.requiresAuth) && _accessToken) {
		store.dispatch(JWT_REFRESH).then(
			data => {
				store.commit(SET_TOKEN,data);
			}
		);
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
	*/




export { router };