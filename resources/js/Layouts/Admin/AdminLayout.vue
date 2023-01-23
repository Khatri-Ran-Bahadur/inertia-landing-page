<script setup>
import { ref } from "vue";
import { Link } from "@inertiajs/inertia-vue3";
import Header from "./inc/Header.vue";
import Footer from "./inc/Footer.vue";
const showingNavigationDropdown = ref(false);
</script>

<template>
    <Header />
    <div class="app-wrapper">
        <div class="app-content pt-2 p-md-2 p-lg-2">
            <slot name="header" />
            <slot />
        </div>
        <!--//app-content-->

        <Footer />
    </div>
    <!--//app-wrapper-->
</template>
