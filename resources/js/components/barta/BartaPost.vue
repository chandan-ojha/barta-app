<script setup>
import { useForm, usePage } from "@inertiajs/vue3";
const form = useForm({ body: "" });

function submit() {
    form.post("/barta-post", {
        preserveScroll: true,
        onSuccess: () => {
            form.reset();
        },
    });
}
</script>

<template>
    <form
        @submit.prevent="submit"
        class="bg-white border-2 border-black rounded-lg shadow mx-auto max-w-none px-4 py-5 sm:px-6 space-y-3"
    >
        <!-- Create Post Card Top -->
        <div>
            <div class="flex items-start /space-x-3/">
                <!-- User Avatar -->
                <div class="flex-shrink-0">
                    <img
                        class="h-10 w-10 rounded-full object-cover"
                        src="https://avatars.githubusercontent.com/u/61087593"
                        alt="Chandan"
                    />
                </div>
                <!-- User Avatar -->

                <!-- Content -->
                <div class="text-gray-700 font-normal w-full">
                    <textarea
                        class="block w-full p-2 pt-2 text-gray-900 rounded-lg border-none outline-none focus:ring-0 focus:ring-offset-0"
                        name="barta"
                        rows="2"
                        placeholder="What's going on, Chandan?"
                        v-model="form.body"
                    ></textarea>
                </div>
            </div>
        </div>

        <!-- Create Post Card Bottom -->
        <div>
            <!-- Card Bottom Action Buttons -->
            <div class="flex items-center justify-end">
                <div>
                    <!-- Post Button -->
                    <button
                        type="submit"
                        class="-m-2 flex gap-2 text-xs items-center rounded-full px-4 py-2 font-semibold bg-gray-800 hover:bg-black text-white"
                    >
                        Post
                    </button>
                    <!-- /Post Button -->
                </div>
            </div>
            <!-- /Card Bottom Action Buttons -->
        </div>
        <!-- /Create Post Card Bottom -->
    </form>
</template>

<style scoped></style>
