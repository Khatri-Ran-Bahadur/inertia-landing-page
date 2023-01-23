<script setup>
import AdminLayout from "@/Layouts/Admin/AdminLayout.vue";
import { Head, useForm, Link } from "@inertiajs/inertia-vue3";
import { useToast } from "vue-toastification";
import Datatable from "@/Shared/Datatable.vue";
import Tab from "./Tab.vue";
import { ref } from "vue";
const toast = useToast();

defineProps({
    datatableUrl: String,
    datatableColumns: Array,
    datatableHeaders: Array,
    counts: Object,
    status: {
        type: String,
        default: "all",
    },
});
const dataTableRef = ref();

const bulkForm = useForm({
    service_id: {
        type: Array,
        default: [],
    },
    bulk_action: {
        type: String,
        default: "",
    },
});

const bulkSubmit = () => {
    bulkForm.post(route("admin.services.bulk-action"), {
        onSuccess: () => {
            toast.success("Successfully done!");
            bulkForm.reset();
            dataTableRef.value.refreshTbl();
        },
        onError: () => {
            toast.error("Something went to wrong");
        },
    });
};
</script>
<template>
    <Head title="Services" />

    <AdminLayout>
        <template #header>
            <div
                class="d-sm-flex align-items-center justify-content-between mb-4 p-2"
            >
                <h1 class="h3 mb-0 text-gray-800">{{ __("Services") }}</h1>
                <Link
                    :href="route('admin.services.create')"
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
                    <form @submit.prevent="bulkSubmit">
                        <div class="card">
                            <div class="card-body">
                                <div class="row border-bottom mb-2">
                                    <Tab :counts="counts" :status="status" />
                                </div>
                                <div class="row p-2 mb-4">
                                    <div
                                        class="col-md-3 p-0 d-flex flex-row justify-content-between"
                                    >
                                        <select
                                            name="bulk_action"
                                            v-model="bulkForm.bulk_action"
                                            class="form-control"
                                            required
                                        >
                                            <option value="" selected>
                                                {{ __("Select Action") }}
                                            </option>
                                            <option
                                                value="trash"
                                                v-if="status != 'trash'"
                                            >
                                                {{ __("Trash") }}
                                            </option>
                                            <option
                                                value="delete"
                                                v-if="status === 'trash'"
                                            >
                                                {{ __("Delete") }}
                                            </option>
                                            <option
                                                value="restore"
                                                v-if="status === 'trash'"
                                            >
                                                {{ __("Restore") }}
                                            </option>
                                        </select>
                                        <button
                                            class="btn btn-success"
                                            type="submit"
                                        >
                                            {{ __("Apply") }}
                                        </button>
                                    </div>
                                </div>
                                <Datatable
                                    :url="datatableUrl"
                                    :headers="datatableHeaders"
                                    :columns="datatableColumns"
                                    v-model="bulkForm.service_id"
                                    ref="dataTableRef"
                                />
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </AdminLayout>
</template>
<style></style>
