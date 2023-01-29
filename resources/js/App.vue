<template>
    <!--    <img alt="Vue logo" src="./assets/logo.png">-->
    <HelloWorld msg="Welcome to Your Vue.js App"/>
    <div class="row">

    <div class="col-md-8">
        <div class="card">
            <div class="card-header">ToDo List Laravel & Vue & Websocket</div>
            <div class="card-body">
                <list-view :tasks="tasks" v-on:reloadlist="getTasks()" class="text-center"/>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card">
            <div class="card-header">Add Task</div>
            <div class="card-body">
                <add-task-form v-on:reloadlist="getTasks()" />
            </div>
        </div>
    </div>
    </div>
</template>

<script>

import HelloWorld from './components/Welcome.vue'
import addTaskForm from './components/addTaskForm.vue'
import listView from './components/listView.vue'

export default {
    name: 'App',
    components: {
        HelloWorld,
        addTaskForm,
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

        window.Echo.channel('public').listen('TaskReceived',(e)=>{
            //code for displaying the serve data
            this.getTasks();
        })
    },
    data: function() {
        return {
            tasks: []
        };
    },
    methods: {
        getTasks() {
            axios
                .get("api/v1/tasks")
                .then(response => {
                    this.tasks = response.data.data.tasks;
                })
                .catch(error => {
                    console.log(error);
                });
        }
    },
    created() {
        this.getTasks();
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
