<script setup lang="ts">
import type { HTMLAttributes } from 'vue';

defineOptions({
    inheritAttrs: false,
});

interface Props {
    className?: HTMLAttributes['class'];
}

defineProps<Props>();
</script>

<template>
    <svg xmlns="http://www.w3.org/2000/svg" width="512" height="512" viewBox="0 0 512 512">
  <!-- Yellow squircle background -->
  <rect x="0" y="0" width="512" height="512" rx="120" ry="120" fill="#F9D858" />

  <!-- Notepad body -->
  <rect x="96" y="96" width="320" height="320" rx="24" ry="24" fill="#FDF0D5" stroke="#4A5458" stroke-width="24" />

  <!-- Spiral rings -->
  <circle cx="176" cy="96" r="16" fill="#4A5458" />
  <circle cx="256" cy="96" r="16" fill="#4A5458" />
  <circle cx="336" cy="96" r="16" fill="#4A5458" />
  <rect x="160" y="80" width="192" height="32" fill="#FDF0D5" />

  <!-- Lines on notepad -->
  <line x1="160" y1="176" x2="352" y2="176" stroke="#D1C3A1" stroke-width="16" stroke-linecap="round" />
  <line x1="160" y1="240" x2="352" y2="240" stroke="#D1C3A1" stroke-width="16" stroke-linecap="round" />
  <line x1="160" y1="304" x2="304" y2="304" stroke="#D1C3A1" stroke-width="16" stroke-linecap="round" />

  <!-- Pencil group -->
  <g transform="translate(350,350) rotate(45)">
    <!-- Pencil body -->
    <rect x="-100" y="-12" width="200" height="24" fill="#7FBFAD" stroke="#4A5458" stroke-width="16" />
    <!-- Pencil tip -->
    <polygon points="100,-12 130,0 100,12" fill="#F4A261" stroke="#4A5458" stroke-width="16" />
    <!-- Eraser -->
    <rect x="-100" y="-12" width="32" height="24" fill="#F28C8C" stroke="#4A5458" stroke-width="16" />
  </g>
</svg>
</template>
