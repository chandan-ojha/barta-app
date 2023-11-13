<script setup>
import { Link } from "@inertiajs/vue3";
</script>

<template>
    <footer class="shadow bg-black mt-10">
        <div class="w-full max-w-screen-xl mx-auto p-4 md:py-8">
            <div class="sm:flex sm:items-center sm:justify-between">
                <Link href="/" class="flex items-center mb-4 sm:mb-0">
                    <span
                        class="self-center text-2xl font-semibold whitespace-nowrap text-white"
                        >Barta</span
                    >
                </Link>
                <ul
                    class="flex flex-wrap items-center mb-6 text-sm font-medium sm:mb-0 text-gray-100"
                >
                    <li>
                        <Link href="#" class="mr-4 hover:underline md:mr-6">
                            About
                        </Link>
                    </li>
                    <li>
                        <Link href="#" class="mr-4 hover:underline md:mr-6">
                            Privacy Policy
                        </Link>
                    </li>
                    <li>
                        <Link href="#" class="mr-4 hover:underline md:mr-6">
                            Licensing
                        </Link>
                    </li>
                    <li>
                        <Link href="#" class="hover:underline">Contact</Link>
                    </li>
                </ul>
            </div>
            <hr class="my-6 sm:mx-auto border-gray-700 lg:my-8" />
            <span class="block text-sm sm:text-center text-gray-200"
                >© 2023 <Link href="/" class="hover:underline">Barta</Link>. All
                Rights Reserved.
            </span>
        </div>
    </footer>
</template>

<style scoped></style>
