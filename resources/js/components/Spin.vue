<template>
    <div class="spinner-border text-warning" role="status">
        <span class="sr-only">Loading...</span>
    </div>
</template>

<script>
    export default {
        name: "Spin"
    }
</script>

<style scoped>
    .spinner-border {
        position: absolute;
        left: 50%;
        top: 50%;
    }
</style>
