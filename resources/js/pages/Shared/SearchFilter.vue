<script setup>
import { ref, watch } from "vue";
import { router } from "@inertiajs/vue3";

const search = ref("");

//barta search
function barta_search() {
    router.get("/", {
        search: search.value,
    });
}

watch(search, () => {
    barta_search();
});
</script>

<template>
    <form @submit.prevent="barta_search" class="flex items-center">
        <input
            v-model="search"
            type="text"
            placeholder="Search..."
            class="border-2 border-gray-300 bg-white h-10 px-11 pr-16 rounded-full text-sm focus:outline-none"
        />
    </form>
</template>

<style scoped></style>
