<script setup>
import { Head, Link } from "@inertiajs/inertia-vue3";
import { ref } from "vue";
import Header from "./Components/Header.vue";
import ContentOne from "./Components/ContentOne.vue";
import AboutUs from "./Components/AboutUs.vue";
import OurServices from "./Components/OurServices.vue";
import Contact from "./Components/Contact.vue";
import Footer from "./Components/Footer.vue";
</script>

<template>
    <div class="home">
        <Header />
        <ContentOne :section="$page.props.section" />
        <AboutUs :abouts="$page.props.abouts" />
        <OurServices :services="$page.props.services" />
        <Contact :section="$page.props.section" />
        <Footer />
    </div>
</template>

<style lang="scss">
:root {
    --bg: #174276;
    --bg2: #d1e9ff;
    --bg3: #d9d9d9;
    --bg4: #f4f4f4;
    --bg5: #235a9f;
    --bg6: #006ec2;
}

.H3 {
    font-family: "Montserrat";
    font-style: normal;
    font-weight: 800;
    font-size: 36px;
    color: var(--bg5);
    text-align: center;
    margin-top: 100px;
}

nav {
    a {
        font-weight: bold;
        color: #2c3e50;

        &.router-link-exact-active {
            color: #42b983;
        }
    }
}

@media only screen and (max-width: 900px) {
    .H3 {
        font-size: 28px;
        margin-top: 55px;
    }
}
</style>
