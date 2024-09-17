<template>
    <form @submit.prevent="addTask" class="mb-4 flex items-center space-x-4">
        <input
            v-model="description"
            placeholder="Новая задача"
            class="border rounded-2xl p-2 flex-grow"
        />
        <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded-2xl whitespace-nowrap">
            Добавить задачу
        </button>
    </form>
</template>

<script>
import axios from "axios";

export default {
    data() {
        return {
            description: "",
        };
    },
    methods: {
        addTask() {
            axios
                .post("/api/tasks", { description: this.description, status: "todo" })
                .then(() => {
                    this.description = "";
                    this.$emit("task-added", "Задача успешно добавлена");
                });
        },
    },
};
</script>
