<script setup>
import AdminLayout from "@/Layouts/Admin/AdminLayout.vue";
import { Head, useForm, Link, usePage } from "@inertiajs/inertia-vue3";
import { useToast } from "vue-toastification";
import { Inertia } from "@inertiajs/inertia";

const toast = useToast();

defineProps({
    errors: Object,
});
const locales = usePage().props.value.locales;
const fields = {};
locales.forEach((lang) => {
    fields[lang] = "";
});
const form = useForm({
    ...fields,
    key: "",
});
console.log(form);
const onSubmit = () => {
    form.post(route("admin.translations.store"), {
        onSuccess: () => {
            toast.success("Successfully Updated");
            form.reset();
            Inertia.get(route("admin.translations.index"));
        },
        onError: () => {
            toast.error("Something went to wrong");
        },
    });
};
</script>
<template>
    <Head :title="__('Create Translation')" />

    <AdminLayout>
        <template #header>
            <div
                class="d-sm-flex align-items-center justify-content-between mb-4 p-2"
            >
                <h1 class="h3 mb-0 text-gray-800">
                    {{ __("Create Translation") }}
                </h1>
                <Link
                    :href="route('admin.translations.index')"
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
                                    <div class="form-group mt-4">
                                        <label
                                            for="title"
                                            class="text-uppercase"
                                            >{{ __("Key") }}</label
                                        >
                                        <input
                                            type="text"
                                            class="form-control"
                                            name="key"
                                            v-model="form.key"
                                            max="255"
                                        />
                                    </div>
                                    <div
                                        v-for="(lang, index) in locales"
                                        :key="index"
                                    >
                                        <div class="form-group mt-4">
                                            <label
                                                for="title"
                                                class="text-uppercase"
                                                >{{ lang }}</label
                                            >
                                            <input
                                                type="text"
                                                class="form-control"
                                                :name="lang"
                                                v-model="form[lang]"
                                                max="255"
                                            />
                                        </div>
                                    </div>
                                    <div class="row mt-4">
                                        <div class="col-md-4">
                                            <button
                                                class="btn btn-primary submit-button m-1"
                                            >
                                                {{ __("Save") }}
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </AdminLayout>
</template>
