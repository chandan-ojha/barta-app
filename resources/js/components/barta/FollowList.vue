<script setup>
import { Link, router } from "@inertiajs/vue3";
const props = defineProps({
    follow_list: {
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
    <div class="w-5/6 mt-8">
        <div class="bg-gray-200 rounded-lg shadow-md p-4">
            <h2 class="text-xl font-bold mb-4">Who to follow</h2>
            <div class="flex flex-col space-y-4">
                <div
                    v-for="follow in props.follow_list"
                    :key="follow.id"
                    class="flex items-center justify-between"
                >
                    <div class="flex items-center">
                        <img
                            :src="follow.avatar_path"
                            :alt="follow.first_name"
                            class="h-10 w-10 rounded-full"
                        />

                        <div class="ml-4">
                            <Link
                                :href="`/profile/${follow.id}`"
                                class="font-semibold hover:underline"
                            >
                                {{ follow.first_name }}
                                {{ follow.last_name }}
                            </Link>
                            <p class="text-gray-500 text-sm">
                                @{{
                                    follow.first_name
                                        .split(" ")[0]
                                        .toLowerCase()
                                }}
                            </p>
                        </div>
                    </div>

                    <Link
                        href="#"
                        @click="followUser(follow.id)"
                        as="button"
                        type="button"
                        class="bg-black text-white px-2 py-1 rounded-full text-xs"
                    >
                        Follow
                    </Link>
                </div>
            </div>
            <Link
                href="#"
                class="block text-sky-400 hover:underline mt-4 font-semibold"
            >
                Show More
            </Link>
        </div>
    </div>
</template>

<style scoped></style>
