<template>
    <div :class="columnClass">
        <h2 class="text-2xl font-semibold mb-4">{{ title }}</h2>
        <task-item
            v-for="task in tasks"
            :key="task.id"
            :task="task"
            @update-task="updateTask"
            @delete-task="deleteTask"
        />
    </div>
</template>

<script>
import TaskItem from "./TaskItem.vue";

export default {
    components: { TaskItem },
    props: {
        title: String,
        tasks: Array,
        columnClass: String,
    },
    methods: {
        updateTask(task, message) {
            this.$emit("update-task", task, message);
        },
        deleteTask(taskId, message) {
            this.$emit("delete-task", taskId, message);
        },
    },
};
</script>
