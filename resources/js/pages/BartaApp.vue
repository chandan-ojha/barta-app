<script setup>
import NavBar from "../components/common/NavBar.vue";
import Footer from "../components/common/Footer.vue";
import BartaPost from "../components/barta/BartaPost.vue";
import Barta from "../components/barta/Barta.vue";
</script>

<template>
    <NavBar />
    <main
        class="container max-w-xl mx-auto space-y-8 mt-8 px-2 md:px-0 min-h-screen"
    >
        <!-- Barta Create Post Card -->
        <BartaPost />
        <!-- /Barta Create Post Card -->

        <!-- Newsfeed -->
        <section id="newsfeed" class="space-y-6">
            <!-- Barta Card -->
            <Barta />
            <Barta />
            <Barta />
            <Barta />
            <!-- /Barta Card -->
        </section>
        <!-- /Newsfeed -->
    </main>
    <Footer />
</template>

<style scoped></style>
