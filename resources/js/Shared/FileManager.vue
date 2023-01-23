<script setup>
import { onMounted, ref } from "vue";

defineProps(["modelValue", "className"]);

const emit = defineEmits(["update:modelValue"]);

const input = ref(null);
const fileManager = () => {
    CKFinder.modal({
        height: 600,
        chooseFiles: true,
        chooseFilesClosePopup: true,
        chooseFilesOnDblClick: true,
        onInit: function (finder) {
            finder.on("files:choose", function (evt) {
                var file = evt.data.files.first();
                emit("update:modelValue", file.getUrl());
            });
        },
    });
};
const setAltImg = (event) => {
    event.target.src = "/images/placeholder-400x200.png";
};
</script>
<template>
    <div class="choose-image" @click="fileManager()">
        <img
            :src="modelValue"
            @error="setAltImg"
            height="100"
            :class="className ? className : 'w-100'"
        />
        <input
            type="hidden"
            :value="modelValue"
            :v-modal="modelValue"
            class="input-image"
        />
    </div>
</template>
