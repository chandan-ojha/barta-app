<script setup>
import { Link } from "@inertiajs/vue3";
const props = defineProps({
    followers: {
        type: Array,
    },
});
</script>

<template>
    <div class="w-5/6 mt-8">
        <div class="bg-gray-200 rounded-lg shadow-md p-4">
            <h2 class="text-xl font-bold mb-4">Who to follow</h2>
            <div class="flex flex-col space-y-4">
                <div
                    v-for="follower in props.followers"
                    :key="follower.id"
                    class="flex items-center justify-between"
                >
                    <div class="flex items-center">
                        <img
                            :src="follower.avatar_path"
                            :alt="follower.first_name"
                            class="h-10 w-10 rounded-full"
                        />

                        <div class="ml-4">
                            <Link
                                :href="`/profile/${follower.id}`"
                                class="font-semibold hover:underline"
                            >
                                {{ follower.first_name }}
                                {{ follower.last_name }}
                            </Link>
                            <p class="text-gray-500 text-sm">
                                @{{
                                    follower.first_name
                                        .split(" ")[0]
                                        .toLowerCase()
                                }}
                            </p>
                        </div>
                    </div>

                    <button
                        class="bg-black text-white px-2 py-1 rounded-full text-xs"
                    >
                        Follow
                    </button>
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
