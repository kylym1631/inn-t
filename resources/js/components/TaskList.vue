<template>
    <div class="container mx-auto p-4">
        <task-form @task-added="fetchTasksWithMessage" />

        <alert-message :message="message" />

        <div class="grid grid-cols-3 gap-4">
            <task-column
                title="Нужно сделать"
                :tasks="todoTasks"
                column-class="bg-yellow-100 p-4 rounded-2xl"
                @update-task="updateTask"
                @delete-task="deleteTask"
            />
            <task-column
                title="В процессе"
                :tasks="doingTasks"
                column-class="bg-green-100 p-4 rounded-2xl"
                @update-task="updateTask"
                @delete-task="deleteTask"
            />
            <task-column
                title="Сделано"
                :tasks="doneTasks"
                column-class="bg-blue-100 p-4 rounded-2xl"
                @update-task="updateTask"
                @delete-task="deleteTask"
            />
        </div>
    </div>
</template>

<script>
import TaskForm from "./TaskForm.vue";
import AlertMessage from "./AlertMessage.vue";
import TaskColumn from "./TaskColumn.vue";
import axios from "axios";

export default {
    components: { TaskForm, AlertMessage, TaskColumn },
    data() {
        return {
            tasks: [],
            message: "",
        };
    },
    computed: {
        todoTasks() {
            return this.tasks.filter(task => task.status === "todo");
        },
        doingTasks() {
            return this.tasks.filter(task => task.status === "doing");
        },
        doneTasks() {
            return this.tasks.filter(task => task.status === "done");
        },
    },
    created() {
        this.fetchTasks();
    },
    methods: {
        fetchTasks() {
            axios.get("/api/tasks").then((response) => {
                this.tasks = response.data;
            });
        },
        fetchTasksWithMessage(message) {
            this.fetchTasks();
            this.showMessage(message);
        },
        updateTask(updatedTask, message) {
            axios.put(`/api/tasks/${updatedTask.id}`, updatedTask).then(() => {
                const index = this.tasks.findIndex((task) => task.id === updatedTask.id);
                this.tasks.splice(index, 1, updatedTask);
                this.showMessage(message);
            });
        },
        deleteTask(taskId, message) {
            axios.delete(`/api/tasks/${taskId}`).then(() => {
                this.tasks = this.tasks.filter((task) => task.id !== taskId);
                this.showMessage(message);
            });
        },
        showMessage(message) {
            this.message = message;
            setTimeout(() => {
                this.message = "";
            }, 3000);
        },
    },
};
</script>
