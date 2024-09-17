<template>
    <div class="p-4 border rounded-2xl mb-4 bg-white shadow-md">
        <div v-if="editMode" class="flex items-center space-x-2">
            <input
                v-model="newDescription"
                @keyup.enter="saveTask"
                class="border rounded-2xl p-2 w-full"
            />
            <button @click="saveTask" class="bg-blue-500 text-white px-4 py-2 rounded-2xl">
                Сохранить
            </button>
        </div>

        <div v-else>
            <p class="text-gray-500 text-sm"> #{{task.id}}</p>
            <p class="font-semibold text-xl">{{ task.description }}</p>

            <select
                v-model="selectedStatus"
                @change="updateStatus"
                class="mt-2 border rounded-full px-3 py-2"
            >
                <option value="todo">Нужно сделать</option>
                <option value="doing">В процессе</option>
                <option value="done">Сделано</option>
            </select>

            <div class="mt-4">
                <button @click="toggleEdit" class="px-4 py-2 bg-yellow-500 text-white rounded-2xl mr-2">
                    Редактировать
                </button>
                <button @click="deleteTask" class="px-4 py-2 bg-red-500 text-white rounded-2xl">
                    Удалить
                </button>
            </div>
            <p class="text-gray-500 text-xs mt-2 ">Создано: {{ task.created_at }}</p>
        </div>
    </div>
</template>

<script>
export default {
    props: ["task"],
    data() {
        return {
            editMode: false,
            newDescription: this.task.description,
            selectedStatus: this.task.status,
        };
    },
    methods: {
        toggleEdit() {
            this.editMode = !this.editMode;
        },
        saveTask() {
            this.$emit("update-task", { ...this.task, description: this.newDescription }, "Задача успешно обновлена");
            this.editMode = false;
        },
        deleteTask() {
            this.$emit("delete-task", this.task.id, "Задача успешно удалена");
        },
        updateStatus() {
            this.$emit("update-task", { ...this.task, status: this.selectedStatus }, "Статус задачи успешно изменен");
        },
    },
};
</script>
