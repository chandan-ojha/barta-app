<script setup>
import { ref } from "vue";
import { router, Link, usePage } from "@inertiajs/vue3";
import { format } from "date-fns";
import { flashMessage } from "../../utils/functions";
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
};
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
                            src="https://avatars.githubusercontent.com/u/61087593"
                            alt="Chandan"
                        />
                    </div>
                    <!-- /User Avatar -->

                    <!-- User Info -->
                    <div class="text-gray-900 flex flex-col min-w-0 flex-1">
                        <Link
                            href="#"
                            preserve-scroll
                            class="hover:underline font-semibold line-clamp-1"
                        >
                            Chandan Ojha
                        </Link>

                        <Link
                            href="#"
                            preserve-scroll
                            class="hover:underline text-sm text-gray-500 line-clamp-1"
                        >
                            @chandan
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
                    <Link
                        href="#"
                        type="button"
                        class="-m-2 flex gap-2 text-xs items-center rounded-full p-2 text-gray-600 hover:text-gray-800"
                    >
                        <span class="sr-only">Like</span>
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            fill="none" viewBox="0 0 24 24"
                            stroke-width="2"
                            stroke="currentColor"
                            class="w-5 h-5">
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M6.633 10.25c.806 0 1.533-.446 2.031-1.08a9.041 9.041 0 0 1 2.861-2.4c.723-.384 1.35-.956 1.653-1.715a4.498 4.498 0 0 0 .322-1.672V2.75a.75.75 0 0 1 .75-.75 2.25 2.25 0 0 1 2.25 2.25c0 1.152-.26 2.243-.723 3.218-.266.558.107 1.282.725 1.282m0 0h3.126c1.026 0 1.945.694 2.054 1.715.045.422.068.85.068 1.285a11.95 11.95 0 0 1-2.649 7.521c-.388.482-.987.729-1.605.729H13.48c-.483 0-.964-.078-1.423-.23l-3.114-1.04a4.501 4.501 0 0 0-1.423-.23H5.904m10.598-9.75H14.25M5.904 18.5c.083.205.173.405.27.602.197.4-.078.898-.523.898h-.908c-.889 0-1.713-.518-1.972-1.368a12 12 0 0 1-.521-3.507c0-1.553.295-3.036.831-4.398C3.387 9.953 4.167 9.5 5 9.5h1.053c.472 0 .745.556.5.96a8.958 8.958 0 0 0-1.302 4.665c0 1.194.232 2.333.654 3.375Z" />
                        </svg>

                        <p>5</p>
                    </Link>
                    <!-- /Like Button -->
                    <!-- Dislike Button -->
                    <Link
                        href="#"
                        type="button"
                        class="-m-2 flex gap-2 text-xs items-center rounded-full p-2 text-gray-600 hover:text-gray-800"
                    >
                        <span class="sr-only">Dislike</span>
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            fill="none" viewBox="0 0 24 24"
                            stroke-width="2"
                            stroke="currentColor"
                            class="w-5 h-5">
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M7.498 15.25H4.372c-1.026 0-1.945-.694-2.054-1.715a12.137 12.137 0 0 1-.068-1.285c0-2.848.992-5.464 2.649-7.521C5.287 4.247 5.886 4 6.504 4h4.016a4.5 4.5 0 0 1 1.423.23l3.114 1.04a4.5 4.5 0 0 0 1.423.23h1.294M7.498 15.25c.618 0 .991.724.725 1.282A7.471 7.471 0 0 0 7.5 19.75 2.25 2.25 0 0 0 9.75 22a.75.75 0 0 0 .75-.75v-.633c0-.573.11-1.14.322-1.672.304-.76.93-1.33 1.653-1.715a9.04 9.04 0 0 0 2.86-2.4c.498-.634 1.226-1.08 2.032-1.08h.384m-10.253 1.5H9.7m8.075-9.75c.01.05.027.1.05.148.593 1.2.925 2.55.925 3.977 0 1.487-.36 2.89-.999 4.125m.023-8.25c-.076-.365.183-.75.575-.75h.908c.889 0 1.713.518 1.972 1.368.339 1.11.521 2.287.521 3.507 0 1.553-.295 3.036-.831 4.398-.306.774-1.086 1.227-1.918 1.227h-1.053c-.472 0-.745-.556-.5-.96a8.95 8.95 0 0 0 .303-.54" />
                        </svg>

                        <p>1</p>
                    </Link>
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

                        <p>2</p>
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
                            fill="none" viewBox="0 0 24 24"
                            stroke-width="2"
                            stroke="currentColor"
                            class="w-5 h-5">
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M7.217 10.907a2.25 2.25 0 1 0 0 2.186m0-2.186c.18.324.283.696.283 1.093s-.103.77-.283 1.093m0-2.186 9.566-5.314m-9.566 7.5 9.566 5.314m0 0a2.25 2.25 0 1 0 3.935 2.186 2.25 2.25 0 0 0-3.935-2.186Zm0-12.814a2.25 2.25 0 1 0 3.933-2.185 2.25 2.25 0 0 0-3.933 2.185Z" />
                        </svg>

                        <p>3</p>
                    </Link>
                    <!-- /Like Button -->
                </div>
            </div>
            <!-- /Card Bottom Action Buttons -->
        </footer>
        <!-- /Barta Card Bottom -->
    </article>
</template>

<style scoped></style>
