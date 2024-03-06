<script setup>
import { Link, router } from "@inertiajs/vue3";

defineOptions({
    inheritAttrs: false,
});

const props = defineProps({
    followers_list: {
        type: Array,
    },
    is_following: {
        type: Boolean,
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
            <h2 class="text-xl font-bold mb-4">Followers</h2>
            <ul v-if="props.followers_list.length > 0">
                <li
                    v-for="follower in props.followers_list"
                    :key="follower.id"
                    class="py-2"
                >
                    <div class="flex items-center justify-between">
                        <div class="flex items-center space-x-2">
                            <img
                                :src="follower.avatar_path"
                                :alt="follower.first_name"
                                class="h-10 w-10 rounded-full object-cover"
                            />
                            <span class="text-lg font-medium text-gray-800">
                                {{ follower.first_name }}
                                {{ follower.last_name }}
                            </span>
                        </div>
                        <Link
                            href="#"
                            @click="followUser(follower.id)"
                            as="button"
                            type="button"
                            class="bg-black hover:bg-black text-white font-semibold py-2 px-3 rounded-full shadow-md focus:outline-none focus:ring-2 focus:ring-sky-500 focus:ring-offset-2 focus:ring-offset-gray-100 text-xs"
                        >
                            {{ props.is_following ? "Unfollow" : "Follow" }}
                        </Link>
                    </div>
                </li>
            </ul>
            <div v-else class="flex justify-center items-center h-24">
                <p class="text-lg text-gray-500">No Follower Yet!</p>
            </div>
        </div>
    </div>
</template>

<style scoped></style>
