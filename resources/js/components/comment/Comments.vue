<script setup>
import { ref } from "vue";
import { router, Link, usePage } from "@inertiajs/vue3";
import { flashMessage } from "../../utils/functions";
import { format } from "date-fns";

const showMenu = ref(0);
const page = usePage();
const props = defineProps({
    comments: {
        type: Array,
    },
});

const toggleMenu = (commentId) => {
    if (showMenu.value === commentId) {
        showMenu.value = 0;
    } else {
        showMenu.value = commentId;
    }
};

//comment delete
function comment_delete(commentId) {
    router.delete(`/comment-delete/${commentId}`, {
        preserveScroll: true,
        onSuccess: () => {
            flashMessage({
                type: "success",
                message: page.props.flash.success,
            });
        },
    });
}
</script>

<template>
    <div class="flex flex-col space-y-6">
        <h1 class="text-lg font-semibold">Comments ({{ comments.length }})</h1>

        <!-- Barta User Comments Container -->
        <article
            class="bg-white border-2 border-black rounded-lg shadow mx-auto max-w-none px-4 py-2 sm:px-6 min-w-full divide-y"
        >
            <!-- Comments -->
            <div
                v-for="comment in props.comments"
                :key="comment.id"
                class="py-4"
            >
                <!-- Barta User Comments Top -->
                <header>
                    <div class="flex items-center justify-between">
                        <div class="flex items-center space-x-3">
                            <!-- User Avatar -->
                            <div class="flex-shrink-0">
                                <img
                                    class="h-10 w-10 rounded-full object-cover"
                                    :src="comment.user.avatar_path"
                                    :alt="comment.user.first_name"
                                />
                            </div>
                            <!-- /User Avatar -->
                            <!-- User Info -->
                            <div
                                class="text-gray-900 flex flex-col min-w-0 flex-1"
                            >
                                <Link
                                    :href="`/profile/${comment.user.id}`"
                                    class="hover:underline font-semibold line-clamp-1"
                                >
                                    {{ comment.user.first_name }}
                                    {{ comment.user.last_name }}
                                </Link>

                                <Link
                                    :href="`/profile/${comment.user.id}`"
                                    class="hover:underline text-sm text-gray-500 line-clamp-1"
                                >
                                    @{{
                                        comment.user.first_name
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
                                        @click="toggleMenu(comment.id)"
                                        type="button"
                                        class="-m-2 flex items-center rounded-full p-2 text-gray-400 hover:text-gray-600"
                                        id="menu-0-button"
                                    >
                                        <span class="sr-only"
                                            >Open options</span
                                        >
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
                                    v-show="showMenu === comment.id"
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
                                        Edit
                                    </a>
                                    <Link
                                        v-if="
                                            page.props.auth.user.id ===
                                            comment.user_id
                                        "
                                        @click="comment_delete(comment.id)"
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
                <div class="py-4 text-gray-700 font-normal">
                    <p>{{ comment.body }}</p>
                </div>

                <!-- Date Created -->
                <div class="flex items-center gap-2 text-gray-500 text-xs">
                    <span class="">
                        {{
                            format(
                                new Date(comment.created_at),
                                "MMMM dd, yyyy"
                            )
                        }}
                    </span>
                </div>
            </div>
            <!-- /Comments -->
        </article>
        <!-- /Barta User Comments -->
    </div>
</template>

<style scoped></style>
