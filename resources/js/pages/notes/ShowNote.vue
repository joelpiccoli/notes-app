<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { Head, router } from '@inertiajs/vue3';
import { type BreadcrumbItem } from '@/types';
import { computed } from 'vue';
import Button from '@/components/ui/button/Button.vue';
import { PencilIcon, TrashIcon } from 'lucide-vue-next';

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
    }
];

function deleteNote() {
    confirm('Are you sure you want to delete this note?') && router.delete(route('notes.destroy', props.note.id));
}
</script>

<template>
    <Head :title="note.title" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="flex h-full flex-1 flex-col gap-4 rounded-xl p-4">
            <div class="space-y-4 w-11/12 mx-auto">
                <div class="flex justify-between items-center mb-10">
                    <div class="flex flex-col gap-1">
                        <h1 class="text-2xl mb-1 font-bold">{{ note.title }}</h1>
                        <small class="text-sm text-muted-foreground">
                            created at {{ new Date(note.created_at).toLocaleDateString() }}
                        </small>
                    </div>

                    <div class="flex gap-2">
                        <Button as="a" :href="route('notes.edit', note.id)">
                            <PencilIcon class="w-4 h-4" /> Edit
                        </Button>
                        <Button variant="destructive" @click="deleteNote">
                            <TrashIcon class="w-4 h-4" />
                        </Button>
                    </div>
                </div>

                <div class="prose prose-invert max-w-none">
                    <div class="whitespace-pre-wrap" v-html="note.description"></div>
                </div>
                <hr>
                <div class="flex gap-2 flex-wrap">
                    <span v-for="tag in note.tags" :key="tag" class="rounded-full dark:bg-white bg-black px-3 py-1 text-white dark:text-black text-xs">
                        {{ tag }}
                    </span>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
