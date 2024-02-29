<script setup>
import { usePage } from "@inertiajs/vue3";
import NavBar from "./Shared/NavBar.vue";
import Footer from "./Shared/Footer.vue";
import BartaPost from "../components/barta/BartaPost.vue";
import Barta from "../components/barta/Barta.vue";
import TrendingTopics from "../components/barta/TrendingTopics.vue";
import FollowersList from "../components/barta/FollowersList.vue";

const props = defineProps({
    bartas: {
        type: Array,
    },
    errors: {
        type: Object,
    },
});
</script>

<template>
    <Head title="Home" />
    <NavBar />
    <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mt-8">
        <main
            class="container max-w-xl mx-96 space-y-8 px-2 md:px-0 md:col-span-3 min-h-screen"
        >
            <!-- Barta Create Post Card -->
            <BartaPost :errors="props.errors" />
            <!-- /Barta Create Post Card -->

            <!-- Newsfeed -->
            <section id="newsfeed" class="space-y-6">
                <!-- Barta Card -->
                <Barta :bartas="props.bartas" />
                <!-- /Barta Card -->
            </section>
            <!-- /Newsfeed -->
        </main>
        <!-- Trending Topics & Follower List -->
        <div class="md:col-span-1">
            <TrendingTopics />
            <FollowersList />
        </div>
    </div>
    <Footer />
</template>

<style scoped></style>
