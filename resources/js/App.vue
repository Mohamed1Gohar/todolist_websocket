<template>
    <!--    <img alt="Vue logo" src="./assets/logo.png">-->
    <HelloWorld msg="Welcome to Your Vue.js App"/>
    <div class="row">

    <div class="col-md-8">
        <div class="card">
            <div class="card-header">ToDo List Laravel & Vue & Websocket</div>
            <div class="card-body">
                <list-view :todos="todos" v-on:reloadlist="getTodos()" class="text-center"/>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card">
            <div class="card-header">Add Todo</div>
            <div class="card-body">
                <add-todo-form v-on:reloadlist="getTodos()" />
            </div>
        </div>
    </div>
    </div>
</template>

<script>

import HelloWorld from './components/Welcome.vue'
import addTodoForm from './components/addTodoForm.vue'
import listView from './components/listView.vue'

export default {
    name: 'App',
    components: {
        HelloWorld,
        addTodoForm,
        listView
    },
    mounted(){
        console.log('Echo listen');
        // to connect the public channel
        window.Echo.channel('public').listen('Hello',(e)=>{
            console.log('go public => Hello');
            //code for displaying the serve data
            console.log(e); // the data from the server
        })

        window.Echo.channel('public').listen('TodoReceived',(e)=>{
            //code for displaying the serve data
            this.getTodos();
        })
    },
    data: function() {
        return {
            todos: []
        };
    },
    methods: {
        getTodos() {
            axios
                .get("todos")
                .then(response => {
                    this.todos = response.data.data.todos;
                })
                .catch(error => {
                    console.log(error);
                });
        }
    },
    created() {
        this.getTodos();
    }
}
</script>

<style>
#todolist-app {
    font-family: Avenir, Helvetica, Arial, sans-serif;
    -webkit-font-smoothing: antialiased;
    -moz-osx-font-smoothing: grayscale;
    text-align: center;
    color: #2c3e50;
    margin-top: 60px;
}
</style>
