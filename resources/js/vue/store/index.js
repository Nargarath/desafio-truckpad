import Vue from 'vue'
import Vuex from "vuex";

import auth from "./modules/auth";
import VuexPersist from 'vuex-persist';

Vue.use(Vuex);

const vuexLocalStorage = new VuexPersist({
    key: 'vuex',
    storage: window.localStorage, 
    reducer: state => ({
        auth: state.auth
    })
})

export default new Vuex.Store({
    plugins: [vuexLocalStorage.plugin],
    modules: {
        auth
    }
});