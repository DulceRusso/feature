<template>
    <div class="container">
        <todo-input
                :todoItemText.sync="todoItemText"
                v-on:addTodo="addTodo"
        >
        </todo-input>
        <table class="table is-bordered">
            <todo-item
                    v-for="(todo, index) in todoList"
                    :key="index"
                    :id="todo.id"
                    :text="todo.text"
                    :done="todo.done"
                    v-on:removeTodo="removeTodo"
                    v-on:toggleDone="toggleDone(todo)"
            >
            </todo-item>
        </table>
    </div>
</template>

<script>
    /**
     * Tips:
     * - En mounted pueden obtener el listado del backend de todos y dentro de la promesa de axios asirnarlo
     *   al arreglo que debe tener una estructura similar a los datos de ejemplo.
     * - En addTodo, removeTodo y toggleTodo deben hacer los cambios pertinentes para que las modificaciones,
     *   addiciones o elimicaiones tomen efecto en el backend asi como la base de datos.
     */

    export default {
        computed:{
            todoList(){
                return this.$store.getters.todos;
            },
            updated(){
                return this.$store.getters.updated;
            }
        },
        data() {
            return {
                todoItemText: '',
                items: [],
                updatedTodo: {}
            }
        },
        mounted() {
            this.$store.dispatch('loadTodos');
        },
        methods: {
            addTodo() {
                let text = this.todoItemText.trim();
                this.$store.commit('SET_NEW_TODO', text);
                this.$store.dispatch('addTodo');
            },
            removeTodo(id) {
                this.$store.commit('SET_TODO_ID',id);
                this.$store.dispatch('removeTodo');
            },
            updateTodo(todo){
                this.$store.commit('SET_NEW_TODO', todo);
                this.$store.commit('SET_TODO_ID', todo.id);
                this.$store.dispatch('updateTodo');
            },
            toggleDone(todo) {
                let newTodo = {
                    id : todo.id,
                    text : todo.text,
                    done: (!todo.done)
                };

                this.updateTodo(newTodo);

                if(this.updated){
                    todo.done = !todo.done;
                    this.$store.commit('SET_UPDATED', false);
                }
            }
        }
    }
</script>

<style>
    .is-done {
        text-decoration: line-through;
    }
</style>
