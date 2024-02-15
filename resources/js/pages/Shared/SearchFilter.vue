<script setup>
import { ref, watch } from "vue";
import { router } from "@inertiajs/vue3";

const search_key = ref("");

//barta search
function barta_search() {
    router.get("/", {
        search_key: search_key.value,
    });
}

watch(search_key, () => {
    barta_search();
});
</script>

<template>
    <form @submit.prevent="barta_search" class="flex items-center">
        <input
            v-model="search_key"
            type="text"
            placeholder="Search..."
            class="border-2 border-gray-300 bg-white h-10 px-11 pr-16 rounded-full text-sm focus:outline-none"
        />
    </form>
</template>

<style scoped></style>
