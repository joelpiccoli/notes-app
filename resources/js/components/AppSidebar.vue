<script setup lang="ts">
import NavUser from '@/components/NavUser.vue';
import { Sidebar, SidebarContent, SidebarFooter, SidebarHeader, SidebarMenu, SidebarMenuButton, SidebarMenuItem } from '@/components/ui/sidebar';
import { Link } from '@inertiajs/vue3';
import AppLogo from './AppLogo.vue';
import Button from './ui/button/Button.vue';
</script>

<template>
    <Sidebar variant="inset">
        <SidebarHeader>
            <SidebarMenu>
                <SidebarMenuItem>
                    <SidebarMenuButton size="lg" as-child>
                        <Link :href="route('dashboard')">
                            <AppLogo />
                        </Link>
                    </SidebarMenuButton>
                </SidebarMenuItem>
            </SidebarMenu>

            <Button as="a" :href="route('notes.create')" size="sm">
                New note
            </Button>
        </SidebarHeader>

        <SidebarContent>
            <template v-for="note in $page.props.notes" :key="note.id">
                <Link :href="route('notes.show', note.id)"
                    class="first:dark:bg-black/90 first:dark:border-gray-200 flex flex-col gap-2 p-4 bg-white dark:bg-black/30 border-gray-200 dark:border-gray-900 border rounded-lg cursor-pointer dark:hover:bg-black/10 hover:bg-black/10 transition-colors ">
                    <div class="text-xs font-bold">{{ note.title }}</div>
                    <small class="first:dark:text-muted-foreground text-muted-foreground text-xs">
                        {{ `${note.description.slice(0, 60)}...` }}
                    </small>
                </Link>
            </template>

            <div class="flex flex-col gap-2 p-4 bg-white dark:bg-black/30 border-gray-200 dark:border-gray-900 border rounded-lg cursor-pointer dark:hover:bg-black/10 hover:bg-black/10 transition-colors" v-if="$page.props.notes.length === 0">
                <div class="text-xs font-bold text-center">
                    You have no notes yet.
                </div>
            </div>
        </SidebarContent>

        <SidebarFooter>
            <NavUser />
        </SidebarFooter>
    </Sidebar>
    <slot />
</template>
