<script setup>
import { ref } from "vue";
import { router, Link, usePage } from "@inertiajs/vue3";
import { format } from "date-fns";
import { flashMessage } from "../../utils/functions";
import LikeButton from "./LikeButton.vue";
import DislikeButton from "./DislikeButton.vue";
const showMenu = ref(0);
const page = usePage();

const props = defineProps({
    bartas: {
        type: Array,
    },
});

const toggleMenu = (bartaId) => {
    if (showMenu.value === bartaId) {
        showMenu.value = 0;
    } else {
        showMenu.value = bartaId;
    }
};

//barta delete
function barta_delete(bartaId) {
    if (confirm("Are you sure you want to delete this barta?")) {
        router.delete(`/barta-delete/${bartaId}`, {
            preserveScroll: true,
            onSuccess: () => {
                flashMessage({
                    type: "success",
                    message: page.props.flash.success,
                });
            },
        });
    }
}
</script>

<template>
    <article
        v-for="barta in props.bartas"
        :key="barta.id"
        class="bg-white border-2 border-black rounded-lg shadow mx-auto max-w-none px-4 py-5 sm:px-6"
    >
        <!-- Barta Card Top -->
        <header>
            <div class="flex items-center justify-between">
                <div class="flex items-center space-x-3">
                    <!-- User Avatar -->
                    <div class="flex-shrink-0">
                        <img
                            class="h-10 w-10 rounded-full object-cover"
                            :src="barta.user.avatar_path"
                            :alt="barta.user.first_name"
                        />
                    </div>
                    <!-- /User Avatar -->

                    <!-- User Info -->
                    <div class="text-gray-900 flex flex-col min-w-0 flex-1">
                        <Link
                            :href="`/profile/${barta.user_id}`"
                            preserve-scroll
                            class="hover:underline font-semibold line-clamp-1"
                        >
                            {{ barta.user.first_name }}
                            {{ barta.user.last_name }}
                        </Link>

                        <Link
                            :href="`/profile/${barta.user_id}`"
                            preserve-scroll
                            class="hover:underline text-sm text-gray-500 line-clamp-1"
                        >
                            @{{
                                barta.user.first_name
                                    .split(" ")[0]
                                    .toLowerCase()
                            }}
                        </Link>
                    </div>
                    <!-- /User Info -->
                </div>

                <!-- Card Action Dropdown -->
                <div class="flex flex-shrink-0 self-center">
                    <div class="relative inline-block text-left">
                        <div>
                            <button
                                @click="toggleMenu(barta.id)"
                                type="button"
                                class="-m-2 flex items-center rounded-full p-2 text-gray-400 hover:text-gray-600"
                                id="menu-0-button"
                            >
                                <span class="sr-only">Open options</span>
                                <svg
                                    class="h-5 w-5"
                                    viewBox="0 0 20 20"
                                    fill="currentColor"
                                    aria-hidden="true"
                                >
                                    <path
                                        d="M10 3a1.5 1.5 0 110 3 1.5 1.5 0 010-3zM10 8.5a1.5 1.5 0 110 3 1.5 1.5 0 010-3zM11.5 15.5a1.5 1.5 0 10-3 0 1.5 1.5 0 003 0z"
                                    ></path>
                                </svg>
                            </button>
                        </div>
                        <!-- Dropdown menu -->
                        <div
                            v-show="showMenu === barta.id"
                            class="absolute right-0 z-10 mt-2 w-48 origin-top-right rounded-md bg-white py-1 shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none"
                            role="menu"
                            aria-orientation="vertical"
                            aria-labelledby="user-menu-button"
                            tabindex="-1"
                        >
                            <a
                                href="#"
                                class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100"
                                role="menuitem"
                                tabindex="-1"
                                id="user-menu-item-0"
                            >
                                Share
                            </a>
                            <a
                                href="#"
                                class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100"
                                role="menuitem"
                                tabindex="-1"
                                id="user-menu-item-0"
                            >
                                Edit
                            </a>
                            <Link
                                v-if="page.props.auth.user.id === barta.user_id"
                                @click="barta_delete(barta.id)"
                                href="#"
                                class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100"
                                role="menuitem"
                                tabindex="-1"
                                id="user-menu-item-1"
                            >
                                Delete
                            </Link>
                        </div>
                    </div>
                </div>
                <!-- /Card Action Dropdown -->
            </div>
        </header>

        <!-- Content -->
        <Link :href="`/barta-detail/${barta.id}`">
            <div class="py-4 text-gray-700 font-normal">
                <p>
                    {{ barta.body }}
                </p>
            </div>
        </Link>

        <!-- Date Created & View Stat -->
        <div class="flex items-center gap-2 text-gray-500 text-xs my-2">
            <span class="">
                {{ format(new Date(barta.created_at), "MMMM dd, yyyy") }}
            </span>
            <span class="">•</span>
            <span>450 views</span>
        </div>

        <!-- Barta Card Bottom -->
        <footer class="border-t border-gray-200 pt-2">
            <!-- Card Bottom Action Buttons -->
            <div class="flex items-center justify-between">
                <div class="flex gap-6 text-gray-600">
                    <!-- Like Button -->
                    <LikeButton :barta="barta" />
                    <!-- /Like Button -->
                    <!-- Dislike Button -->
                    <DislikeButton :barta="barta" />
                    <!-- /Dislike Button -->
                    <!-- Comment Button -->
                    <Link
                        :href="`/barta-detail/${barta.id}`"
                        type="button"
                        class="-m-2 flex gap-2 text-xs items-center rounded-full p-2 text-gray-600 hover:text-gray-800"
                    >
                        <span class="sr-only">Comment</span>
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke-width="2"
                            stroke="currentColor"
                            class="w-5 h-5"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M12 20.25c4.97 0 9-3.694 9-8.25s-4.03-8.25-9-8.25S3 7.444 3 12c0 2.104.859 4.023 2.273 5.48.432.447.74 1.04.586 1.641a4.483 4.483 0 01-.923 1.785A5.969 5.969 0 006 21c1.282 0 2.47-.402 3.445-1.087.81.22 1.668.337 2.555.337z"
                            />
                        </svg>

                        <p>{{ barta.total_comments ?? 0 }}</p>
                    </Link>
                    <!-- /Comment Button -->
                </div>
                <div class="flex gap-6 text-gray-600">
                    <!-- Share Button -->
                    <Link
                        href="#"
                        type="button"
                        class="-m-2 flex gap-2 text-xs items-center rounded-full p-2 text-gray-600 hover:text-gray-800"
                    >
                        <span class="sr-only">Share</span>
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke-width="2"
                            stroke="currentColor"
                            class="w-5 h-5"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M7.217 10.907a2.25 2.25 0 1 0 0 2.186m0-2.186c.18.324.283.696.283 1.093s-.103.77-.283 1.093m0-2.186 9.566-5.314m-9.566 7.5 9.566 5.314m0 0a2.25 2.25 0 1 0 3.935 2.186 2.25 2.25 0 0 0-3.935-2.186Zm0-12.814a2.25 2.25 0 1 0 3.933-2.185 2.25 2.25 0 0 0-3.933 2.185Z"
                            />
                        </svg>

                        <p>3</p>
                    </Link>
                    <!-- /Share Button -->
                </div>
            </div>
            <!-- /Card Bottom Action Buttons -->
        </footer>
        <!-- /Barta Card Bottom -->
    </article>

    <!-- No Barta Found message -->
    <div
        v-if="props.bartas.length === 0"
        class="text-center text-gray-500 py-8"
    >
        <div
            class="bg-white border-2 border-black rounded-lg shadow mx-auto max-w-none px-4 py-5 sm:px-6"
        >
            <p class="text-lg font-semibold mb-2">No Barta Found</p>
            <p class="text-sm">Please check back later!</p>
        </div>
    </div>
    <!-- /No Barta Found message -->
</template>

<style scoped></style>
