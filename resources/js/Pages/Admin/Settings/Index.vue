<script setup>
import AdminLayout from "@/Layouts/Admin/AdminLayout.vue";
import { Head, useForm } from "@inertiajs/inertia-vue3";
import { useToast } from "vue-toastification";
import FileManager from "@/Shared/FileManager.vue";
const toast = useToast();

const props = defineProps({
    setting: Object,
});
const setting = props.setting;
const form = useForm({
    site_name: setting.site_name,
    email: setting.email,
    phone: setting.phone,
    shop_open: setting.shop_open,
    address: setting.address,
    fevicon: setting.fevicon,
    logo: setting.logo,
});

const submit = () => {
    form.post(route("admin.settings.update"), {
        onFinish: () => {
            toast.success("Successfully Updated");
        },
    });
};
</script>

<template>
    <Head title="Site Setting" />

    <AdminLayout>
        <div class="container-xl">
            <h1 class="app-page-title">{{ __("Settings") }}</h1>
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
                                {{ __("Basic Setting") }}
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
                            <form
                                class="form-horizontal"
                                @submit.prevent="submit"
                            >
                                <div class="row">
                                    <div class="mb-3 col-sm-12">
                                        <button
                                            class="btn-primary btn"
                                            type="submit"
                                        >
                                            {{ __("Save") }}
                                        </button>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6 col-xs-6 col-sm-12">
                                        <label>{{ __("Website title") }}</label>
                                        <div class="mb-3">
                                            <div class="input-group">
                                                <input
                                                    class="form-control"
                                                    type="text"
                                                    name="site_name"
                                                    v-model="form.site_name"
                                                />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-xs-6 col-sm-12">
                                        <div class="mb-3">
                                            <label>{{ __("Phone") }}</label>
                                            <div class="input-group">
                                                <input
                                                    class="form-control"
                                                    type="text"
                                                    name="phone"
                                                    v-model="form.phone"
                                                />
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6 col-xs-6 col-sm-12">
                                        <div class="mb-3">
                                            <label>{{ __("Email") }}</label>
                                            <div class="input-group">
                                                <input
                                                    class="form-control"
                                                    type="text"
                                                    name="email"
                                                    v-model="form.email"
                                                />
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6 col-xs-6 col-sm-12">
                                        <div class="mb-3">
                                            <label>{{ __("Shop Open") }}</label>
                                            <div class="input-group">
                                                <input
                                                    class="form-control"
                                                    type="text"
                                                    name="shop_open"
                                                    v-model="form.shop_open"
                                                />
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6 col-xs-6 col-sm-12">
                                        <div class="mb-3">
                                            <label>{{ __("Address") }}</label>
                                            <div class="input-group">
                                                <input
                                                    class="form-control"
                                                    type="text"
                                                    name="address"
                                                    v-model="form.address"
                                                />
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div
                                        class="col-md-6 col-xs-6 col-sm-12 mt-2"
                                    >
                                        <label class="col-form-label"
                                            >{{ __("Fevicon") }}
                                        </label>
                                        <FileManager
                                            inputName="fevicon"
                                            class="w-200"
                                            v-model="form.fevicon"
                                        />
                                    </div>
                                    <div
                                        class="col-md-6 col-xs-6 col-sm-12 mt-2"
                                    >
                                        <label class="col-form-label"
                                            >{{ __("Logo") }}
                                        </label>
                                        <FileManager
                                            inputName="logo"
                                            class="w-200"
                                            v-model="form.logo"
                                        />
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--//container-fluid-->
    </AdminLayout>
</template>
