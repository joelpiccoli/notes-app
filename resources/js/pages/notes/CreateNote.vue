<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { Head, useForm } from '@inertiajs/vue3';
import { type BreadcrumbItem } from '@/types';
import Button from '@/components/ui/button/Button.vue';

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Dashboard',
        href: '/dashboard',
    },
    {
        title: 'Nova nota',
        href: route('notes.create'),
    }
];

const form = useForm({
    title: '',
    description: '',
    tags: [] as string[]
});

function submit() {
    form.post(route('notes.store'));
}
</script>

<template>
    <Head title="Nova nota" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="flex h-full flex-1 flex-col gap-4 rounded-xl p-4">
            <form @submit.prevent="submit" class="space-y-6 max-w-2xl mx-auto w-full">
                <div class="space-y-2">
                    <label for="title" class="text-sm font-medium">Título</label>
                    <input
                        id="title"
                        v-model="form.title"
                        type="text"
                        class="w-full rounded-lg border bg-background px-3 py-2 text-sm"
                        :disabled="form.processing"
                    />
                    <p v-if="form.errors.title" class="text-sm text-destructive">{{ form.errors.title }}</p>
                </div>

                <div class="space-y-2">
                    <label for="description" class="text-sm font-medium">Descrição</label>
                    <textarea
                        id="description"
                        v-model="form.description"
                        rows="10"
                        class="w-full rounded-lg border bg-background px-3 py-2 text-sm"
                        :disabled="form.processing"
                    />
                    <p v-if="form.errors.description" class="text-sm text-destructive">{{ form.errors.description }}</p>
                </div>

                <div class="space-y-2">
                    <label for="tags" class="text-sm font-medium">Tags (separadas por vírgula)</label>
                    <input
                        id="tags"
                        v-model="form.tags"
                        type="text"
                        class="w-full rounded-lg border bg-background px-3 py-2 text-sm"
                        :disabled="form.processing"
                    />
                    <p v-if="form.errors.tags" class="text-sm text-destructive">{{ form.errors.tags }}</p>
                </div>

                <Button type="submit" :disabled="form.processing">
                    Criar nota
                </Button>
            </form>
        </div>
    </AppLayout>
</template>
