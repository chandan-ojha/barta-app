<script setup></script>

<template>
    <div class="w-5/6 mt-8">
        <div class="bg-gray-200 rounded-lg shadow-md p-4">
            <h2 class="text-xl font-bold mb-4">Who to follow</h2>
            <div class="flex flex-col space-y-4">
                <!-- Follower item 1 -->
                <div class="flex items-center justify-between">
                    <div class="flex items-center">
                        <img
                            src="https://ui-avatars.com/api/?name=Chandan+Ojha&background=0D8ABC&color=fff"
                            alt="Chandan Ojha"
                            class="h-10 w-10 rounded-full"
                        />

                        <div class="ml-4">
                            <a href="#" class="font-semibold hover:underline"
                                >Chandan Ojha</a
                            >
                            <p class="text-gray-500 text-sm">@chandan</p>
                        </div>
                    </div>

                    <button
                        class="bg-black text-white px-2 py-1 rounded-full text-xs"
                    >
                        Follow
                    </button>
                </div>
                <!-- Follower item 2  -->
                <div class="flex items-center justify-between">
                    <div class="flex items-center">
                        <img
                            src="https://ui-avatars.com/api/?name=Mohhammad+Rayhan&background=0D8ABC&color=fff"
                            alt="Mohammad Rayhan"
                            class="h-10 w-10 rounded-full"
                        />

                        <div class="ml-4">
                            <a href="#" class="font-semibold hover:underline"
                                >Rayhan</a
                            >
                            <p class="text-gray-500 text-sm">@rayhan</p>
                        </div>
                    </div>

                    <button
                        class="bg-black text-white px-2 py-1 rounded-full text-xs"
                    >
                        Follow
                    </button>
                </div>
                <!-- Follower item 3  -->
                <div class="flex items-center justify-between">
                    <div class="flex items-center">
                        <img
                            src="https://ui-avatars.com/api/?name=Kowsir+Bitto&background=0D8ABC&color=fff"
                            alt="Mohammad Rayhan"
                            class="h-10 w-10 rounded-full"
                        />

                        <div class="ml-4">
                            <a href="#" class="font-semibold hover:underline"
                                >Kowsir Bitto</a
                            >
                            <p class="text-gray-500 text-sm">@bitto</p>
                        </div>
                    </div>

                    <button
                        class="bg-black text-white px-2 py-1 rounded-full text-xs"
                    >
                        Follow
                    </button>
                </div>
            </div>
            <a
                href="#"
                class="block text-sky-400 hover:underline mt-4 font-semibold"
            >
                Show More
            </a>
        </div>
    </div>
</template>

<style scoped></style>
