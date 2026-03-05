<script setup>
import { Head, useForm } from '@inertiajs/vue3';

const form = useForm({
    email: '',
    password: '',
    remember: false,
});

const submit = () => {
    form.post('/login', {
        onFinish: () => form.reset('password'),
    });
};
</script>

<template>
    <Head title="Login" />

    <main class="min-h-screen bg-slate-100 text-slate-900">
        <div class="mx-auto flex min-h-screen w-full max-w-md items-center px-6 py-16">
            <section class="w-full rounded-2xl bg-white p-8 shadow-sm ring-1 ring-slate-200">
                <h1 class="text-2xl font-semibold">Sign in</h1>
                <p class="mt-2 text-sm text-slate-600">Use your account to access the dashboard.</p>

                <form class="mt-6 space-y-4" @submit.prevent="submit">
                    <div>
                        <label class="mb-1 block text-sm font-medium">Email</label>
                        <input
                            v-model="form.email"
                            type="email"
                            autocomplete="email"
                            class="w-full rounded-lg border border-slate-300 px-3 py-2 outline-none ring-slate-200 focus:ring"
                            required
                        />
                        <p v-if="form.errors.email" class="mt-1 text-sm text-rose-600">{{ form.errors.email }}</p>
                    </div>

                    <div>
                        <label class="mb-1 block text-sm font-medium">Password</label>
                        <input
                            v-model="form.password"
                            type="password"
                            autocomplete="current-password"
                            class="w-full rounded-lg border border-slate-300 px-3 py-2 outline-none ring-slate-200 focus:ring"
                            required
                        />
                        <p v-if="form.errors.password" class="mt-1 text-sm text-rose-600">{{ form.errors.password }}</p>
                    </div>

                    <label class="flex items-center gap-2 text-sm text-slate-700">
                        <input v-model="form.remember" type="checkbox" class="rounded border-slate-300" />
                        Remember me
                    </label>

                    <button
                        type="submit"
                        :disabled="form.processing"
                        class="w-full rounded-lg bg-slate-900 px-4 py-2 text-white disabled:opacity-60"
                    >
                        {{ form.processing ? 'Signing in...' : 'Sign in' }}
                    </button>
                </form>
            </section>
        </div>
    </main>
</template>