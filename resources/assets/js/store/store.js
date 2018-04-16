import Vue from 'vue';
import Vuex from 'vuex';
import axios from 'axios';

Vue.use(Vuex);

export const store = new Vuex.Store({
    state: {
        todos: [],
        newTodo: '',
        todoID: '',
        updated: false
    },
    getters:{
        todos: state => state.todos,
        updated: state => state.updated
    },
    actions: {
        loadTodos({commit}) {
            axios.get('/todos').then(response => {
                commit('SET_TODOS', response.data.result);
            }).catch((error) => {

            });
        },
        addTodo({commit, state}) {
            if (state.newTodo) {
                const todo = {
                    text: state.newTodo,
                    done: false
                };

                axios.post('/todos', todo).then(response => {
                    commit('ADD_TODO', response.data.result);
                    commit('CLEAR_NEW_TODO');
                }).catch((error) => {

                });

            }
        },
        removeTodo({commit,state}){
            axios.delete('/todos/'+ state.todoID).then(response => {
                commit('DELETE_TODO', state.todoID);
                commit('CLEAR_TODO_ID');
            }).catch((error) => {

            });
        },
        updateTodo({commit, state}){
            axios.patch('/todos/'+ state.todoID, state.newTodo).then(response => {
                commit('SET_UPDATED', true);
                commit('CLEAR_TODO_ID');
                commit('CLEAR_NEW_TODO');
            }).catch((error) => {
                commit('SET_UPDATED', false);
                commit('CLEAR_TODO_ID');
                commit('CLEAR_NEW_TODO');
            });
        }
    },
    mutations: {
        SET_TODOS(state, todos) {
            state.todos = todos;
        },
        ADD_TODO(state, todo) {
            state.todos.push(todo);
        },
        SET_NEW_TODO(state, text){
            state.newTodo = text;
        },
        CLEAR_NEW_TODO(state,text){
            state.newTodo = '';
        },
        SET_TODO_ID(state, id){
            state.todoID = id;
        },
        CLEAR_TODO_ID(state){
            state.todoID = '';
        },
        DELETE_TODO(state, id){
            const index = state.todos.findIndex(t => t.id === id);
            state.todos.splice(index, 1);
        },
        SET_UPDATED(state, value){
            state.updated = value;
        }
    }
});