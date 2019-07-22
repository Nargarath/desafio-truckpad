

import AuthService from "../../../services/auth.service";

import { 
    JWT_LOGIN,
    JWT_LOGOUT
} from "./actions.type";

import {
    SET_TOKEN
} from "./mutations.type";

const state = {
    token: ''
};

const getters = {
    token(state)
    {
        return state.token;
    }
};

const actions = {
    [JWT_LOGIN]({commit},loginData)
    {
        return new Promise((resolve,reject) => {
            AuthService
                .login(loginData.email,loginData.password)
                .then(({data}) => {
                    commit(SET_TOKEN,data);
                    resolve(data);
                }).catch(error => {
                    reject(error);
                })
        });
    },
    [JWT_LOGOUT]({commit})
    {
        return new Promise(resolve => {
            AuthService
                .logout()
                .then(({data}) => {
                    commit(SET_TOKEN,{token:''});
                    resolve(data);
                }).catch(error => {
                    reject(error);
                })
        });
    }
};

const mutations = {
    [SET_TOKEN](state,data)
    {
        state.token = data.token;
    }
};

export default {
    state,
    getters,
    actions,
    mutations
};