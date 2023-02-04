<template>

    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Todos Not Completed</div>
                <div class="card-body">
                    <list-todos-pending-view :todos="todosPending" v-on:reloadlist="getTodos()" class="text-center"/>
                </div>
            </div>
            <div class="card">
                <div class="card-header">Todos Completed</div>
                <div class="card-body">
                    <list-todos-done-view :todos="todosDone" v-on:reloadlist="getTodos()" class="text-center"/>
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
import listTodo from './listTodo.vue'
import addTodoForm from './addTodoForm.vue'
import listTodosDoneView from './listTodosDoneView.vue'
import listTodosPendingView from './listTodosPendingView.vue'

export default {
    components: {
        addTodoForm,
        listTodosDoneView,
        listTodosPendingView
    },
    data: function() {
        return {
            todosDone: [],
            todosPending: [],
        };
    },
    methods: {
        getTodos() {
            axios.get("todos")
                .then(response => {
                    this.todosDone = response.data.data.done;
                    this.todosPending = response.data.data.pending;
                })
                .catch(error => {
                    console.log(error);
                });
        }
    },
    created() {
        this.getTodos();
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
