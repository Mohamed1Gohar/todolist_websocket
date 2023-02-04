<template>
    <!--    <img alt="Vue logo" src="./assets/logo.png">-->
    <HelloWorld msg="Welcome to Your Vue.js App"/>

    <indexTodos />

</template>

<script>

import HelloWorld from './components/Welcome.vue'
import indexTodos from './components/todos/index.vue'

export default {
    name: 'App',
    components: {
        HelloWorld,
        indexTodos,
    }
}
</script>
