<script setup>
defineProps({
    type: {
        type: String,
        default: "submit",
    },
});
</script>

<template>
    <button :type="type" class="btn btn-danger btn-2">
        <slot />
    </button>
</template>
