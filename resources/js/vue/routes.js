import Vue from 'vue'
import VueRouter from "vue-router"  
import signIn from './pages/signin/index'
import dashboard from './pages/dashboard/index'
import people from './pages/dashboard/people/index'
import peopleForm from './pages/dashboard/people/form'

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
		name: 'dashboard',
		meta: {
			requiresAuth: true
		},
		children: [
			{ 
				path: '/dashboard/people', component: people, name:'dashboard.people.index',
				children: [
					{ path: '/dashboard/people/:id', component: peopleForm, name:'dashboard.people.operation' },
				]
			}
			
		]
	}
];

const router = new VueRouter({
	linkActiveClass: 'ant-menu-item-selected',
	routes
})


router.beforeEach((to, from, next) => {
	const _accessToken = store.state.auth.token;
	const redirectIfNotInHome = function (next,to,route){
		if(to.path !== '/') {
			next()
		} else {
			next({
				path: route,
				query: { redirect: to.fullPath }
			})
		}
	}
	const redirectIfInHome = function (next,to,route){
		if(to.path === '/') {
			next()
		} else {
			next({
				path: route,
				query: { redirect: to.fullPath }
			})
		}
	}
	if( _accessToken ) {
		store.dispatch(JWT_REFRESH)
		.then(
			data => {
				store.commit(SET_TOKEN,data);
				redirectIfNotInHome(next,to,'/dashboard/people')
			}
		)
		.catch(
			error => {
				store.commit(SET_TOKEN,{token: ''});
				redirectIfInHome(next,to,'/')
			}
		)
	} else {
		redirectIfInHome(next,to,'/')
	}
	
		
	}
);

export { router };