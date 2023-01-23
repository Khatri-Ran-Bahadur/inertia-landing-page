<script setup>
import AdminLayout from "@/Layouts/Admin/AdminLayout.vue";
import { computed } from "vue";
import { Head, useForm, Link, usePage } from "@inertiajs/inertia-vue3";
import { useToast } from "vue-toastification";
import Datatable from "@/Shared/Datatable.vue";
import Checkbox from "@/Components/Checkbox.vue";
import CKEditor from "@/Components/CKEditor.vue";
import FileManager from "@/Shared/FileManager.vue";
import { Inertia } from "@inertiajs/inertia";

const toast = useToast();

defineProps({
    errors: Object,
});
const locales = usePage().props.value.locales;
const fields = {};
locales.forEach((lang) => {
    fields[lang] = {
        title: "",
        description: "",
    };
});
const form = useForm({
    ...fields,
    status: false,
    image: "",
});
console.log(form);
const onSubmit = () => {
    form.post(route("admin.aboutus.store"), {
        onSuccess: () => {
            toast.success("Successfully Updated");
            form.reset();
            Inertia.get(route("admin.aboutus.index"));
        },
        onError: () => {
            toast.error("Something went to wrong");
        },
    });
};
</script>
<template>
    <Head :title="__('Create About Us')" />

    <AdminLayout>
        <template #header>
            <div
                class="d-sm-flex align-items-center justify-content-between mb-4 p-2"
            >
                <h1 class="h3 mb-0 text-gray-800">
                    {{ __("Create About Us") }}
                </h1>
                <Link
                    :href="route('admin.aboutus.index')"
                    class="d-none d-sm-inline-block btn btn-sm btn-secondary shadow-sm"
                >
                    <i class="fas fa-arrow-left fa-sm text-white-50"></i>
                    {{ __("Back") }}</Link
                >
            </div>
        </template>
        <div class="container-fluid">
            <div class="row">
                <form @submit.prevent="onSubmit">
                    <div class="row">
                        <div class="col-md-8">
                            <div class="card">
                                <div class="card-body">
                                    <ul
                                        class="nav nav-tabs"
                                        id="myTab"
                                        role="tablist"
                                    >
                                        <li
                                            class="nav-item"
                                            role="presentation"
                                            v-for="(lang, index) in locales"
                                            :key="index"
                                        >
                                            <button
                                                class="nav-link text-uppercase"
                                                :class="
                                                    index === 0 ? 'active' : ''
                                                "
                                                :id="'lang-tab-' + lang"
                                                data-bs-toggle="tab"
                                                :data-bs-target="
                                                    '#lang-' + lang
                                                "
                                                type="button"
                                                role="tab"
                                                aria-controls="lang"
                                                aria-selected="true"
                                            >
                                                {{ lang }}
                                            </button>
                                        </li>
                                    </ul>
                                    <div class="tab-content" id="myTabContent">
                                        <div
                                            v-for="(lang, index) in locales"
                                            :key="index"
                                            class="tab-pane fade show"
                                            :class="index === 0 ? 'active' : ''"
                                            :id="'lang-' + lang"
                                            role="tabpanel"
                                            :aria-labelledby="'lang-tab' + lang"
                                        >
                                            <div class="form-group mt-4">
                                                <label for="title"
                                                    >{{ __("Title") }} (<span
                                                        class="text-uppercase"
                                                        >{{ lang }}</span
                                                    >)</label
                                                >
                                                <input
                                                    type="text"
                                                    class="form-control"
                                                    :name="lang + '[title]'"
                                                    v-model="form[lang].title"
                                                    max="255"
                                                />
                                                <div
                                                    v-if="errors.title"
                                                    class="mt-2 text-danger"
                                                >
                                                    {{ errors.title }}
                                                </div>
                                            </div>

                                            <div class="form-group mt-4">
                                                <label for="description"
                                                    >{{
                                                        __("Description")
                                                    }}
                                                    (<span
                                                        class="text-uppercase"
                                                        >{{ lang }}</span
                                                    >)</label
                                                >

                                                <CKEditor
                                                    :name="
                                                        lang + '[description]'
                                                    "
                                                    :editorId="
                                                        'description' + lang
                                                    "
                                                    v-model="
                                                        form[lang].description
                                                    "
                                                />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card">
                                <div class="card-body">
                                    <div
                                        class="accordion accordion-flush"
                                        id="accordionFlushExample"
                                    >
                                        <div class="accordion-item">
                                            <h2
                                                class="accordion-header"
                                                id="flush-headingTwo"
                                            >
                                                <button
                                                    class="accordion-button collapsed"
                                                    type="button"
                                                    data-bs-toggle="collapse"
                                                    data-bs-target="#flush-collapseTwo"
                                                    aria-expanded="false"
                                                    aria-controls="flush-collapseTwo"
                                                >
                                                    {{ __("Featured Image") }}
                                                </button>
                                            </h2>
                                            <div
                                                id="flush-collapseTwo"
                                                class="accordion-collapse bg-white"
                                                aria-labelledby="flush-headingTwo"
                                                data-bs-parent="#accordionFlushExample"
                                            >
                                                <div
                                                    class="accordion-body bg-white image-upload"
                                                >
                                                    <FileManager
                                                        inputName="image"
                                                        class="w-100"
                                                        v-model="form.image"
                                                    />
                                                    <div
                                                        v-if="errors.title"
                                                        class="mt-2 text-danger"
                                                    >
                                                        {{ errors.title }}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card card-body mt-2">
                                <button
                                    class="btn btn-primary submit-button m-1"
                                    data-button="published"
                                >
                                    {{ __("Published") }}
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </AdminLayout>
</template>
