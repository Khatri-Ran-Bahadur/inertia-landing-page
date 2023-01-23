<script setup>
import AdminLayout from "@/Layouts/Admin/AdminLayout.vue";
import { Head, useForm, Link } from "@inertiajs/inertia-vue3";
import { useToast } from "vue-toastification";
import Datatable from "@/Shared/Datatable.vue";
const toast = useToast();

defineProps({
    datatableUrl: String,
    datatableColumns: Array,
    datatableHeaders: Array,
});
</script>
<template>
    <Head title="Users" />

    <AdminLayout>
        <template #header>
            <div
                class="d-sm-flex align-items-center justify-content-between mb-4 p-2"
            >
                <h1 class="h3 mb-0 text-gray-800">Users</h1>
                <Link
                    :href="route('admin.users.create')"
                    class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"
                    ><i class="fas fa-plus fa-sm text-white-50"></i> Add
                    New</Link
                >
            </div>
        </template>
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 col-md-12">
                    <div class="card shadow">
                        <div class="card-header">
                            <h6>Users</h6>
                        </div>
                        <div class="card-body">
                            <Datatable
                                :url="datatableUrl"
                                :headers="datatableHeaders"
                                :columns="datatableColumns"
                            />
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AdminLayout>
</template>
