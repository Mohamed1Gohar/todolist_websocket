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
        <list-task
            :task="task"
            v-on:taskchanged="$emit('reloadlist')"
            v-for="task in tasks"
            :key="task.id"
            class=""
        />
        </tbody>
    </table>

</template>

<script>
import listTask from "./listTask.vue";

export default {
    components: {
        listTask
    },
    props: ["tasks"]
};
</script>

<style scoped></style>
