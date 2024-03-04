<script setup>
import { ref } from "vue";
import { Link } from "@inertiajs/vue3";
import NavBar from "../Shared/NavBar.vue";
import Footer from "../Shared/Footer.vue";
import BartaList from "./BartaList.vue";
import FollowingList from "./FollowingList.vue";

const props = defineProps({
    user: {
        type: Object,
    },
    following_list: {
        type: Array,
    },
    errors: {
        type: Object,
    },
});

const postFeed = ref(true);

const showFollowingList = () => {
    postFeed.value = false;
};
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

            <!-- Edit Profile Button (Only visible to the profile owner) -->
            <Link
                v-if="props.user.id === $page.props.auth.user.id"
                :href="`/profile/edit/${$page.props.auth.user.id}`"
                type="button"
                class="-m-2 flex gap-2 items-center rounded-full px-3 py-2 font-semibold bg-gray-100 hover:bg-gray-200 text-gray-700 text-xs transition duration-300 ease-in-out transform hover:scale-105"
            >
                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke-width="1.5"
                    stroke="currentColor"
                    class="w-4 h-4"
                >
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L6.832 19.82a4.5 4.5 0 01-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 011.13-1.897L16.863 4.487zm0 0L19.5 7.125"
                    />
                </svg>
                <span class="font-bold">Edit Profile</span>
            </Link>
            <!-- /Edit Profile Button -->

            <!-- Profile Stats -->
            <div
                class="flex flex-row gap-11 justify-center text-center items-center"
            >
                <!-- Posts-->
                <div class="flex flex-col justify-center items-center">
                    <h4 class="text-lg font-semibold">
                        {{ props.user.total_posts }}
                    </h4>
                    <button
                        @click="postFeed = true"
                        class="text-gray-600 text-xs font-bold hover:text-sky-500 transition duration-300"
                    >
                        Posts
                    </button>
                </div>
                <!-- Following-->
                <div class="flex flex-col justify-center items-center">
                    <h4 class="text-lg font-semibold">100</h4>
                    <button
                        @click="showFollowingList"
                        class="text-gray-600 text-xs font-bold hover:text-sky-500 transition duration-300"
                    >
                        Following
                    </button>
                </div>

                <!-- Followers-->
                <div class="flex flex-col justify-center items-center">
                    <h4 class="text-lg font-semibold">500</h4>
                    <button
                        class="text-gray-600 text-xs font-bold hover:text-sky-500 transition duration-300"
                    >
                        Followers
                    </button>
                </div>

                <!--Follow me-->
                <div
                    v-show="props.user.id !== $page.props.auth.user.id"
                    class="flex flex-col justify-center items-center"
                >
                    <button
                        class="bg-black hover:bg-black text-white font-semibold py-2 px-3 rounded-full shadow-md focus:outline-none focus:ring-2 focus:ring-sky-500 focus:ring-offset-2 focus:ring-offset-gray-100 text-xs"
                    >
                        Follow Me
                    </button>
                </div>
            </div>
            <!-- /Profile Stats -->
        </section>
        <!-- /Cover Container -->

        <!-- User Specific Posts Feed -->
        <BartaList v-if="postFeed" :user="props.user" />
        <!-- User Specific Posts Feed -->
        <!-- User Following list -->
        <FollowingList v-else :following_list="props.following_list" />
        <!-- /User Following list -->
    </main>
    <Footer />
</template>

<style scoped></style>
