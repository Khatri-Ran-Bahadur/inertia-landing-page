<script setup>
import AdminLayout from "@/Layouts/Admin/AdminLayout.vue";
import DeleteUserForm from "./Partials/DeleteUserForm.vue";
import UpdatePasswordForm from "./Partials/UpdatePasswordForm.vue";
import UpdateProfileInformationForm from "./Partials/UpdateProfileInformationForm.vue";
import { Head } from "@inertiajs/inertia-vue3";

defineProps({
    mustVerifyEmail: Boolean,
    status: String,
});
</script>

<template>
    <Head title="Profile" />

    <AdminLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{__('Profile')}}
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
                <div class="row">
                    <div class="col-md-6">
                        <div class="card card-body">
                            <UpdateProfileInformationForm
                                :must-verify-email="mustVerifyEmail"
                                :status="status"
                                class="max-w-xl"
                            />
                        </div>
                       
                    </div>
                    <div class="col-md-6">
                        <div class="card mt-2 card-body">
                            <UpdatePasswordForm class="max-w-xl" />
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AdminLayout>
</template>
