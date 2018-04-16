<template>
    <div class="container">
        <todo-input
                :todoItemText.sync="todoItemText"
                v-on:addTodo="addTodo"
        >
        </todo-input>
        <table class="table is-bordered">
            <todo-item
                    v-for="(todo, index) in todoArray"
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
    import axios from 'axios';

    export default {
        computed:{
            todoArray(){
                return this.$store.state.todos;
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
            //this.todoList();
            this.$store.dispatch('loadTodos');
        },
        methods: {
            todoList() {
                axios.get('/todos').then(response => {
                    this.items = response.data.result;
                }).catch((error) => {

                });
            },
            addTodo() {
                let text = this.todoItemText.trim();
                if (text !== '') {
                    let todo = {text: text, done: false};
                    axios.post('/todos', todo).then(response => {
                        this.items.push(response.data.result);
                    }).catch((error) => {

                    });
                    this.todoItemText = '';
                }
            },
            removeTodo(id) {
                axios.delete('/todos/'+ id).then(response => {
                    this.items = this.items.filter(item => item.id !== id);
                }).catch((error) => {

                });
            },
            updateTodo(todo){
                axios.patch('/todos/'+ todo.id, todo).then(response => {
                    return response.data.result;
                }).catch((error) => {
                    return 'error';
                });
            },
            toggleDone(todo) {
                let newTodo = {
                    id : todo.id,
                    text : todo.text,
                    done: (!todo.done)
                };

                if(this.updateTodo(newTodo) !== 'error'){
                    todo.done = !todo.done;
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
