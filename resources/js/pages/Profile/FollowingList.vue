<script setup></script>

<template>
    <div
        class="bg-white border-2 border-black rounded-lg shadow mx-auto max-w-none px-4 py-5 sm:px-6"
    >
        <div class="px-6 py-4">
            <h2 class="text-xl font-bold mb-4">Following</h2>
            <ul>
                <!-- Replace the sample items with your actual list of followed users -->
                <li class="py-2">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center space-x-2">
                            <img
                                src="https://ui-avatars.com/api/?name=Chandan+Ojha"
                                alt="Chandan Ojha"
                                class="h-10 w-10 rounded-full object-cover"
                            />
                            <span class="text-lg font-medium text-gray-800"
                                >Chandan</span
                            >
                        </div>
                        <button
                            class="bg-black hover:bg-black text-white font-semibold py-2 px-3 rounded-full shadow-md focus:outline-none focus:ring-2 focus:ring-sky-500 focus:ring-offset-2 focus:ring-offset-gray-100 text-xs"
                        >
                            Unfollow
                        </button>
                    </div>
                </li>
                <li class="py-2">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center space-x-2">
                            <img
                                src="https://ui-avatars.com/api/?name=Rayhan+Uddin"
                                alt="Rayhan Uddin"
                                class="h-10 w-10 rounded-full object-cover"
                            />
                            <span class="text-lg font-medium text-gray-800"
                                >Rayhan</span
                            >
                        </div>
                        <button
                            class="bg-black hover:bg-black text-white font-semibold py-2 px-3 rounded-full shadow-md focus:outline-none focus:ring-2 focus:ring-sky-500 focus:ring-offset-2 focus:ring-offset-gray-100 text-xs"
                        >
                            Unfollow
                        </button>
                    </div>
                </li>
                <!-- Repeat this list item structure for each followed user -->
            </ul>
        </div>
    </div>
</template>

<style scoped></style>
