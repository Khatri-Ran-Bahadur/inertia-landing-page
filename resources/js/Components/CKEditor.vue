<script setup>
import { onMounted, ref } from "vue";
const props = defineProps({
    modelValue: String,
    editorId: String,
});
const emit = defineEmits(["update:modelValue"]);

onMounted(() => {
    var editor = window.CKEDITOR.replace(props.editorId, {
        extraPlugins:
            "uploadimage,image2,find,embed,autoembed,justify,indentblock",
        removePlugins: "image",
        embed_provider:
            "//ckeditor.iframe.ly/api/oembed?url={url}&callback={callback}",
        contentsCss: "body {font-size: 20px;}",
        removeButtons: "",
        // Use named CKFinder browser route
        filebrowserBrowseUrl: route("ckfinder_browser"),
        // Use named CKFinder connector route
        filebrowserUploadUrl:
            route("ckfinder_connector") + "?command=QuickUpload&type=Files",
    });
    editor.setData(props.modelValue);
    editor.on("change", function () {
        emit("update:modelValue", editor.getData());
    });
});
</script>

<template>
    <textarea class="form-control" :id="editorId"></textarea>
</template>
