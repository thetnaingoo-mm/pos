<script setup>
import { Head, router, usePage } from '@inertiajs/vue3';

const page = usePage();
const user = page.props.auth?.user;

const logout = () => {
    router.post('/logout');
};
</script>

<template>
    <Head title="Dashboard" />

    <main class="min-h-screen bg-slate-100 text-slate-900">
        <div class="mx-auto flex min-h-screen w-full max-w-5xl items-center px-6 py-16">
            <section class="w-full rounded-2xl bg-white p-8 shadow-sm ring-1 ring-slate-200 md:p-12">
                <div class="flex flex-wrap items-center justify-between gap-4">
                    <div>
                        <p class="text-sm font-medium uppercase tracking-wide text-slate-500">POS API</p>
                        <h1 class="mt-2 text-3xl font-semibold md:text-4xl">Dashboard</h1>
                        <p class="mt-3 text-base text-slate-600">
                            Logged in as
                            <span class="font-medium text-slate-900">{{ user?.name }}</span>
                            ({{ user?.email }})
                        </p>
                    </div>

                    <button
                        type="button"
                        class="rounded-lg bg-slate-900 px-4 py-2 text-sm font-medium text-white"
                        @click="logout"
                    >
                        Logout
                    </button>
                </div>

                <p class="mt-8 max-w-2xl text-base text-slate-600">
                    Mobile clients can authenticate with
                    <code class="rounded bg-slate-100 px-2 py-1 text-sm">POST /api/v1/auth/login</code>
                    and use bearer tokens on protected API routes.
                </p>
            </section>
        </div>
    </main>
</template>