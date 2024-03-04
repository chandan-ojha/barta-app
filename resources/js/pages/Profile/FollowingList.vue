<script setup>
const props = defineProps({
    following_list: {
        type: Array,
    },
});
</script>

<template>
    <div
        class="bg-white border-2 border-black rounded-lg shadow mx-auto max-w-none px-4 py-5 sm:px-6"
    >
        <div class="px-6 py-4">
            <h2 class="text-xl font-bold mb-4">Following</h2>
            <ul>
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
                        <button
                            class="bg-black hover:bg-black text-white font-semibold py-2 px-3 rounded-full shadow-md focus:outline-none focus:ring-2 focus:ring-sky-500 focus:ring-offset-2 focus:ring-offset-gray-100 text-xs"
                        >
                            Unfollow
                        </button>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</template>

<style scoped></style>
