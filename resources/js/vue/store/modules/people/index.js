

import ApiService from "../../../services/api.service"

import { 
  GET_PEOPLE_PAGINATION
} from "./actions.type"

import {
	SET_PEOPLE_PAGINATION,
	SET_PEOPLE_SELECTED,
	SET_PEOPLE_EDITING
} from "./mutations.type"

const state = {
  pagination: {

	},
	selected: {

	},
	editing: false
}

const getters = {
  pagination(state) {
    return state.pagination
	},
	peopleSelected(state) {
		return state.selected
	},
	editingPeople(state) {
		return state.editing
	}
}

const actions = {
	[GET_PEOPLE_PAGINATION]({commit},data) {
		return new Promise((resolve,reject) => {
			ApiService
				.get('people.datatable',data)
				.then(({data}) => {
					commit(SET_PEOPLE_PAGINATION,data);
					resolve(data);
				})
				.catch(error => {
					reject(error);
				})
		})
	}
}

const mutations = {
	[SET_PEOPLE_PAGINATION](state,data) {
		state.pagination = data;
	},
	[SET_PEOPLE_SELECTED](state,data) {
		state.selected = data;
	},
	[SET_PEOPLE_EDITING](state,data) {
		state.editing = data;
	}
}

export default {
	state,
	getters,
	actions,
	mutations
}