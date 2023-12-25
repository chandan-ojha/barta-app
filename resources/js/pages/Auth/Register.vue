<script setup>
import { Link, useForm, usePage } from "@inertiajs/vue3";
import { flashMessage } from "../../utils/functions";
defineProps(["errors"]);

const page = usePage();
const form = useForm({
    name: "",
    email: "",
    password: "",
    password_confirmation: "",
});

function create_user() {
    form.post("/create-user", {
        preserveScroll: true,
        onSuccess: () => {
            flashMessage(page.props.flash.success);
            form.reset();
        },
    });
}
</script>

<template>
    <Head title="Register" />
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
                    Create a new account
                </h1>
            </div>

            <div class="mt-10 sm:mx-auto sm:w-full sm:max-w-sm">
                <form class="space-y-6" @submit.prevent="create_user">
                    <!-- Name -->
                    <div>
                        <label
                            for="first_name"
                            class="block text-sm font-medium leading-6 text-gray-900"
                        >
                            Name
                        </label>
                        <div class="mt-2">
                            <input
                                v-model="form.name"
                                id="name"
                                name="name"
                                type="text"
                                autocomplete="name"
                                placeholder="Chandan"
                                class="block w-full rounded-md border-0 p-2 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-black sm:text-sm sm:leading-6"
                            />
                        </div>
                        <!-- display error message -->
                        <div class="mt-2 text-sm text-red-600">
                            <p
                                v-if="form.errors.name"
                                v-text="form.errors.name"
                            ></p>
                        </div>
                    </div>

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
                        <label
                            for="password"
                            class="block text-sm font-medium leading-6 text-gray-900"
                            >Password</label
                        >
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

                    <!-- Confirm Password -->
                    <div>
                        <label
                            for="password"
                            class="block text-sm font-medium leading-6 text-gray-900"
                        >
                            Confirm Password
                        </label>
                        <div class="mt-2">
                            <input
                                v-model="form.password_confirmation"
                                id="password"
                                name="password"
                                type="password"
                                autocomplete="current-password"
                                placeholder="••••••••"
                                class="block w-full rounded-md border-0 p-2 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-black sm:text-sm sm:leading-6"
                            />
                        </div>
                    </div>

                    <div>
                        <button
                            type="submit"
                            class="flex w-full justify-center rounded-md bg-black px-3 py-1.5 text-sm font-semibold leading-6 text-white shadow-sm hover:bg-black focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-black"
                        >
                            Register
                        </button>
                    </div>
                </form>

                <p class="mt-10 text-center text-sm text-gray-500">
                    Already a member?
                    <Link
                        href="/login"
                        class="font-semibold leading-6 text-black hover:text-black"
                    >
                        Sign In
                    </Link>
                </p>
            </div>
        </div>
    </div>
</template>

<style scoped></style>
