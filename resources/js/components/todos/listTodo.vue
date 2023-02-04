<style>
    .completed {
        text-decoration: line-through;
        color: white;
        background-color: #146c43;
        width: 100%;
    }
    .todo {
        word-break: break-all;
    }
</style>

<template>
    <tr>
        <th scope="row">{{ todo.id}}</th>
        <th scope="row">{{ todo.title}}</th>
        <td>{{ todo.desc }}</td>
        <td>
            <div class="form-group">
                <select v-model="todo.status" @change="updateTodo()" class="custom-select">
                    <option disabled value="">Please Select</option>
                    <option value="HOLD">HOLD</option>
                    <option value="IN PROGRESS">IN PROGRESS</option>
                    <option value="COMPLETED">COMPLETED</option>
                    <option value="CANCELLED">CANCELLED</option>
                </select>
            </div>
        </td>
        <td>
            <button @click="removeTodo()" class="btn btn-outline-danger">Trash</button>
        </td>
    </tr>

</template>
<script>
export default {
    props: ["todo"],
    methods: {
        updateTodo() {
            axios.put(`todos/${this.todo.id}`, {
                    status: this.todo.status,
                })
                .then(response => {
                    if (response.status == 200) {
                        this.$emit("todochanged");
                    }
                })
                .catch(error => {
                    this.errors = error.response.data.errors;
                    if (this.errors) {
                        alert(Object.entries(this.errors).map(value => `* ${value}`).join('\n'));
                    }
                });
        },
        removeTodo() {
            axios.delete(`todos/${this.todo.id}`)
                .then(response => {
                    if (response.status == 200) {
                        this.$emit("todochanged");
                    }
                })
                .catch(error => {
                    console.log("error from axios delte ", error);
                    this.errors = error.response.data.errors;
                    if (this.errors) {
                        alert(Object.entries(this.errors).map(value => `* ${value}`).join('\n'));
                    }
                });
        }
    }
};
</script>

