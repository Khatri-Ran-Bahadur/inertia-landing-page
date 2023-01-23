<script setup>
import Checkbox from "@/Components/Checkbox.vue";
import GuestLayout from "@/Layouts/GuestLayout.vue";
import InputError from "@/Components/InputError.vue";
import InputLabel from "@/Components/InputLabel.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import TextInput from "@/Components/TextInput.vue";
import { Head, Link, useForm } from "@inertiajs/inertia-vue3";

defineProps({
    canResetPassword: Boolean,
    status: String,
});

const form = useForm({
    email: "",
    password: "",
    remember: false,
});

const submit = () => {
    form.post(route("login"), {
        onFinish: () => form.reset("password"),
    });
};
</script>

<template>
    <GuestLayout>
        <Head title="Log in" />
        <div class="app-login">
            <div v-if="status" class="mb-4 font-medium text-sm text-green-600">
                {{ status }}
            </div>
            <div class="row g-0 app-auth-wrapper">
                <div class="col-md-7 col-lg-6 auth-main-col text-center p-5">
                    <div class="d-flex flex-column align-content-end">
                        <div class="app-auth-body mx-auto">
                            <div class="app-auth-branding mb-4">
                                <a class="app-logo" href="index.html"
                                    ><img
                                        class="logo-icon me-2"
                                        src="admin/images/app-logo.svg"
                                        alt="logo"
                                /></a>
                            </div>
                            <h2 class="auth-heading text-center mb-5">
                                Log in to Portal
                            </h2>
                            <div class="auth-form-container text-start">
                                <form
                                    class="auth-form login-form"
                                    @submit.prevent="submit"
                                >
                                    <div class="email mb-3">
                                        <label
                                            class="sr-only"
                                            for="signin-email"
                                            >Email</label
                                        >
                                        <input
                                            id="signin-email"
                                            name="email"
                                            type="email"
                                            v-model="form.email"
                                            class="form-control signin-email"
                                            placeholder="Email address"
                                            required="required"
                                        />
                                        <InputError
                                            class="mt-2"
                                            :message="form.errors.email"
                                        />
                                    </div>
                                    <!--//form-group-->
                                    <div class="password mb-3">
                                        <label
                                            class="sr-only"
                                            for="signin-password"
                                            >Password</label
                                        >
                                        <input
                                            id="signin-password"
                                            name="signin-password"
                                            type="password"
                                            class="form-control signin-password"
                                            placeholder="Password"
                                            required="required"
                                            v-model="form.password"
                                        />
                                        <InputError
                                            class="mt-2"
                                            :message="form.errors.password"
                                        />
                                        <div
                                            class="extra mt-3 row justify-content-between"
                                        >
                                            <div class="col-6">
                                                <div class="form-check">
                                                    <Checkbox
                                                        name="remember"
                                                        v-model:checked="
                                                            form.remember
                                                        "
                                                    />
                                                    <label
                                                        class="form-check-label"
                                                        for="RememberPassword"
                                                    >
                                                        Remember me
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <!--//extra-->
                                    </div>
                                    <!--//form-group-->
                                    <div class="text-center">
                                        <PrimaryButton
                                            class="btn app-btn-primary w-100 theme-btn mx-auto"
                                            :class="{
                                                'opacity-25': form.processing,
                                            }"
                                            :disabled="form.processing"
                                        >
                                            Log in
                                        </PrimaryButton>
                                    </div>
                                </form>
                            </div>
                            <!--//auth-form-container-->
                        </div>
                        <!--//auth-body-->
                    </div>
                    <!--//flex-column-->
                </div>
                <!--//auth-main-col-->
                <div class="col-md-5 col-lg-6 h-100 auth-background-col">
                    <div class="auth-background-holder"></div>
                    <div class="auth-background-mask"></div>
                    <div class="auth-background-overlay p-3 p-lg-5">
                        <div class="d-flex flex-column align-content-end h-100">
                            <div class="h-100"></div>
                        </div>
                    </div>
                    <!--//auth-background-overlay-->
                </div>
                <!--//auth-background-col-->
            </div>
        </div>

        <!--//row-->
    </GuestLayout>
</template>
