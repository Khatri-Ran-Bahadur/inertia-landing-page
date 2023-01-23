<script setup>
defineProps({
    section: Object,
});
</script>
<template>
    <div class="ContentOne">
        <div class="ContentOneItem">
            <img
                :src="section.top_section.banner"
                alt="Notebook"
                style="width: 100%"
            />
            <div class="content">
                <div class="container-xl">
                    <div class="row gy-4">
                        <div
                            class="contentItem col-12 col-sm-6 col-md-6 col-lg-3"
                        >
                            <h5>{{ section.top_section.first_title }}</h5>
                            <p>{{ section.top_section.first_description }}</p>
                        </div>

                        <div
                            class="contentItem col-12 col-sm-6 col-md-6 col-lg-3"
                        >
                            <h5>{{ section.top_section.second_title }}</h5>
                            <p>{{ section.top_section.second_description }}</p>
                        </div>

                        <div
                            class="contentItem col-12 col-sm-6 col-md-6 col-lg-3"
                        >
                            <h5>{{ section.top_section.third_title }}</h5>
                            <p>{{ section.top_section.third_description }}</p>
                        </div>

                        <div
                            class="contentItem col-12 col-sm-6 col-md-6 col-lg-3"
                        >
                            <h5>{{ section.top_section.fourth_title }}</h5>
                            <p>{{ section.top_section.fourth_description }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<style>
.ContentOne {
    position: relative;
}

.ContentOneItem {
    position: relative;
    margin: 0 auto;
}

.ContentOneItem img {
    vertical-align: middle;
    height: 630px;
    object-fit: cover;
}

.ContentOneItem .content {
    position: absolute;
    bottom: 0;
    background: rgb(0, 0, 0);
    /* Fallback color */
    background: rgba(0, 0, 0, 0.5);
    /* Black background with 0.5 opacity */
    color: #f1f1f1;
    width: 100%;
    padding: 30px 0px;
}

.contentItem h5 {
    font-style: normal;
    font-weight: 600;
    font-size: 18px;
    line-height: 22px;
    color: #ffffff;
    text-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);
}

.contentItem p {
    font-style: normal;
    font-weight: 444;
    font-size: 17px;
    line-height: 19px;
    color: #ffffff;
    text-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);
}
</style>
