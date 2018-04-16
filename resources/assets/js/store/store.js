import Vue from 'vue';
import Vuex from 'vuex';
import axios from 'axios';

Vue.use(Vuex);

export const store = new Vuex.Store({
    state: {
        todos: []
    },
    actions: {
        loadTodos({commit}) {
            axios.get('/todos').then(response => {
                commit('setTodos', response.data.result);
            }).catch((error) => {

            });
        }
    },
    mutations: {
        setTodos(state, todos) {
            state.todos = todos;
        }
    }
});