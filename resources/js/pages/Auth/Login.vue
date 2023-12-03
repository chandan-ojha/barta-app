<script setup>
import { Link, useForm, usePage } from "@inertiajs/vue3";
defineProps(["errors"]);
const page = usePage();

const form = useForm({
    email: "",
    password: "",
});

function login_user() {
    form.post("/user-login", {
        preserveScroll: true,
        onSuccess: () => {
            alert(page.props.flash.message);
            form.reset();
        },
    });
}
</script>

<template>
    <Head title="Login" />
    <div class="h-full">
        <div class="flex min-h-full flex-col justify-center px-6 py-12 lg:px-8">
            <div class="sm:mx-auto sm:w-full sm:max-w-sm">
                <Link
                    href="/"
                    class="text-center text-6xl font-bold text-gray-900"
                >
                    <h1>Barta</h1>
                </Link>

                <h1
                    class="mt-10 text-center text-2xl font-bold leading-9 tracking-tight text-gray-900"
                >
                    Sign in to your account
                </h1>
            </div>

            <div class="mt-10 sm:mx-auto sm:w-full sm:max-w-sm">
                <form class="space-y-6" @submit.prevent="login_user">
                    <!-- Email -->
                    <div>
                        <label
                            for="email"
                            class="block text-sm font-medium leading-6 text-gray-900"
                        >
                            Email address
                        </label>
                        <div class="mt-2">
                            <input
                                v-model="form.email"
                                id="email"
                                name="email"
                                type="email"
                                autocomplete="email"
                                placeholder="chandan@gmail.com"
                                class="block w-full rounded-md border-0 p-2 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-black sm:text-sm sm:leading-6"
                            />
                        </div>
                        <!-- display error message -->
                        <div class="mt-2 text-sm text-red-600">
                            <p
                                v-if="form.errors.email"
                                v-text="form.errors.email"
                            ></p>
                        </div>
                    </div>

                    <!-- Password -->
                    <div>
                        <div class="flex items-center justify-between">
                            <label
                                for="password"
                                class="block text-sm font-medium leading-6 text-gray-900"
                            >
                                Password
                            </label>
                            <div class="text-sm">
                                <a
                                    href="#"
                                    class="font-semibold text-black hover:text-black"
                                >
                                    Forgot password?
                                </a>
                            </div>
                        </div>
                        <div class="mt-2">
                            <input
                                v-model="form.password"
                                id="password"
                                name="password"
                                type="password"
                                autocomplete="current-password"
                                placeholder="••••••••"
                                class="block w-full rounded-md border-0 p-2 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-black sm:text-sm sm:leading-6"
                            />
                        </div>
                        <!-- display error message -->
                        <div class="mt-2 text-sm text-red-600">
                            <p
                                v-if="form.errors.password"
                                v-text="form.errors.password"
                            ></p>
                        </div>
                    </div>

                    <!-- sign in with email-->
                    <div>
                        <button
                            type="submit"
                            class="flex w-full justify-center rounded-md bg-black px-3 py-1.5 text-sm font-semibold leading-6 text-white shadow-sm hover:bg-black focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-black"
                        >
                            Sign in
                        </button>
                    </div>

                    <!-- sign in with google -->
                    <div>
                        <button
                            type="submit"
                            class="flex w-full justify-center rounded-md bg-[#4285F4] px-3 py-1.5 text-sm font-semibold leading-6 text-white items-center shadow-sm hover:bg-[#4285F4] focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2"
                        >
                            <svg
                                class="mr-2 -ml-1 w-4 h-4"
                                aria-hidden="true"
                                focusable="false"
                                data-prefix="fab"
                                data-icon="google"
                                role="img"
                                xmlns="http://www.w3.org/2000/svg"
                                viewBox="0 0 488 512"
                            >
                                <path
                                    fill="currentColor"
                                    d="M488 261.8C488 403.3 391.1 504 248 504 110.8 504 0 393.2 0 256S110.8 8 248 8c66.8 0 123 24.5 166.3 64.9l-67.5 64.9C258.5 52.6 94.3 116.6 94.3 256c0 86.5 69.1 156.6 153.7 156.6 98.2 0 135-70.4 140.8-106.9H248v-85.3h236.1c2.3 12.7 3.9 24.9 3.9 41.4z"
                                ></path>
                            </svg>
                            Sign in with Google
                        </button>
                    </div>
                </form>

                <p class="mt-10 text-center text-sm text-gray-500">
                    Don't have an account yet?
                    <Link
                        href="/register"
                        class="font-semibold leading-6 text-black hover:text-black"
                    >
                        Sign Up
                    </Link>
                </p>
            </div>
        </div>
    </div>
</template>

<style scoped></style>
