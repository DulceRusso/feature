<template>
    <div>
        <todo-input
                :todoItemText.sync="todoItemText"
                v-on:addTodo="addTodo"
        >
        </todo-input>

        <section class="hero is-light">
            <section class="section">
                <div class="container">
                    <table class="table" v-for="(todo, index) in todoList"
                           :key="index">
                        <todo-item
                                :id="todo.id"
                                :text="todo.text"
                                :done="todo.done"
                                v-on:removeTodo="removeTodo"
                                v-on:toggleDone="toggleDone(todo)"
                        >
                        </todo-item>
                    </table>
                </div>
            </section>
        </section>
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
        computed: {
            todoList() {
                return this.$store.getters.todos;
            },
            updated() {
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
                this.todoItemText = '';
            },
            removeTodo(id) {
                this.$store.commit('SET_TODO_ID', id);
                this.$store.dispatch('removeTodo');
            },
            updateTodo(todo) {
                this.$store.commit('SET_NEW_TODO', todo);
                this.$store.commit('SET_TODO_ID', todo.id);
                this.$store.dispatch('updateTodo');
            },
            toggleDone(todo) {
                let newTodo = {
                    id: todo.id,
                    text: todo.text,
                    done: (!todo.done)
                };

                this.updateTodo(newTodo);

                if (this.updated) {
                    todo.done = !todo.done;
                    this.$store.commit('SET_UPDATED', false);
                }
            }
        }
    }
</script>

<style>
    .table{
        box-shadow: 0 1px 3px rgba(0,0,0,0.12), 0 1px 2px rgba(0,0,0,0.24);
        transition: all 0.3s cubic-bezier(.25,.8,.25,1);
    }

    .table:hover{
        box-shadow: 0 14px 28px rgba(0,0,0,0.16), 0 10px 10px rgba(0,0,0,0.22);
    }
</style>
