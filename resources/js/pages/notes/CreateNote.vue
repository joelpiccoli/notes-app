<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { Head, useForm } from '@inertiajs/vue3';
import { type BreadcrumbItem } from '@/types';
import Button from '@/components/ui/button/Button.vue';
import { ref } from 'vue';

    const breadcrumbs: BreadcrumbItem[] = [
        {
            title: 'Dashboard',
            href: '/dashboard',
        },
        {
            title: 'New note',
            href: route('notes.create'),
        }
    ];

    const form = useForm({
    title: '',
    description: '',
    tags: [] as string[]
});

const tagsInput = ref('');

function submit() {
    const tagsArray = tagsInput.value
        .split(',')
        .map(tag => tag.trim())
        .filter(tag => tag.length > 0);

    form.tags = tagsArray;

    form.post(route('notes.store'));
}
</script>

<template>
    <Head title="New note" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="flex h-full flex-1 flex-col gap-4 rounded-xl p-4">
            <form @submit.prevent="submit" class="space-y-6 mx-auto w-11/12">
                <div class="space-y-2">
                    <input
                        id="title"
                        v-model="form.title"
                        placeholder="My awesome note"
                        type="text"
                        class="w-full rounded-lg border bg-background px-3 py-2 text-sm"
                        :disabled="form.processing"
                    />
                    <p v-if="form.errors.title" class="text-sm text-destructive">{{ form.errors.title }}</p>
                </div>

                <div class="space-y-2">
                    <textarea
                        id="description"
                        placeholder="What are you thinking about?"
                        v-model="form.description"
                        rows="15"
                        class="w-full rounded-lg border bg-background px-3 py-2 text-sm"
                        :disabled="form.processing"
                    />
                    <p v-if="form.errors.description" class="text-sm text-destructive">{{ form.errors.description }}</p>
                </div>

                <div class="space-y-2">
                    <label for="tags" class="text-sm font-medium">Tags (comma separated)</label>
                    <input
                        id="tags"
                        v-model="tagsInput"
                        type="text"
                        placeholder="work, personal, ideas"
                        class="w-full rounded-lg border bg-background px-3 py-2 text-sm"
                        :disabled="form.processing"
                    />
                    <p v-if="form.errors.tags" class="text-sm text-destructive">{{ form.errors.tags }}</p>
                </div>

                <div class="flex justify-end">
                    <Button type="submit" :disabled="form.processing">
                        Save note
                    </Button>
                </div>
            </form>
        </div>
    </AppLayout>
</template>
