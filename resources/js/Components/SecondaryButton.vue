<script setup>
defineProps({
    type: {
        type: String,
        default: "button",
    },
});
</script>

<template>
    <button :type="type" class="btn btn-secondary mt-2">
        <slot />
    </button>
</template>
