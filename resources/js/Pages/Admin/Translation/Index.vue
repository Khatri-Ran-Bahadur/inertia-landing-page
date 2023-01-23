<script setup>
import AdminLayout from "@/Layouts/Admin/AdminLayout.vue";
import { Head, useForm, Link } from "@inertiajs/inertia-vue3";
import { useToast } from "vue-toastification";
import Datatable from "@/Shared/Datatable.vue";
import { ref } from "vue";
const toast = useToast();

defineProps({
    datatableUrl: String,
    datatableColumns: Array,
    datatableHeaders: Array,
});
const dataTableRef = ref();
</script>
<template>
    <Head title="Translations" />

    <AdminLayout>
        <template #header>
            <div
                class="d-sm-flex align-items-center justify-content-between mb-4 p-2"
            >
                <h1 class="h3 mb-0 text-gray-800">{{ __("Translations") }}</h1>
                <Link
                    :href="route('admin.translations.create')"
                    class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"
                >
                    <i class="fas fa-plus fa-sm text-white-50"></i>
                    {{ __("Add New") }}</Link
                >
            </div>
        </template>
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <Datatable
                                :url="datatableUrl"
                                :headers="datatableHeaders"
                                :columns="datatableColumns"
                                ref="dataTableRef"
                            />
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AdminLayout>
</template>
<style></style>
