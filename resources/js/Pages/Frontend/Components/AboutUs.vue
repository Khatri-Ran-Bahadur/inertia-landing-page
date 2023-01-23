<script setup></script>
<template>
    <div class="AboutUs">
        <div class="H3">{{ __("About Us") }}</div>

        <div class="AboutUsDiv">
            <div class="container-xl">
                <div
                    v-for="(about, index) in $page.props.abouts"
                    :key="index"
                    :class="index % 2 === 0 ? 'AboutUsDiv1' : 'AboutUsDiv2'"
                >
                    <div
                        class="row gy-4 align-items-center"
                        v-if="index % 2 === 0"
                    >
                        <div class="col-md-12 col-lg-6">
                            <h5 class="AboutUsDivH5">{{ about.title }}</h5>
                            <div v-html="about.description"></div>
                        </div>
                        <div class="col-md-12 col-lg-6">
                            <img
                                class="AboutUsDivImg"
                                :src="about.image"
                                alt=""
                            />
                        </div>
                    </div>

                    <div
                        class="row gy-4 align-items-center"
                        v-if="index % 2 !== 0"
                    >
                        <div class="col-md-12 col-lg-6">
                            <img
                                class="AboutUsDivImg"
                                :src="about.image"
                                alt=""
                            />
                        </div>
                        <div class="col-md-12 col-lg-6">
                            <h5 class="AboutUsDivH5">{{ about.title }}</h5>
                            <div v-html="about.description"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<style>
.AboutUsDiv {
    background: var(--bg4);
    padding: 40px 0px;
    margin-top: 35px;
}

.AboutUsDivH5 {
    font-family: "Montserrat";
    font-style: normal;
    font-weight: 700;
    font-size: 26px;
    color: #2d2d2d;
}

.AboutUsDivImg {
    width: 530px;
    height: 340px;
}

.AboutUsDiv2 {
    margin-top: 130px;
}

@media only screen and (max-width: 900px) {
    .AboutUsDiv1 .row {
        display: flex !important;
        flex-direction: column-reverse !important;
    }

    .AboutUsDivImg {
        width: 100%;
        height: 370px;
        object-fit: cover;
    }

    .AboutUsDiv2 {
        margin-top: 50px;
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
