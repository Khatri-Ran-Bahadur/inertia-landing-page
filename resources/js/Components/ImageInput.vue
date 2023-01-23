<script setup>
import { onMounted, ref } from "vue";

</script>

<template>
    <input
        class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
        :value="modelValue"
        @input="$emit('update:modelValue', $event.target.value)"
        ref="input"
    />
    <div class="choose-image" @click="fileManager">
        <img :src="form.logo" @error="setAltImg" height="100" width="150" />
        <input
            type="hidden"
            name="logo"
            class="input-image"
            v-model="form.logo"
        />
    </div>
</template>
