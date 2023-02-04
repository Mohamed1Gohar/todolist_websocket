<template>

    <table class="table">
        <thead>
        <tr>
            <th scope="col">ID</th>
            <th scope="col">Title</th>
            <th scope="col">Descriptions</th>
            <th scope="col">Action</th>
            <th scope="col">Delete</th>
        </tr>
        </thead>
        <tbody>
        <list-todo
            :todo="todo"
            v-on:todochanged="$emit('reloadlist')"
            v-for="todo in todos"
            :key="todo.id"
            class=""
        />
        </tbody>
    </table>

</template>

<script>
import listTodo from "./listTodo.vue";

export default {
    components: {
        listTodo
    },
    props: ["todos"]
};
</script>

<style scoped></style>
