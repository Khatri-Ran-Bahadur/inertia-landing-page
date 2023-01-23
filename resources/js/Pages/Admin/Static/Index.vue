<script setup>
import AdminLayout from "@/Layouts/Admin/AdminLayout.vue";
import { Head, useForm } from "@inertiajs/inertia-vue3";
import { useToast } from "vue-toastification";
import FileManager from "@/Shared/FileManager.vue";
import TopForm from "./Inc/TopForm.vue";
const toast = useToast();

const props = defineProps({
    section: Object,
});
</script>

<template>
    <Head title="Static Section" />

    <AdminLayout>
        <div class="container-xl">
            <h1 class="app-page-title">{{ __("Static Section") }}</h1>
            <div class="card">
                <div class="card-body">
                    <ul
                        class="nav nav-tabs profile-tab border-0"
                        id="myTab"
                        role="tablist"
                    >
                        <li class="nav-item" role="presentation">
                            <button
                                class="nav-link active"
                                id="home-tab"
                                data-bs-toggle="tab"
                                data-tab="basic"
                                data-bs-target="#home"
                                type="button"
                                role="tab"
                                aria-controls="home"
                                aria-selected="true"
                            >
                                {{ __("Top Section") }}
                            </button>
                        </li>
                    </ul>
                    <div class="tab-content container p-4" id="myTabContent">
                        <div
                            class="tab-pane fade active show"
                            id="home"
                            role="tabpanel"
                            aria-labelledby="home-tab"
                        >
                            <TopForm :section="section.top_section" />
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--//container-fluid-->
    </AdminLayout>
</template>
