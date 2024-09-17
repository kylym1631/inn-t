<template>
    <div v-if="message" class="fixed bottom-4 right-5 transform -translate-x-1/2 bg-green-100 p-4 rounded text-green-800 shadow-md">
        {{ message }}
    </div>
</template>

<script>
export default {
    props: ['message'],
};
</script>
