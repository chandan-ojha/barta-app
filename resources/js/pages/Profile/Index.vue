<script setup>
import { ref } from "vue";
import { router, Link, usePage } from "@inertiajs/vue3";
import { format } from "date-fns";
import { flashMessage } from "../../utils/functions";
import NavBar from "../Shared/NavBar.vue";
import Footer from "../Shared/Footer.vue";
import BartaPost from "../../components/barta/BartaPost.vue";

const page = usePage();
const showMenu = ref(0);

const props = defineProps({
    user: {
        type: Object,
    },
    errors: {
        type: Object,
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
    <Head title="Profile" />
    <NavBar />
    <main class="container max-w-2xl mx-auto space-y-8 mt-8 px-2 min-h-screen">
        <!-- Cover Container -->
        <section
            class="bg-white border-2 p-8 border-gray-800 rounded-xl min-h-[350px] space-y-8 flex items-center flex-col justify-center"
        >
            <!-- Profile Info -->
            <div
                class="flex gap-4 justify-center flex-col text-center items-center"
            >
                <!-- Avatar -->
                <div class="relative">
                    <img
                        class="w-32 h-32 rounded-full border-2 border-gray-800"
                        :src="props.user.avatar_path"
                        alt="Chandan Ojha"
                    />
                    <span
                        class="bottom-2 right-4 absolute w-3.5 h-3.5 bg-green-400 border-2 border-white dark:border-gray-800 rounded-full"
                    ></span>
                </div>
                <!-- /Avatar -->

                <!-- User Meta -->
                <div>
                    <h1 class="font-bold md:text-2xl">
                        {{ props.user.first_name }} {{ props.user.last_name }}
                    </h1>
                    <p class="text-gray-700">{{ props.user.bio }}</p>
                </div>
                <!-- / User Meta -->
            </div>
            <!-- /Profile Info -->

            <!-- Profile Stats -->
            <div
                class="flex flex-row gap-16 justify-center text-center items-center"
            >
                <!-- Total Posts Count -->
                <div class="flex flex-col justify-center items-center">
                    <h4 class="sm:text-xl font-bold">
                        {{ props.user.total_posts }}
                    </h4>
                    <p class="text-gray-600">Posts</p>
                </div>

                <!-- Total Comments Count -->
                <div class="flex flex-col justify-center items-center">
                    <h4 class="sm:text-xl font-bold">
                        {{ props.user.total_comments }}
                    </h4>
                    <p class="text-gray-600">Comments</p>
                </div>

                <!--Follow me-->
                <div class="flex flex-col justify-center items-center">
                    <button
                        class="bg-sky-500 hover:bg-sky-600 text-white font-semibold py-2 px-3 rounded-full shadow-md focus:outline-none focus:ring-2 focus:ring-sky-500 focus:ring-offset-2 focus:ring-offset-gray-100 text-xs"
                    >
                        Follow Me
                    </button>
                </div>
            </div>
            <!-- /Profile Stats -->

            <!-- Edit Profile Button (Only visible to the profile owner) -->
            <Link
                v-if="props.user.id === $page.props.auth.user.id"
                :href="`/profile/edit/${$page.props.auth.user.id}`"
                type="button"
                class="-m-2 flex gap-2 items-center rounded-full px-4 py-2 font-semibold bg-gray-100 hover:bg-gray-200 text-gray-700"
            >
                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke-width="1.5"
                    stroke="currentColor"
                    class="w-5 h-5"
                >
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L6.832 19.82a4.5 4.5 0 01-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 011.13-1.897L16.863 4.487zm0 0L19.5 7.125"
                    />
                </svg>

                Edit Profile
            </Link>
            <!-- /Edit Profile Button -->
        </section>
        <!-- /Cover Container -->

        <!-- Barta Create Post Card -->
        <BartaPost :errors="props.errors" />
        <!-- /Barta Create Post Card -->

        <!-- User Specific Posts Feed -->
        <!-- Barta Card -->
        <article
            v-for="barta in props.user.posts"
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
                                :src="props.user.avatar_path"
                                :alt="props.user.first_name"
                            />
                        </div>
                        <!-- /User Avatar -->

                        <!-- User Info -->
                        <div class="text-gray-900 flex flex-col min-w-0 flex-1">
                            <Link
                                :href="`/profile/${props.user.id}`"
                                class="hover:underline font-semibold line-clamp-1"
                            >
                                {{ props.user.first_name }}
                                {{ props.user.last_name }}
                            </Link>

                            <Link
                                :href="`/profile/${props.user.id}`"
                                class="hover:underline text-sm text-gray-500 line-clamp-1"
                            >
                                @{{
                                    props.user.first_name
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
                                    Edit
                                </a>
                                <Link
                                    v-if="
                                        page.props.auth.user.id ===
                                        barta.user_id
                                    "
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
                <span>4,450 views</span>
            </div>

            <!-- Barta Card Bottom -->
            <footer class="border-t border-gray-200 pt-2">
                <!-- Card Bottom Action Buttons -->
                <div class="flex items-center justify-between">
                    <div class="flex gap-8 text-gray-600">
                        <!-- Comment Button -->
                        <button
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

                            <p>{{ barta.comments_count }}</p>
                        </button>
                        <!-- /Comment Button -->
                    </div>
                </div>
                <!-- /Card Bottom Action Buttons -->
            </footer>
            <!-- /Barta Card Bottom -->
        </article>
        <!-- /Barta Card -->
        <!-- User Specific Posts Feed -->
    </main>
    <Footer />
</template>

<style scoped></style>
