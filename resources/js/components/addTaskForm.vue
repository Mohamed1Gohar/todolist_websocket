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
                    <input v-model="task.title" type="text" required class="form-control" id="title" aria-describedby="emailHelp" placeholder="Enter Title">
                </div>
                <div class="form-group">
                    <label for="description">Description </label>
                    <textarea v-model="task.desc" class="form-control" id="description" rows="3" placeholder="Enter Description..."></textarea>
                </div>
                <div class="form-group">
                    <button
                        :class="[task.title ? 'active' : 'inactive']"
                        @click="addTask()"
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
            task: {
                title: "",
                desc: "",
            }
        };
    },
    methods: {
        addTask() {
            axios.post("tasks", {
                title: this.task.title,
                desc: this.task.desc,
                })
                .then(response => {
                    if (response.status == 200) {
                        this.task.title = "";
                        this.task.desc = "";
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
