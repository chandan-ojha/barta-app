<script setup>
import Comment from "./Comment.vue";
</script>

<template>
    <div class="flex flex-col space-y-6">
        <h1 class="text-lg font-semibold">Comments (3)</h1>

        <!-- Barta User Comments Container -->
        <article
            class="bg-white border-2 border-black rounded-lg shadow mx-auto max-w-none px-4 py-2 sm:px-6 min-w-full divide-y"
        >
            <!-- Comments -->
            <Comment />
            <Comment />
            <!-- /Comments -->
        </article>
        <!-- /Barta User Comments -->
    </div>
</template>

<style scoped></style>
