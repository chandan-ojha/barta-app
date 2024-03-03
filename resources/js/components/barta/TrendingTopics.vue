<script setup>
import { Link, router } from "@inertiajs/vue3";

const props = defineProps({
    tags: {
        type: Array,
    },
});

//barta filter by tag
function barta_filter_by_tag(tag) {
    router.get("/", {
        tag: tag,
    });
}
</script>

<template>
    <div class="w-5/6">
        <div class="bg-gray-200 rounded-lg shadow-md p-4">
            <h2 class="text-xl font-bold mb-4">Trends for you</h2>
            <ul class="space-y-2">
                <li v-for="tag in props.tags" :key="tag.id" class="mb-2">
                    <Link
                        href="#"
                        @click="barta_filter_by_tag(tag.title)"
                        class="font-semibold hover:underline"
                    >
                        #{{ tag.title }}
                    </Link>
                    <span class="block text-gray-500 text-sm">
                        {{ tag.posts_count }} posts
                    </span>
                </li>
            </ul>
            <a
                href="#"
                class="block text-sky-400 hover:underline mt-4 font-semibold"
            >
                Show More
            </a>
        </div>
    </div>
</template>

<style scoped></style>
