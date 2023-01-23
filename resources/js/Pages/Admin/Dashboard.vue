<script setup>
import AdminLayout from "@/Layouts/Admin/AdminLayout.vue";
import { Head } from "@inertiajs/inertia-vue3";
</script>

<template>
    <Head title="Dashboard" />

    <AdminLayout>
        <div class="container-xl">
            <div
                class="app-card alert alert-dismissible shadow-sm mb-4 border-left-decoration"
                role="alert"
            >
                <div class="inner">
                    <div class="app-card-body p-3 p-lg-4">
                        <h3 class="mb-3">Welcome</h3>
                        <div class="row gx-5 gy-3">
                            <div class="col-12 col-lg-9">
                                <div></div>
                            </div>
                            <!--//col-->
                        </div>
                        <!--//row-->
                        <button
                            type="button"
                            class="btn-close"
                            data-bs-dismiss="alert"
                            aria-label="Close"
                        ></button>
                    </div>
                    <!--//app-card-body-->
                </div>
                <!--//inner-->
            </div>
            <!--//app-card-->
        </div>
        <!--//container-fluid-->
    </AdminLayout>
</template>
