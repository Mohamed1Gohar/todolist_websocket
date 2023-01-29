<style>
    .completed {
        text-decoration: line-through;
        color: white;
        background-color: #146c43;
        width: 100%;
    }
    .task {
        word-break: break-all;
    }
</style>

<template>
    <tr>
        <th scope="row">{{ task.id}}</th>
        <th scope="row">{{ task.title}}</th>
        <td>{{ task.desc }}</td>
        <td>
            <div class="form-group">
                <select v-model="task.status" @change="updateTask()" class="custom-select">
                    <option disabled value="">Please Select</option>
                    <option value="HOLD">HOLD</option>
                    <option value="IN PROGRESS">IN PROGRESS</option>
                    <option value="COMPLETED">COMPLETED</option>
                    <option value="CANCELLED">CANCELLED</option>
                </select>
            </div>
        </td>
        <td>
            <button @click="removeTask()" class="btn btn-outline-danger">Trash</button>
        </td>
    </tr>

</template>
<script>
export default {
    props: ["task"],
    methods: {
        updateTask() {
            axios.put(`api/v1/tasks/${this.task.id}`, {
                    status: this.task.status,
                })
                .then(response => {
                    if (response.status == 200) {
                        this.$emit("taskchanged");
                    }
                })
                .catch(error => {
                    this.errors = error.response.data.errors;
                    if (this.errors) {
                        alert(Object.entries(this.errors).map(value => `* ${value}`).join('\n'));
                    }
                });
        },
        removeTask() {
            axios.delete(`api/v1/tasks/${this.task.id}`)
                .then(res => {
                    if (res.status == 200) {
                        this.$emit("taskchanged");
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

