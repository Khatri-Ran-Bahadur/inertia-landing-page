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
                    :href="route('admin.users.index')"
                    class="d-none d-sm-inline-block btn btn-sm btn-secondary shadow-sm"
                    ><i class="fas fa-arrow-left fa-sm text-white-50"></i>
                    Back</Link
                >
            </div>
        </template>
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <form
                        class="needs-validation"
                        action=""
                        method="POST"
                        id="partner-form"
                        novalidate
                    >
                        <div class="card">
                            <div
                                class="card-header d-flex justify-content-between"
                            >
                                <h5 class="mb-0 h6">Add User Details</h5>
                            </div>
                            <div class="card-body">
                                <div id="errors"></div>
                                <div class="row">
                                    <div class="col-md-8">
                                        <div class="row">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <label
                                                        class="col-form-label"
                                                    >
                                                        Username
                                                        <span
                                                            class="text-danger"
                                                            >* this will be not
                                                            change make sure
                                                            first</span
                                                        ></label
                                                    >
                                                    <input
                                                        type="text"
                                                        class="form-control"
                                                        name="username"
                                                    />
                                                </div>
                                                <div class="col-md-6">
                                                    <label
                                                        class="col-form-label"
                                                        >Display Name
                                                        <span
                                                            class="text-danger"
                                                            >*</span
                                                        ></label
                                                    >
                                                    <input
                                                        type="text"
                                                        class="form-control"
                                                        name="name"
                                                        required="required"
                                                    />
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <label
                                                        class="col-form-label"
                                                    >
                                                        First Name
                                                    </label>
                                                    <input
                                                        type="text"
                                                        class="form-control"
                                                        name="first_name"
                                                        required="required"
                                                    />
                                                </div>
                                                <div class="col-md-6">
                                                    <label
                                                        class="col-form-label"
                                                        >Last Name
                                                    </label>
                                                    <input
                                                        type="text"
                                                        class="form-control"
                                                        name="last_name"
                                                        required="required"
                                                    />
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6">
                                                <label class="col-form-label"
                                                    >Email
                                                    <span class="text-danger"
                                                        >*</span
                                                    ></label
                                                >
                                                <input
                                                    type="email"
                                                    class="form-control"
                                                    name="email"
                                                    required="required"
                                                    autocomplete="off"
                                                />
                                            </div>
                                            <div class="col-md-6">
                                                <label class="col-form-label"
                                                    >Phone
                                                    <span class="text-danger"
                                                        >*</span
                                                    ></label
                                                >
                                                <input
                                                    type="text"
                                                    class="form-control"
                                                    name="phone"
                                                    required="required"
                                                />
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6">
                                                <label class="col-form-label"
                                                    >Password
                                                    <span class="text-danger"
                                                        >*</span
                                                    ></label
                                                >
                                                <input
                                                    type="password"
                                                    class="form-control"
                                                    name="password"
                                                    required="required"
                                                />
                                            </div>
                                            <div class="col-md-6">
                                                <label class="col-form-label"
                                                    >Confirm Password
                                                    <span class="text-danger"
                                                        >*</span
                                                    ></label
                                                >
                                                <input
                                                    type="password"
                                                    class="form-control"
                                                    name="password_confirmation"
                                                />
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <label
                                                    for=""
                                                    class="col-form-label"
                                                    >About</label
                                                >
                                                <textarea
                                                    name="about"
                                                    class="form-control"
                                                    id=""
                                                    cols="30"
                                                    rows="4"
                                                ></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div
                                            class="common-image-select flex-row justify-content-center align-items-center p-4"
                                        >
                                            <img
                                                src="images/avatar-place.png"
                                                onerror="this.src='/images/avatar-place.png'"
                                                class="partner_image image w-100 h-100"
                                            />
                                            <input
                                                type="hidden"
                                                class="form-control partner"
                                                name="image"
                                                required
                                            />
                                            <button
                                                type="button"
                                                class="btn btn-success w-100 partner-feature rounded-0"
                                            >
                                                Select Image
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-4 mb-4">
                                    <div class="col-md-10">
                                        <button
                                            type="submit"
                                            class="btn btn-success text-white"
                                        >
                                            <i></i>Save
                                        </button>
                                        <Link
                                            :href="route('admin.users.index')"
                                            class="btn btn-warning"
                                        >
                                            Cancel</Link
                                        >
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </AdminLayout>
</template>
