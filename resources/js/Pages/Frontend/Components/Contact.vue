<script setup>
import { useForm, Link, usePage } from "@inertiajs/inertia-vue3";
import { useToast } from "vue-toastification";
const toast = useToast();

const props = defineProps({
    errors: Object,
    section: Object,
});
const bg_image = props.section.top_section.contact_banner;
const form = useForm({
    name: "",
    phone_email: "",
    organization: "",
    subject: "",
    message: "",
});
const submit = () => {
    form.post(route("frontend.feedback"), {
        onFinish: () => {
            form.reset(
                "name",
                "phone_email",
                "organization",
                "subject",
                "message"
            );
            toast.success("Successfully send");
        },
    });
};
</script>
<template>
    <div class="Contact">
        <div class="H3">{{ __("Contact") }}</div>
        <div class="container-xl">
            <div class="row mt-4 gy-3">
                <div class="col-12 col-sm-6 col-md-6 col-lg-3">
                    <div class="ContactItem d-flex align-items-center gap-2">
                        <h6>
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                width="22"
                                height="22"
                                fill="currentColor"
                                class="bi bi-telephone-fill"
                                viewBox="0 0 16 16"
                            >
                                <path
                                    fill-rule="evenodd"
                                    d="M1.885.511a1.745 1.745 0 0 1 2.61.163L6.29 2.98c.329.423.445.974.315 1.494l-.547 2.19a.678.678 0 0 0 .178.643l2.457 2.457a.678.678 0 0 0 .644.178l2.189-.547a1.745 1.745 0 0 1 1.494.315l2.306 1.794c.829.645.905 1.87.163 2.611l-1.034 1.034c-.74.74-1.846 1.065-2.877.702a18.634 18.634 0 0 1-7.01-4.42 18.634 18.634 0 0 1-4.42-7.009c-.362-1.03-.037-2.137.703-2.877L1.885.511z"
                                />
                            </svg>
                        </h6>
                        <h6>{{ $page.props.websetting.phone }}</h6>
                    </div>
                </div>

                <div class="col-12 col-sm-6 col-md-6 col-lg-3">
                    <div class="ContactItem d-flex align-items-center gap-2">
                        <h6>
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                width="23"
                                height="23"
                                fill="currentColor"
                                class="bi bi-clock-fill"
                                viewBox="0 0 16 16"
                            >
                                <path
                                    d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM8 3.5a.5.5 0 0 0-1 0V9a.5.5 0 0 0 .252.434l3.5 2a.5.5 0 0 0 .496-.868L8 8.71V3.5z"
                                />
                            </svg>
                        </h6>
                        <h6>{{ $page.props.websetting.shop_open }}</h6>
                    </div>
                </div>

                <div class="col-12 col-sm-6 col-md-6 col-lg-3">
                    <div class="ContactItem d-flex align-items-center gap-2">
                        <h6>
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                width="22"
                                height="22"
                                fill="currentColor"
                                class="bi bi-geo-alt-fill"
                                viewBox="0 0 16 16"
                            >
                                <path
                                    d="M8 16s6-5.686 6-10A6 6 0 0 0 2 6c0 4.314 6 10 6 10zm0-7a3 3 0 1 1 0-6 3 3 0 0 1 0 6z"
                                />
                            </svg>
                        </h6>
                        <h6>{{ $page.props.websetting.address }}</h6>
                    </div>
                </div>

                <div class="col-12 col-sm-6 col-md-6 col-lg-3">
                    <div class="ContactItem d-flex align-items-center gap-2">
                        <h6>
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                width="22"
                                height="22"
                                fill="currentColor"
                                class="bi bi-envelope-fill"
                                viewBox="0 0 16 16"
                            >
                                <path
                                    d="M.05 3.555A2 2 0 0 1 2 2h12a2 2 0 0 1 1.95 1.555L8 8.414.05 3.555ZM0 4.697v7.104l5.803-3.558L0 4.697ZM6.761 8.83l-6.57 4.027A2 2 0 0 0 2 14h12a2 2 0 0 0 1.808-1.144l-6.57-4.027L8 9.586l-1.239-.757Zm3.436-.586L16 11.801V4.697l-5.803 3.546Z"
                                />
                            </svg>
                        </h6>
                        <h6>{{ $page.props.websetting.email }}</h6>
                    </div>
                </div>
            </div>

            <div class="ContactDiv mt-3">
                <div
                    class="bg-img"
                    :style="{ backgroundImage: 'url(' + bg_image + ')' }"
                >
                    <form @submit.prevent="submit" class="container">
                        <h4>{{ __("Feedback form") }}</h4>

                        <input
                            type="text"
                            :placeholder="__('Name')"
                            name="name"
                            v-model="form.name"
                            required
                        />

                        <input
                            type="text"
                            :placeholder="__('Number phone/email')"
                            name="email"
                            v-model="form.phone_email"
                            required
                        />

                        <input
                            type="text"
                            :placeholder="__('Name of organisation')"
                            name="organization"
                            v-model="form.organization"
                            required
                        />

                        <input
                            type="text"
                            :placeholder="__('Subject of request')"
                            name="subject"
                            v-model="form.subject"
                            required
                        />

                        <textarea
                            class=""
                            :placeholder="__('Message')"
                            name="message"
                            v-model="form.message"
                        ></textarea>

                        <button type="submit" class="btn">
                            {{ __("Send") }}
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped lang="scss">
.ContactItem h6 {
    font-style: normal;
    font-weight: normal;
    font-size: 20px;
    color: #2d2d2d;
}
.ContactDiv {
    position: relative;
}
.ContactItem svg {
    color: var(--bg6);
}

/*<!--  -->*/
.bg-img {
    /* The image used */
    min-height: 575px;
    /* Center and scale the image nicely */
    background-position: center;
    background-repeat: no-repeat;
    background-size: cover;
    position: relative;
}

/* Add styles to the form container */
.container {
    position: absolute;
    left: 0;
    max-width: 400px;
    padding: 16px;
    /* background-color: white; */
}

/* Full-width input fields */
input {
    width: 100%;
    padding: 12px 15px;
    margin: 5px 0 15px 0;
    border: none;
    background: #f1f1f1;
    border-radius: 8px;
}
textarea {
    width: 100%;
    padding: 15px;
    margin: 5px 0 15px 0;
    border: none;
    background: #f1f1f1;
    border-radius: 8px;
}
textarea:focus {
    background-color: #ddd;
    outline: none;
}
input:focus {
    background-color: #ddd;
    outline: none;
}

/* Set a style for the submit button */
.btn {
    background-color: var(--bg6);
    color: white;
    padding: 10px 20px;
    border: none;
    cursor: pointer;
    width: 100%;
}
</style>
