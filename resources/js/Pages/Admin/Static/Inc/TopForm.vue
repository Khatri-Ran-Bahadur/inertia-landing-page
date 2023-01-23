<script setup>
import { useForm, Link, usePage } from "@inertiajs/inertia-vue3";
import { useToast } from "vue-toastification";
import FileManager from "@/Shared/FileManager.vue";
const toast = useToast();
const props = defineProps({
    section: Object,
});
const locales = usePage().props.value.locales;
const fields = {};
locales.forEach((lang) => {
    fields[lang] = {
        first_title: props.section ? props.section[lang].first_title : "",
        first_description: props.section
            ? props.section[lang].first_description
            : "",
        second_title: props.section ? props.section[lang].second_title : "",
        second_description: props.section
            ? props.section[lang].second_description
            : "",
        third_title: props.section ? props.section[lang].third_title : "",
        third_description: props.section
            ? props.section[lang].third_description
            : "",
        fourth_title: props.section ? props.section[lang].fourth_title : "",
        fourth_description: props.section
            ? props.section[lang].fourth_description
            : "",
    };
});
const form = useForm({
    ...fields,
    key: "top_section",
    banner: props.section ? props.section.banner : "",
    contact_banner: props.section ? props.section.contact_banner : "",
});
const submit = () => {
    form.post(route("admin.static-section.update"), {
        onFinish: () => {
            toast.success("Successfully Updated");
        },
    });
};
</script>
<template>
    <form class="form-horizontal" @submit.prevent="submit">
        <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li
                class="nav-item"
                role="presentation"
                v-for="(lang, index) in locales"
                :key="index"
            >
                <button
                    class="nav-link text-uppercase"
                    :class="index === 0 ? 'active' : ''"
                    :id="'lang-tab-' + lang"
                    data-bs-toggle="tab"
                    :data-bs-target="'#lang-' + lang"
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
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group mt-4">
                            <label for="title"
                                >{{ __("First Title") }} (<span
                                    class="text-uppercase"
                                    >{{ lang }}</span
                                >)</label
                            >
                            <input
                                type="text"
                                class="form-control"
                                :name="lang + '[first_title]'"
                                v-model="form[lang].first_title"
                                max="255"
                            />
                        </div>

                        <div class="form-group mt-4">
                            <label for="description"
                                >{{ __("First Description") }} (<span
                                    class="text-uppercase"
                                    >{{ lang }}</span
                                >)</label
                            >
                            <textarea
                                :name="lang + '[first_description]'"
                                v-model="form[lang].first_description"
                                class="form-control"
                                cols="30"
                                rows="5"
                            ></textarea>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group mt-4">
                            <label for="title"
                                >{{ __("Second Title") }} (<span
                                    class="text-uppercase"
                                    >{{ lang }}</span
                                >)</label
                            >
                            <input
                                type="text"
                                class="form-control"
                                :name="lang + '[second_title]'"
                                v-model="form[lang].second_title"
                                max="255"
                            />
                        </div>
                        <div class="form-group mt-4">
                            <label for="description"
                                >{{ __("Second Description") }} (<span
                                    class="text-uppercase"
                                    >{{ lang }}</span
                                >)</label
                            >
                            <textarea
                                :name="lang + '[second_description]'"
                                v-model="form[lang].second_description"
                                class="form-control"
                                cols="30"
                                rows="5"
                            ></textarea>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group mt-4">
                            <label for="title"
                                >{{ __("Third Title") }} (<span
                                    class="text-uppercase"
                                    >{{ lang }}</span
                                >)</label
                            >
                            <input
                                type="text"
                                class="form-control"
                                :name="lang + '[third_title]'"
                                v-model="form[lang].third_title"
                                max="255"
                            />
                        </div>

                        <div class="form-group mt-4">
                            <label for="description"
                                >{{ __("Third Description") }} (<span
                                    class="text-uppercase"
                                    >{{ lang }}</span
                                >)</label
                            >
                            <textarea
                                :name="lang + '[third_description]'"
                                v-model="form[lang].third_description"
                                class="form-control"
                                cols="30"
                                rows="5"
                            ></textarea>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group mt-4">
                            <label for="title"
                                >{{ __("Fourth Title") }} (<span
                                    class="text-uppercase"
                                    >{{ lang }}</span
                                >)</label
                            >
                            <input
                                type="text"
                                class="form-control"
                                :name="lang + '[fourth_title]'"
                                v-model="form[lang].fourth_title"
                                max="255"
                            />
                        </div>
                        <div class="form-group mt-4">
                            <label for="description"
                                >{{ __("Fourth Description") }} (<span
                                    class="text-uppercase"
                                    >{{ lang }}</span
                                >)</label
                            >
                            <textarea
                                :name="lang + '[fourth_description]'"
                                v-model="form[lang].fourth_description"
                                class="form-control"
                                cols="30"
                                rows="5"
                            ></textarea>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mt-4">
            <div class="mb-3 col-sm-12">
                <label class="col-form-label">{{ __("Banner") }} </label>
                <FileManager
                    inputName="banner"
                    :className="'w-500'"
                    v-model="form.banner"
                />
            </div>
        </div>

        <div class="row mt-4">
            <div class="mb-3 col-sm-12">
                <label class="col-form-label"
                    >{{ __("Contact Banner") }}
                </label>
                <FileManager
                    inputName="contact_banner"
                    :className="'w-500'"
                    v-model="form.contact_banner"
                />
            </div>
        </div>

        <div class="row mt-4">
            <div class="mb-3 col-sm-12">
                <button class="btn-primary btn" type="submit">
                    {{ __("Save") }}
                </button>
            </div>
        </div>
    </form>
</template>
