<style scoped>
.active {
    color: white;
    background-color: blue;
}
.inactive {
    color: gray;
}
</style>

<template>
    <div class="mt-3">
        <div class="container m-2 w-100">
            <form>
                <div class="form-group">
                    <label for="title">Email address</label>
                    <input v-model="todo.title" type="text" required class="form-control" id="title" aria-describedby="emailHelp" placeholder="Enter Title">
                </div>
                <div class="form-group">
                    <label for="description">Description </label>
                    <textarea v-model="todo.desc" class="form-control" id="description" rows="3" placeholder="Enter Description..."></textarea>
                </div>
                <div class="form-group">
                    <button
                        :class="[todo.title ? 'active' : 'inactive']"
                        @click="addTodo()"
                        type="button"
                        class="btn btn-primary"
                    >Add +</button>
                </div>
            </form>
        </div>
    </div>
</template>
<script>
export default {
    data: function() {
        return {
            todo: {
                title: "",
                desc: "",
            }
        };
    },
    methods: {
        addTodo() {
            axios.post("todos", {
                title: this.todo.title,
                desc: this.todo.desc,
                })
                .then(response => {
                    if (response.status == 200) {
                        this.todo.title = "";
                        this.todo.desc = "";
                        this.$emit("reloadlist");
                    }
                })
                .catch(error => {
                    this.errors = error.response.data.errors;
                    if (this.errors) {
                        alert(Object.entries(this.errors).map(value => `* ${value}`).join('\n'));
                    }
                });

        }
    }
};
</script>
