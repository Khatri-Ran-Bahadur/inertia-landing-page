<script setup></script>
<template>
    <div class="H3">{{ __("Our Services") }}</div>
    <div v-for="(service, index) in $page.props.services" :key="index">
        <div class="OurServices" v-if="index % 2 === 0">
            <div class="container-xl">
                <div class="row gy-4 align-items-center">
                    <div class="col-md-12 col-lg-6">
                        <h5 class="AboutUsDivH5">{{ service.title }}</h5>
                        <div v-html="service.description"></div>
                        <button
                            type="button"
                            class="BTN"
                            data-bs-toggle="modal"
                            data-bs-target="#exampleModal"
                        >
                            {{ __("Order Service") }}
                        </button>
                    </div>

                    <div class="col-md-12 col-lg-6">
                        <img
                            class="AboutUsDivImg"
                            :src="service.image"
                            alt=""
                        />
                    </div>
                </div>
            </div>
        </div>

        <div class="container-xl mt-5" v-if="index % 2 !== 0">
            <div class="row gy-4 align-items-start">
                <div class="col-md-12 col-lg-6">
                    <img class="AboutUsDivImg" :src="service.image" alt="" />
                </div>

                <div class="col-md-12 col-lg-6">
                    <h5 class="AboutUsDivH5">{{ service.title }}</h5>
                    <div v-html="service.description"></div>
                    <button
                        type="button"
                        class="BTN"
                        data-bs-toggle="modal"
                        data-bs-target="#exampleModal"
                    >
                        {{ __("Order Service") }}
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div
        class="modal fade"
        id="exampleModal"
        tabindex="-1"
        aria-labelledby="exampleModalLabel"
        aria-hidden="true"
    >
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">
                        Заказать услугу
                    </h1>
                    <button
                        type="button"
                        class="btn-close"
                        data-bs-dismiss="modal"
                        aria-label="Close"
                    ></button>
                </div>
                <div class="modal-body">
                    <input
                        type="text"
                        placeholder="Name"
                        name="name"
                        required
                    />

                    <input
                        type="email tel"
                        placeholder="Number phone/email"
                        name="email"
                        required
                    />

                    <button type="submit" class="btn btn-primary w-100">
                        Send
                    </button>
                </div>
            </div>
        </div>
    </div>
</template>

<style>
.OurServices {
    background: var(--bg2);
    padding: 40px 0px;
    margin-top: 35px;
}

.AboutUsDivImg {
    width: 530px;
    height: 340px;
}

.OurServices p {
    max-width: 500px;
}

.BTN {
    background: linear-gradient(180deg, #559ce4 0%, #174276 110.58%);
    border-radius: 10px;
    outline: none;
    border: none;
    font-weight: 666;
    font-size: 20px;
    color: #ffffff;
    padding: 10px 15px;
    margin-top: 15px;
}

.modal {
    margin-top: 100px !important;
}

.modal input {
    width: 100%;
    padding: 12px 15px;
    margin: 5px 0 15px 0;
    border: none;
    background: #f1f1f1;
    border-radius: 8px;
}

.modal input:focus {
    background-color: #ddd;
    outline: none;
}
@media only screen and (max-width: 900px) {
    .AboutUsDivImg {
        width: 100%;
        height: 370px;
        object-fit: cover;
    }

    .OurServices .row {
        display: flex !important;
        flex-direction: column-reverse !important;
    }

    .ssssssssss .row {
        display: flex !important;
        flex-direction: column-reverse !important;
    }
}

@media only screen and (max-width: 500px) {
    .AboutUsDivImg {
        width: 100%;
        height: 220px;
        object-fit: cover;
    }
}
</style>
