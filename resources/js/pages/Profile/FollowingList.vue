<script setup>
import { Link, router } from "@inertiajs/vue3";

defineOptions({
    inheritAttrs: false,
});

const props = defineProps({
    following_list: {
        type: Array,
    },
});

//user follow
function followUser(userId) {
    router.post(`/profile/${userId}/follow`, {
        preserveScroll: true,
    });
}
</script>

<template>
    <div
        class="bg-white border-2 border-black rounded-lg shadow mx-auto max-w-none px-4 py-5 sm:px-6"
    >
        <div class="px-6 py-4">
            <h2 class="text-xl font-bold mb-4">Following</h2>
            <ul v-if="props.following_list.length > 0">
                <li
                    v-for="following in props.following_list"
                    :key="following.id"
                    class="py-2"
                >
                    <div class="flex items-center justify-between">
                        <div class="flex items-center space-x-2">
                            <img
                                :src="following.avatar_path"
                                :alt="following.first_name"
                                class="h-10 w-10 rounded-full object-cover"
                            />
                            <span class="text-lg font-medium text-gray-800">
                                {{ following.first_name }}
                                {{ following.last_name }}
                            </span>
                        </div>
                        <Link
                            href="#"
                            @click="followUser(following.id)"
                            as="button"
                            type="button"
                            class="bg-black hover:bg-black text-white font-semibold py-2 px-3 rounded-full shadow-md focus:outline-none focus:ring-2 focus:ring-sky-500 focus:ring-offset-2 focus:ring-offset-gray-100 text-xs"
                        >
                            Unfollow
                        </Link>
                    </div>
                </li>
            </ul>
            <div v-else class="flex justify-center items-center h-24">
                <p class="text-lg text-gray-500">No Following Yet!</p>
            </div>
        </div>
    </div>
</template>

<style scoped></style>
