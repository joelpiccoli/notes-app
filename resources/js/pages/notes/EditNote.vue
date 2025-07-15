<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { Head, router, useForm } from '@inertiajs/vue3';
import { type BreadcrumbItem } from '@/types';
import Button from '@/components/ui/button/Button.vue';
import { ref } from 'vue';

const props = defineProps<{
    note: {
        id: number;
        title: string;
        description: string;
        tags: string[];
        created_at: string;
        updated_at: string;
    }
}>();

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Dashboard',
        href: '/dashboard',
    },
    {
        title: props.note.title,
        href: route('notes.show', props.note.id),
    },
    {
        title: 'Edit',
        href: route('notes.edit', props.note.id),
    }
];

const form = useForm({
    title: props.note.title,
    description: props.note.description,
    tags: props.note.tags
});

const tagsInput = ref(props.note.tags.join(', '));

function submit() {
    const tagsArray = tagsInput.value
        .split(',')
        .map(tag => tag.trim())
        .filter(tag => tag.length > 0);

    form.tags = tagsArray;

    form.put(route('notes.update', props.note.id), {
        onSuccess: () => {
            router.get(route('notes.show', props.note.id));
        },
    });
}
</script>

<template>
    <Head :title="`Edit ${note.title}`" />

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

                <Button type="submit" :disabled="form.processing">Save changes</Button>
            </form>
        </div>
    </AppLayout>
</template>
