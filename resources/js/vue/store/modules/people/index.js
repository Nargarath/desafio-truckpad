

import ApiService from "../../../services/api.service";

import { 
  GET_PEOPLE_PAGINATION
} from "./actions.type";

import {
  SET_PEOPLE_PAGINATION
} from "./mutations.type";

const state = {
  pagination: {

  }
};

const getters = {
  pagination(state)
  {
    return state.pagination;
  }
};

const actions = {
	[GET_PEOPLE_PAGINATION]({commit},data)
	{
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
		});
	},
};

const mutations = {
	[SET_PEOPLE_PAGINATION](state,data)
	{
		state.pagination = data;
	}
};

export default {
	state,
	getters,
	actions,
	mutations
};